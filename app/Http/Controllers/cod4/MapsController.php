<?php

namespace App\Http\Controllers\cod4;

use App\Http\Controllers\Controller;
use App\Models\cod4\Map;
use App\Models\stats\IP;
use App\Models\stats\IPCount;
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
        /*
        $remoteIP = $_SERVER["HTTP_X_FORWARDED_FOR"];
        $abortIPStatistic = false;
        $date = date('Y-m-d');

        if(str_starts_with($remoteIP, '172.')) 
        {
            for($i = 16; $i < 32; $i++) 
            {
                if(str_starts_with($remoteIP, '172.' . $i . '.')) 
                {
                    $abortIPStatistic = true;
                } 
            }
        }
        if(str_starts_with($remoteIP, '10.') || str_starts_with($remoteIP, '192.168.')) 
        {
            $abortIPStatistic = true;
        }

        if($remoteIP == "10.13.37.129")
            $abortIPStatistic = false;

        if(!$abortIPStatistic) 
        {
            $checkEntries = IP::where('ipaddress', $remoteIP)->first();
            if($checkEntries != null && $checkEntries->id) 
            {
                $checkCounterEntry = IPCount::where('id_web_stats_ip', $checkEntries->id)->first();
                if($checkCounterEntry) 
                {
                    if($date != date('Y-m-d', strtotime($checkCounterEntry->updated_at))) 
                    {
                        $checkCounterEntry->increment('count');
                    }
                }
            }
            // If person is not in database yet, create it
            else 
            {
                $country = "unknown";
                $countryCode = "unknown";
        
                $url = "http://ip-api.com/json/" . $remoteIP . "?fields=status,country,countryCode";
                $json = file_get_contents($url);
                $obj = json_decode($json);
                
                if($obj != null && $obj->status != "fail") 
                {
                    $country = $obj->country; 
                    $countryCode = $obj->countryCode;
                }
        
                $iptrack = new IP;
                $iptrack->ipaddress = $remoteIP;
                $iptrack->country = $country;
                $iptrack->countryCode = $countryCode;
                $iptrack->save();

                $checkEntries = IP::where('ipaddress', $remoteIP)->first();
                $counter = new IPCount;
                $counter->id_web_stats_ip = $checkEntries->id;
                $counter->save();
            }
        }*/

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
