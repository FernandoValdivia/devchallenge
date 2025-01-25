<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class FootballApiService
{
    protected $baseUrl;
    protected $token;

    public function __construct()
    {
        $this->baseUrl = config('services.football_api.base_url');
        $this->token = config('services.football_api.token');
    }

    public function get($endpoint, $params = [], $cacheKey = null, $cacheDuration = 600)
    {
        if ($cacheKey) {
            return Cache::remember($cacheKey, $cacheDuration, function () use ($endpoint, $params) {
                return $this->fetchFromApi($endpoint, $params);
            });
        }

        return $this->fetchFromApi($endpoint, $params);
    }

    private function fetchFromApi($endpoint, $params)
    {
        $response = Http::withHeaders([
            'X-Auth-Token' => $this->token,
        ])->get("{$this->baseUrl}/{$endpoint}", $params);

        if ($response->failed()) {
            throw new \Exception('Error al consultar la API externa: ' . $response->body());
        }

        return $response->json();
    }
}