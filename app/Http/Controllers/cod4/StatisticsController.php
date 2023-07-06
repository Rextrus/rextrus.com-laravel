<?php

namespace App\Http\Controllers\cod4;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\cod4\Player;
use App\Models\cod4\Map;

class StatisticsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $maps = Map::with('routesExternal')
                ->where('setup', 1)
                ->orderBy('name')
                ->get();


        $data = [
            'maps'  => json_decode($maps, true)
        ];
        
        return view('pages.cod4.statistics')->with($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($playerGuid)
    {
        $maps = Map::with('routesExternal')
                ->where('setup', 1)
                ->orderBy('name')
                ->get();

        $playerData = Player::with('topTimePlayer.mapExternal', 'topRPGPlayer.mapExternal', 'topTimeHaxPlayer.mapExternal', 'topRPGHaxPlayer.mapExternal')
                ->where('guidShort', $playerGuid)
                ->first();

        $playerBestTime = Player::with('bestRunByTime.routeExternal.map')
                ->where('guidShort', $playerGuid)
                ->first();

        $playerBestRPG = Player::with('bestRunByRPG.routeExternal.map')
                ->where('guidShort', $playerGuid)
                ->first();

        $longestRuns = Player::with('longestRuns.routeExternal.map')
                ->where('guidShort', $playerGuid)
                ->first();

        $mapsData = $maps->toArray();
        $playerDataBestTimes = $playerBestTime->toArray();
        $playerDataBestRPG = $playerBestRPG->toArray();

        $routeCounter = 0;
        $finishedRouteCounter = 0;
        foreach($mapsData as &$map) {
            $map['routes_external'] = array_filter($map['routes_external'], function($route) {
                return strcasecmp($route['name'], "BOT") !== 0;
            });

            foreach ($map['routes_external'] as &$route) {
                $resetCounter = true;

                $routeCounter++;
                foreach($playerDataBestTimes['best_run_by_time'] as $bestRun) {
                    if($bestRun['way_id'] == $route['id']) {
                        if($resetCounter) {
                            $finishedRouteCounter++;
                            $resetCounter = false;
                        }
                        unset($bestRun['route_external']);
                        $route['best_run_by_time'] = $bestRun;
                    }
                }
                foreach($playerDataBestRPG['best_run_by_r_p_g'] as $bestRun) {
                    if($bestRun['way_id'] == $route['id']) {
                        unset($bestRun['route_external']);
                        $route['best_run_by_rpg'] = $bestRun;
                    }
                }
            }
        }

        $data = [
            'mapsData'  => $mapsData,
            'routeCounter'  => $routeCounter,
            'finishedRouteCounter'  => $finishedRouteCounter,
            'playerData'  => json_decode($playerData, true),
            'longestRuns'  => json_decode($longestRuns, true)
        ];
        
        // return json_encode($mapsData);
        return view('pages.cod4.statistics')->with($data);
    }


    public function findPlayer(Request $request)
    {   
        if($request->keyword != '') {
            $players = Player::where('alias','LIKE','%'.$request->keyword.'%')->limit(15)->get();
        }

        return response()->json([
            'players' => $players
        ]);
     }
}
