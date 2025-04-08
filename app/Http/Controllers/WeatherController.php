<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class WeatherController extends Controller
{
    private $cacheTime = 600;

    public function index()
    {
        return view('weather.index');
    }

    public function getWeather(Request $request)
    {
        $city = $request->input('city');
        
        $cacheKey = 'weather_' . $city;
        
        if (Cache::has($cacheKey)) {
            return response()->json(Cache::get($cacheKey));
        }

        try {
            $response = Http::get("http://api.openweathermap.org/data/2.5/weather", [
                'q' => $city,
                'appid' => env('OPENWEATHER_API_KEY'),
                'units' => 'metric'
            ]);

            if ($response->successful()) {
                $data = $response->json();
                $weatherData = [
                    'city' => $data['name'],
                    'description' => $data['weather'][0]['description'],
                    'temperature' => $data['main']['temp'],
                    'windSpeed' => $data['wind']['speed']
                ];

                Cache::put($cacheKey, $weatherData, $this->cacheTime);
                
                return response()->json($weatherData);
            }

            return response()->json(['error' => 'City not found'], 404);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error retrieving weather data'], 500);
        }
    }
} 