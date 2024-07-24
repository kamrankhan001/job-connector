<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Country;
use App\Models\City;

class AutocompleteController extends Controller
{
    public function locations(Request $request)
    {
        $term = $request->query('term');
        $url = 'https://wft-geo-db.p.rapidapi.com/v1/geo/cities?namePrefix=' . urlencode($term) . '&limit=10';

        $response = Http::withHeaders([
            'x-rapidapi-host' => 'wft-geo-db.p.rapidapi.com',
            'x-rapidapi-key' => 'df667ae05bmsh0604079d77e6951p1e814ejsnb405758bb8de',
        ])->get($url);

        if ($response->failed()) {
            return response()->json(['error' => 'Failed to fetch data'], 500);
        }

        $data = $response->json()['data'];

        return response()->json($data);
    }
}
