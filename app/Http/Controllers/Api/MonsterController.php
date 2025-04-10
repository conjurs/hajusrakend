<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Monster;
use Illuminate\Support\Facades\Cache;

class MonsterController extends Controller
{
    public function index(Request $request)
    {
        $limit = $request->query('limit', 10); 
        $limit = max(1, min(100, (int)$limit));

        $cacheKey = 'monsters.selected.limit.' . $limit;
        $cacheDuration = 60 * 5;

        $monsters = Cache::remember($cacheKey, $cacheDuration, function () use ($limit) {
            return Monster::select('id', 'title', 'image', 'description', 'behavior')
                        ->latest()
                        ->take($limit)
                        ->get();
        });

        return response()->json($monsters);
    }

    public function store(Request $request)
    {
    }

    public function show(string $id)
    {
    }

    public function update(Request $request, string $id)
    {
    }

    public function destroy(string $id)
    {
    }
}
