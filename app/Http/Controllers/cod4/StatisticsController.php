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

        $player = Player::with('bestRunByTime.routeExternal.map')
                ->where('guidShort', $playerGuid)
                ->first();
               

        $mapsData = $maps->toArray();
        $playerData = $player->toArray();

        foreach($mapsData as &$map) {
            foreach ($map['routes_external'] as &$route) {
                foreach($playerData['best_run_by_time'] as $bestRun) {
                    if($bestRun['way_id'] == $route['id']) {
                        unset($bestRun['route_external']);
                        $route['best_run_by_time'] = $bestRun;
                        // $route['test'] = "Helo";
                    }
                }
            }
        }

        $data = [
            'mapsData'  => $mapsData
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
