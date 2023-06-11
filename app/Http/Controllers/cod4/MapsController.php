<?php

namespace App\Http\Controllers\cod4;

use App\Http\Controllers\Controller;
use App\Models\cod4\Map;
use App\Http\Requests;
use ZipArchive;


class MapsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $maps = Map::with('routesExternal.countRuns', 'routesExternal.routesInternal.topTimePlayer', 'routesExternal.routesInternal.topRPGPlayer')
                ->where('setup', 1)
                ->orderBy('name')
                ->get();

        $popularMaps = Map::orderBy('totalRuns', 'DESC')
                ->limit(10)
                ->get();

        $latestMaps = Map::orderBy('date', 'DESC')
                ->limit(10)
                ->get();

        $data = [
            'maps'  => json_decode($maps, true),
            'popularMaps'   => json_decode($popularMaps, true),
            'latestMaps'    => json_decode($latestMaps, true)
        ];
        
        return view('pages.cod4.map')->with($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($mapName)
    {
        $mapRoutes = Map::with('routesExternal.countRuns', 'routesExternal.routesInternal.topTimePlayer', 'routesExternal.routesInternal.topRPGPlayer')
                    ->where('name', $mapName)
                    ->first();

        $runs = Map::with('routesExternal.runs.guid')
                    ->where('name', $mapName)
                    ->first();

        if($runs) {
            $routesData = $runs->toArray();

            $runs = array();
            foreach($routesData['routes_external'] as $route) {
                $runs = array_merge($route['runs'], $runs);
            }     

            usort($runs, fn($a, $b) => $a['time'] <=> $b['time']);

            foreach($runs as &$run) {
                $currentRouteID = $run['way_id'];

                foreach($routesData['routes_external'] as $routeData) {
                    if($currentRouteID == $routeData['id']) {
                        $run['route'] = $routeData['name'];
                        $run['map'] = $routesData['name'];
                    }
                }
            }
        } else {
            $runs = "";
        }
        if(!$mapRoutes) {
            $mapRoutes = "";
        }

        $data = [
            'runs'  => $runs,
            'mapName'  => $mapName,
            'mapRoutes' => json_decode($mapRoutes, true)
        ];

        return view('pages.cod4.map_show')->with($data);
    }

    public function downloadMap($map) {
        $mappath = "/var/www/download/content/cod4/usermaps/$map/";
        $file = "/var/www/download/temp/$map.zip";
    
        if(!file_exists($file)) {
            $zip = new ZipArchive();
            $res = $zip->open($file, ZipArchive::CREATE | ZIPARCHIVE::OVERWRITE);
            if($res === FALSE){
                return false;
            }

            if(file_exists($mappath . $map . ".ff"))
                $zip->addFile($mappath . $map . ".ff", $map . ".ff");
            if(file_exists($mappath . $map . "_load.ff"))
                $zip->addFile($mappath . $map . "_load.ff", $map . "_load.ff");
            if(file_exists($mappath . $map . ".iwd"))
                $zip->addFile($mappath . $map . ".iwd", $map . ".iwd");
    
            $zip->close();
        }
    
        header("Content-Type: application/zip");
        header("Content-Length: " . filesize($file));
        header("Content-Disposition: attachment; filename=" . basename($file));
        ob_clean();
        
        $maps = Map::where('name', $map);
        $maps->timestamps = false;
        $maps->increment('download');
    
        readfile($file);
        unlink($file);

        // return view('pages.cod4.map_show');
    }
}
