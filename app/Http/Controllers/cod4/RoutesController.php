<?php

namespace App\Http\Controllers\cod4;

use App\Http\Controllers\Controller;
use App\Models\cod4\RouteExternal;

class RoutesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \App\Models\Map  $map
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        // $routes = Map::with('routes', 'routes.countRuns')
        //     ->whereHas('routes')
        //     ->get();

        // // dd($routes);


        // return view("pages.cod4.mapTest")->with('routes', $routes);
        // view('pages.cod4.map')->with('routes', json_decode($routes, true));
        // return response()->json($routes);


        // return app('App\Http\Controllers\API\MapsController')->show($map);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  \App\Models\Map  $map
     * @return \Illuminate\Http\Response
     */
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Map  $map
     * @param  \App\Models\Route  $route
     * @return \Illuminate\Http\Response
     */
    public function show($route)
    {       
        $runs = RouteExternal::with('map', 'countRuns', 'runs.guid')
                    ->where('id', $route)
                    ->first();

            // return response()->json($runs);
        $totalRunTime = 0;  
        foreach($runs['runs'] as $run) {
            $totalRunTime += $run['time'];
        }

        $totalRPG = 0;  
        foreach($runs['runs'] as $run) {
            $totalRPG += $run['rpgs'];
        }

        $avgTime = $totalRunTime / count($runs['runs']);
        $avgRPG = round($totalRPG / count($runs['runs']));

        $data = [
            'runs'  => json_decode($runs, true),
            'avgTime'  => $avgTime,
            'avgRPG'  => $avgRPG
        ];
        return view('pages.cod4.route_show')->with($data);
    }
}
