<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ApiExternalController extends Controller
{
    public function index()
    {
        return view('chat');
    }

    public function getProvinces(Request $request)
    {
        $response = Http::get('https://emsifa.github.io/api-wilayah-indonesia/api/provinces.json');
        if ($response->successful()) {
            return response()->json($response->json());
        } else {
            return response()->json([], 500);
        }
    }

    public function getRegencies($id)
    {
        $response = Http::get("https://emsifa.github.io/api-wilayah-indonesia/api/regencies/{$id}.json");
        if ($response->successful()) {
            return response()->json($response->json());
        } else {
            return response()->json([], 500);
        }
    }

    public function getDistricts($id)
    {
        $response = Http::get("https://emsifa.github.io/api-wilayah-indonesia/api/districts/{$id}.json");
        if ($response->successful()) {
            return response()->json($response->json());
        } else {
            return response()->json([], 500);
        }
    }

    public function getVillage($id)
    {
        $response = Http::get("https://emsifa.github.io/api-wilayah-indonesia/api/villages/{$id}.json");
        if ($response->successful()) {
            return response()->json($response->json());
        } else {
            return response()->json([], 500);
        }
    }
}
