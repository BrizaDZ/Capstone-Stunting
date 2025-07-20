<?php

namespace App\Http\Controllers\Data;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\Html\Builder;
use Yajra\DataTables\Services\DataTable;
use App\Models\Appointment;
use App\Models\Stunting;
use App\Models\LokasiPuskesmas;
use PhpOffice\PhpSpreadsheet\IOFactory;
use DataTables;
use DB;
use Auth;

class StuntingController extends Controller
{
    public function index()
    {
        return view('puskesmas.data.stunting.index');
    }

    public function Detail($id)
    {
        $data = Stunting::join('patient', 'stunting.PatientID', '=', 'patient.PatientID')
            ->where('patient.PatientID', $id)
            ->select([
                'stunting.*',
                'patient.name',
            ])
            ->get();

        return view('puskesmas.data.stunting.detail', compact('data'));
    }

    public function Edit($id)
    {
        return view('puskesmas.data.stunting.addedit', ['data' => Stunting::findOrFail($id)]);
    }

    private function loadBBUExcel($path)
    {
        $data = [];

        $spreadsheet = IOFactory::load($path);
        $sheet = $spreadsheet->getActiveSheet();
        $rows = $sheet->toArray();

        foreach ($rows as $index => $row) {
            if ($index === 0) continue;

            $age = (int)$row[0];
            $data[$age] = [
                '-3sd' => (float)$row[1],
                '-2sd' => (float)$row[2],
                '-1sd' => (float)$row[3],
                'median' => (float)$row[4],
                '+1sd' => (float)$row[5],
                '+2sd' => (float)$row[6],
                '+3sd' => (float)$row[7],
                'sd' => (float)$row[5] - (float)$row[4]
            ];
        }

        return $data;
    }

    public function loadBBTBExcel($filepath)
    {
        $spreadsheet = IOFactory::load($filepath);
        $sheet = $spreadsheet->getActiveSheet();
        $data = [];

        foreach ($sheet->getRowIterator(2) as $row) {
            $cellIterator = $row->getCellIterator();
            $cellIterator->setIterateOnlyExistingCells(false);

            $rowData = [];
            foreach ($cellIterator as $cell) {
                $rowData[] = $cell->getValue();
            }

            $tinggi = round((float) $rowData[0], 1);
            $median = (float) $rowData[4];
            $plus1sd = (float) $rowData[5];


            $sd = $plus1sd - $median;

            $data[$tinggi] = [
                'median' => $median,
                'sd' => $sd,
            ];
        }

        return $data;
    }

