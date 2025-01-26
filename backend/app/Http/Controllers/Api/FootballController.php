<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Services\FootballApiService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class FootballController extends Controller
{
    protected $footballApi;

    public function __construct(FootballApiService $footballApi)
    {
        $this->footballApi = $footballApi;
    }

    // Competitions
    public function getAllCompetitions()
    {
        $competitions = Cache::get('competitions');

        if (!$competitions) {
            try {
                $competitions = $this->footballApi->get('competitions');
                
                if (!$competitions) {
                    return response()->json(['error' => 'No se encontraron competencias'], 404);
                }

                Cache::put('competitions', $competitions, now()->addMinutes(1));
            } catch (\Exception $e) {
                Log::error('Error al obtener competencias: ' . $e->getMessage());
                return response()->json(['error' => 'Error al consultar competencias'], 500); // 500 Internal Server Error
            }
        }

        return response()->json($competitions);
    }

    public function getCompetition($id)
    {
        $cacheKey = "competition_{$id}";

        $data = Cache::get($cacheKey);

        if (!$data) {
            try {
                $data = $this->footballApi->get("competitions/{$id}");

                if (!$data) {
                    return response()->json(['error' => 'Competencia no encontrada'], 404);
                }

                Cache::put($cacheKey, $data, now()->addMinutes(1));
            } catch (\Exception $e) {
                Log::error('Error al obtener competencia ' . $id . ': ' . $e->getMessage());
                return response()->json(['error' => 'Error al consultar la competencia'], 500); // 500 Internal Server Error
            }
        }

        return response()->json($data);
    }

    // Teams
    public function getAllTeams()
    {
        $teams = Cache::get('teams');

        if (!$teams) {
            try {
                $teams = $this->footballApi->get('teams');
                
                if (!$teams) {
                    return response()->json(['error' => 'No se encontraron competencias'], 404);
                }

                Cache::put('teams', $teams, now()->addMinutes(1));
            } catch (\Exception $e) {
                Log::error('Error al obtener competencias: ' . $e->getMessage());
                return response()->json(['error' => 'Error al consultar teams'], 500); // 500 Internal Server Error
            }
        }

        return response()->json($teams);
    }

    public function getTeam($id)
    {
        $cacheKey = "team_{$id}";

        $data = Cache::get($cacheKey);

        if (!$data) {
            try {
                $data = $this->footballApi->get("teams/{$id}");

                if (!$data) {
                    return response()->json(['error' => 'Teams no encontrada'], 404);
                }

                Cache::put($cacheKey, $data, now()->addMinutes(1));
            } catch (\Exception $e) {
                Log::error('Error al obtener team ' . $id . ': ' . $e->getMessage());
                return response()->json(['error' => 'Error al consultar al team'], 500); // 500 Internal Server Error
            }
        }

        return response()->json($data);
    }

    // Players
    public function getAllPlayers()
    {
        $playerIds = [11, 13, 44, 66, 88, 99]; // IDs conocidos de los jugadores
        $players = [];

        try {
            foreach ($playerIds as $id) {
                $response = $this->footballApi->get("persons/{$id}");
                if ($response) {
                    $players[] = $response;
                }
            }

            return response()->json(['persons' => $players]);
        } catch (\Exception $e) {
            Log::error('Error al obtener jugadores: ' . $e->getMessage());
            return response()->json(['error' => 'Error al consultar jugadores'], 500);
        }
    }

    public function getPlayer($id)
    {
        $cacheKey = "player_{$id}";

        $data = Cache::get($cacheKey);

        if (!$data) {
            try {
                $data = $this->footballApi->get("persons/44");

                if (!$data) {
                    return response()->json(['error' => 'player no encontrado'], 404);
                }

                Cache::put($cacheKey, $data, now()->addMinutes(1));
            } catch (\Exception $e) {
                Log::error('Error al obtener player ' . $id . ': ' . $e->getMessage());
                return response()->json(['error' => 'Error al consultar al player'], 500); // 500 Internal Server Error
            }
        }

        return response()->json($data);
    }
}