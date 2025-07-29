<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Illuminate\Support\Facades\Http;

class MpasiController extends Controller
{
    public function form()
    {
        return view('mpasi');
    }

    public function predict(Request $request)
    {
        $response = Http::post('https://l2tsvbfz6w3mmb-8000.proxy.runpod.net/mpasi/predict', [
            'kalori_kkal' => $request->kalori_kkal,
            'protein_gr' => $request->protein_gr,
            'lemak_gr' => $request->lemak_gr,
            'tekstur' => $request->tekstur,
            'jumlah_bahan' => $request->jumlah_bahan ?? 0,
        ]);

        return view('mpasi', [
            'hasil' => $response->json(),
            'input' => $request->all()
        ]);
    }

    public function recommendByAge(Request $request)
    {
        $response = Http::post('https://l2tsvbfz6w3mmb-8000.proxy.runpod.net/mpasi/recommend-by-age', [
            'kategori_umur' => $request->kategori_umur
        ]);

        return view('mpasi', [
            'hasil' => $response->json(),
            'input' => $request->all()
        ]);
    }

}
