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
        $term = strtolower($request->input('term', ''));

        $response = Http::get('https://emsifa.github.io/api-wilayah-indonesia/api/provinces.json');
        if ($response->successful()) {
            $provinces = collect($response->json());

            if (!empty($term)) {
                $provinces = $provinces->filter(function ($province) use ($term) {
                    return str_contains(strtolower($province['name']), $term);
                });
            }

            return response()->json($provinces->values()); // Reset index
        } else {
            return response()->json([], 500);
        }
    }

    public function getRegencies(Request $request, $id)
    {
        $term = strtolower($request->input('term', ''));

        $response = Http::get("https://emsifa.github.io/api-wilayah-indonesia/api/regencies/{$id}.json");
        if ($response->successful()) {
            $regencies = collect($response->json());

            if (!empty($term)) {
                $regencies = $regencies->filter(function ($regency) use ($term) {
                    return str_contains(strtolower($regency['name']), $term);
                });
            }

            return response()->json($regencies->values());
        } else {
            return response()->json([], 500);
        }
    }


    public function getDistricts(Request $request, $id)
    {
        $term = strtolower($request->input('term', ''));

        $response = Http::get("https://emsifa.github.io/api-wilayah-indonesia/api/districts/{$id}.json");
        if ($response->successful()) {
            $districts = collect($response->json());

            if (!empty($term)) {
                $districts = $districts->filter(function ($district) use ($term) {
                    return str_contains(strtolower($district['name']), $term);
                });
            }

            return response()->json($districts->values());
        } else {
            return response()->json([], 500);
        }
    }


    public function getVillage(Request $request, $id)
        {
            $term = strtolower($request->input('term', ''));

            $response = Http::get("https://emsifa.github.io/api-wilayah-indonesia/api/villages/{$id}.json");
            if ($response->successful()) {
                $villages = collect($response->json());

                if (!empty($term)) {
                    $villages = $villages->filter(function ($village) use ($term) {
                        return str_contains(strtolower($village['name']), $term);
                    });
                }

                return response()->json($villages->values());
            } else {
                return response()->json([], 500);
            }
        }

}
