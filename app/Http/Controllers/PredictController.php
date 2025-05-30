<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PredictController extends Controller
{
    public function index()
    {
        return view('predict');
    }

    public function predict(Request $request)
    {
        $data = $request->only([
            'JK', 'Usia', 'Pendapatan', 'ASI_eksklusif', 'MPASI', 'Imunisasi',
            'Porsi_ibu', 'ASI_saja', 'Penimbangan', 'Air_bersih',
            'Cuci_tangan', 'Jamban', 'Nyamuk', 'Buah_sayur',
            'Olahraga', 'Merokok', 'TB'
        ]);

        $response = Http::post('http://127.0.0.1:5001/stunting/predict', $data);
        $prediction = null;

        if ($response->successful()) {
            $prediction = $response->json()['prediction'];
        }

        return view('predict', compact('prediction'));
    }
}
