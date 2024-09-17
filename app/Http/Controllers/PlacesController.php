<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\JsonResponse;

class PlacesController extends Controller
{
    /**
     * Get the places.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function index(Request $request): JsonResponse
    {
        // Validate the request to ensure `text` is provided
        $request->validate([
            'text' => 'required|string|min:2',
        ]);

        // Fetch address suggestions from Geoapify API
        $response = Http::get('https://api.geoapify.com/v1/geocode/autocomplete', [
            'text' => $request->input('text'),
            'apiKey' => 'f4d75014a09a496d9fcc493eb5f12c17', // Use your actual API key here
        ]);

        // Return the response from the Geoapify API back to the frontend
        return response()->json($response->json());
    }
}