    public function store(Request $v)
    {

        $data = Stunting::findOrFail($v->StuntingID);

        $data->PatientID = $v->PatientID;
        $data->PuskesmasID = auth()->id();
        $data->measuretype = $v->measuretype;
        $data->weight = $v->weight;
        $data->height = $v->height;
        $data->age = $v->age;
        $data->gender = $v->gender;

        if ($v->gender == 'Perempuan') {
            $BBU = $this->loadBBUExcel(storage_path('/bb_perempuan_60.xlsx'));

            $usia = (int)$v->age;
            $berat = (float)$v->weight;

            if (isset($BBU[$usia])) {
                $median = $BBU[$usia]['median'];
                $sd = $BBU[$usia]['sd'];

                $zscore_bb_u = ($berat - $median) / $sd;
                $data->zscoreweightage = round($zscore_bb_u, 2);

                if ($zscore_bb_u < -3) {
                    $data->weightage = 'Gizi Buruk';
                } elseif ($zscore_bb_u >= -3 && $zscore_bb_u < -2) {
                    $data->weightage = 'Gizi Kurang';
                } elseif ($zscore_bb_u >= -2 && $zscore_bb_u <= 1) {
                    $data->weightage = 'Gizi Normal (Baik)';
                } elseif ($zscore_bb_u > 1 && $zscore_bb_u <= 2) {
                    $data->weightage = 'Risiko Berat Badan Lebih';
                } else {
                    $data->weightage = 'Gizi Lebih (Berat Badan Lebih)';
                }
            }
        }

        if ($v->gender == 'Perempuan' && $v->age <= 24) {
            $TBU = $this->loadBBUExcel(storage_path('/pb_perempuan_24.xlsx'));

            $usia = (int)$v->age;
            $tinggi = (float)$v->height;

            if (isset($TBU[$usia])) {
                $median = $TBU[$usia]['median'];
                $sd = $TBU[$usia]['sd'];

                $zscore_tb_u = ($tinggi - $median) / $sd;
                $data->zscoreheightage = round($zscore_tb_u, 2);

                if ($zscore_tb_u < -3) {
                    $data->heightage = 'Sangat Pendek';
                } elseif ($zscore_tb_u >= -3 && $zscore_tb_u < -2) {
                    $data->heightage = 'Pendek';
                } elseif ($zscore_tb_u >= -2 && $zscore_tb_u <= 2) {
                    $data->heightage = 'Normal';
                } else {
                    $data->heightage = 'Tinggi';
                }
            }
            $BBTB = $this->loadBBTBExcel(storage_path('/bbtb_laki_24.xlsx'));
            $tinggi = (float)$v->height;
            $berat = (float)$v->weight;

            $tinggi_lookup = round($tinggi * 2) / 2;

            if (isset($BBTB[$tinggi_lookup])) {
                $median = $BBTB[$tinggi_lookup]['median'];
                $sd = $BBTB[$tinggi_lookup]['sd'];

                $zscore_bb_tb = ($berat - $median) / $sd;
                $data->zscoreweightheight = round($zscore_bb_tb, 2);

                if ($zscore_bb_tb < -3) {
                    $data->weightheight = 'Gizi Buruk';
                } elseif ($zscore_bb_tb >= -3 && $zscore_bb_tb < -2) {
                    $data->weightheight = 'Gizi Kurang';
                } elseif ($zscore_bb_tb >= -2 && $zscore_bb_tb <= 1) {
                    $data->weightheight = 'Gizi Normal (Baik)';
                } elseif ($zscore_bb_tb > 1 && $zscore_bb_tb <= 2) {
                    $data->weightheight = 'Risiko Berat Badan Lebih';
                } else {
                    $data->weightheight = 'Gizi Lebih (Berat Badan Lebih)';
                }
            }

        }

        if ($v->gender == 'Perempuan' && $v->age >= 24) {
            $TBU = $this->loadBBUExcel(storage_path('/tb_perempuan_60.xlsx'));

            $usia = (int)$v->age;
            $tinggi = (float)$v->height;

            if (isset($TBU[$usia])) {
                $median = $TBU[$usia]['median'];
                $sd = $TBU[$usia]['sd'];

                $zscore_tb_u = ($tinggi - $median) / $sd;
                $data->zscoreheightage = round($zscore_tb_u, 2);

                if ($zscore_tb_u < -3) {
                    $data->heightage = 'Sangat Pendek';
                } elseif ($zscore_tb_u >= -3 && $zscore_tb_u < -2) {
                    $data->heightage = 'Pendek';
                } elseif ($zscore_tb_u >= -2 && $zscore_tb_u <= 2) {
                    $data->heightage = 'Normal';
                } else {
                    $data->heightage = 'Tinggi';
                }
            }
            $BBTB = $this->loadBBTBExcel(storage_path('/bbtb_perempuan_60.xlsx'));
            $tinggi = (float)$v->height;
            $berat = (float)$v->weight;

            $tinggi_lookup = round($tinggi * 2) / 2;

            if (isset($BBTB[$tinggi_lookup])) {
                $median = $BBTB[$tinggi_lookup]['median'];
                $sd = $BBTB[$tinggi_lookup]['sd'];

                $zscore_bb_tb = ($berat - $median) / $sd;
                $data->zscoreweightheight = round($zscore_bb_tb, 2);

                if ($zscore_bb_tb < -3) {
                    $data->weightheight = 'Gizi Buruk';
                } elseif ($zscore_bb_tb >= -3 && $zscore_bb_tb < -2) {
                    $data->weightheight = 'Gizi Kurang';
                } elseif ($zscore_bb_tb >= -2 && $zscore_bb_tb <= 1) {
                    $data->weightheight = 'Gizi Normal (Baik)';
                } elseif ($zscore_bb_tb > 1 && $zscore_bb_tb <= 2) {
                    $data->weightheight = 'Risiko Berat Badan Lebih';
                } else {
                    $data->weightheight = 'Gizi Lebih (Berat Badan Lebih)';
                }
            }

        }


        if ($v->gender == 'Laki-Laki') {
            $whoBBU = $this->loadBBUExcel(storage_path('/bb_laki_60.xlsx'));

            $usia = (int)$v->age;
            $berat = (float)$v->weight;

            if (isset($whoBBU[$usia])) {
                $median = $whoBBU[$usia]['median'];
                $sd = $whoBBU[$usia]['sd'];

                $zscore_bb_u = ($berat - $median) / $sd;
                $data->zscoreweightage = round($zscore_bb_u, 2);

                if ($zscore_bb_u < -3) {
                    $data->weightage = 'Gizi Buruk';
                } elseif ($zscore_bb_u >= -3 && $zscore_bb_u < -2) {
                    $data->weightage = 'Gizi Kurang';
                } elseif ($zscore_bb_u >= -2 && $zscore_bb_u <= 1) {
                    $data->weightage = 'Gizi Normal (Baik)';
                } elseif ($zscore_bb_u > 1 && $zscore_bb_u <= 2) {
                    $data->weightage = 'Risiko Berat Badan Lebih';
                } else {
                    $data->weightage = 'Gizi Lebih (Berat Badan Lebih)';
                }
            }
        }

        if ($v->gender == 'Laki-Laki' && $v->age <= 24) {
            $TBU = $this->loadBBUExcel(storage_path('/pb_laki_24.xlsx'));

            $usia = (int)$v->age;
            $tinggi = (float)$v->height;

            if (isset($TBU[$usia])) {
                $median = $TBU[$usia]['median'];
                $sd = $TBU[$usia]['sd'];

                $zscore_tb_u = ($tinggi - $median) / $sd;
                $data->zscoreheightage = round($zscore_tb_u, 2);

                if ($zscore_tb_u < -3) {
                    $data->heightage = 'Sangat Pendek';
                } elseif ($zscore_tb_u >= -3 && $zscore_tb_u < -2) {
                    $data->heightage = 'Pendek';
                } elseif ($zscore_tb_u >= -2 && $zscore_tb_u <= 2) {
                    $data->heightage = 'Normal';
                } else {
                    $data->heightage = 'Tinggi';
                }
            }

            $BBTB = $this->loadBBTBExcel(storage_path('/bbtb_laki_24.xlsx'));
            $tinggi = (float)$v->height;
            $berat = (float)$v->weight;

            $tinggi_lookup = round($tinggi * 2) / 2;

            if (isset($BBTB[$tinggi_lookup])) {
                $median = $BBTB[$tinggi_lookup]['median'];
                $sd = $BBTB[$tinggi_lookup]['sd'];

                $zscore_bb_tb = ($berat - $median) / $sd;
                $data->zscoreweightheight = round($zscore_bb_tb, 2);

                if ($zscore_bb_tb < -3) {
                    $data->weightheight = 'Gizi Buruk';
                } elseif ($zscore_bb_tb >= -3 && $zscore_bb_tb < -2) {
                    $data->weightheight = 'Gizi Kurang';
                } elseif ($zscore_bb_tb >= -2 && $zscore_bb_tb <= 1) {
                    $data->weightheight = 'Gizi Normal (Baik)';
                } elseif ($zscore_bb_tb > 1 && $zscore_bb_tb <= 2) {
                    $data->weightheight = 'Risiko Berat Badan Lebih';
                } else {
                    $data->weightheight = 'Gizi Lebih (Berat Badan Lebih)';
                }
            }
        }

        if ($v->gender == 'Laki-Laki' && $v->age >= 24) {
            $TBU = $this->loadBBUExcel(storage_path('/tb_laki_60.xlsx'));

            $usia = (int)$v->age;
            $tinggi = (float)$v->height;

            if (isset($TBU[$usia])) {
                $median = $TBU[$usia]['median'];
                $sd = $TBU[$usia]['sd'];

                $zscore_tb_u = ($tinggi - $median) / $sd;
                $data->zscoreheightage = round($zscore_tb_u, 2);

                if ($zscore_tb_u < -3) {
                    $data->heightage = 'Sangat Pendek';
                } elseif ($zscore_tb_u >= -3 && $zscore_tb_u < -2) {
                    $data->heightage = 'Pendek';
                } elseif ($zscore_tb_u >= -2 && $zscore_tb_u <= 2) {
                    $data->heightage = 'Normal';
                } else {
                    $data->heightage = 'Tinggi';
                }
            }

            $BBTB = $this->loadBBTBExcel(storage_path('/bbtb_laki_60.xlsx'));
            $tinggi = (float)$v->height;
            $berat = (float)$v->weight;

            $tinggi_lookup = round($tinggi * 2) / 2;

            if (isset($BBTB[$tinggi_lookup])) {
                $median = $BBTB[$tinggi_lookup]['median'];
                $sd = $BBTB[$tinggi_lookup]['sd'];

                $zscore_bb_tb = ($berat - $median) / $sd;
                $data->zscoreweightheight = round($zscore_bb_tb, 2);

                if ($zscore_bb_tb < -3) {
                    $data->weightheight = 'Gizi Buruk';
                } elseif ($zscore_bb_tb >= -3 && $zscore_bb_tb < -2) {
                    $data->weightheight = 'Gizi Kurang';
                } elseif ($zscore_bb_tb >= -2 && $zscore_bb_tb <= 1) {
                    $data->weightheight = 'Gizi Normal (Baik)';
                } elseif ($zscore_bb_tb > 1 && $zscore_bb_tb <= 2) {
                    $data->weightheight = 'Risiko Berat Badan Lebih';
                } else {
                    $data->weightheight = 'Gizi Lebih (Berat Badan Lebih)';
                }
            }
        }


        if ($heightage = 'Sangat Pendek') {
            $data->status = 'Stunting';
        } else{
            $data->status = 'Tidak Stunting';
        }
        $data->save();


        return response()->json([
            'success' => true,
            'data' => [
                'StuntingID' => $data->StuntingID,
                'name' => $v->name,
                'gender' => $v->gender,
                'weight' => $v->weight,
                'height' => $v->height,
                'age' => $v->age,
                'weightage' => $data->weightage ?? 'N/A',
                'heightage' => $data->heightage ?? 'N/A',
                'weightheight' => $data->weightheight ?? 'N/A',
            ]
        ]);
    }
    public function Ajax(Request $request)
    {
        $puskesmasId = LokasiPuskesmas::where('PuskesmasID', auth()->id())->value('PuskesmasID');

        $data = Stunting::join('patient', 'stunting.PatientID', '=', 'patient.PatientID')
            ->where('stunting.PuskesmasID', $puskesmasId)
            ->select([
                'patient.name',
                'patient.PatientID',
                'stunting.age',
                'stunting.gender',
                'stunting.weight',
                'stunting.height',
                'stunting.measuretype',
                'stunting.zscoreweightage',
                'stunting.zscoreheightage',
                'stunting.zscoreweightheight',
                'stunting.weightage',
                'stunting.heightage',
                'stunting.weightheight',
                'stunting.status',
                'stunting.StuntingID',
                DB::raw('DATE(stunting.created_at) as created_date'),
            ]);

        $datatables = Datatables::of($data);

        return $datatables->addIndexColumn()->make(true);
    }

    public function delete($id)
        {
            $data = Stunting::findOrFail($id);
            $data->delete();

            return response()->json([
                'success' => true,
                'message' => 'Data berhasil dihapus.'
            ]);

        }
}
