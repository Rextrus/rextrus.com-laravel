<?php

namespace App\Http\Controllers\cod4;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\cod4\Player;

class LeaderboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $players = Player::with('countRuns', 'topTimePlayer', 'topRPGPlayer')->get();


        $mostFirstTimes = array();
        $mostFirstRPGs = array();
        $mostRuns = array();

        foreach($players as $key=>$player) {
            if(count($player['topTimePlayer']) > 0) {
                $mostFirstTimes[$key]['amountTime1st'] = count($player['topTimePlayer']);
                $mostFirstTimes[$key]['guid'] = $player['guidShort'];
                $mostFirstTimes[$key]['alias'] = $player['alias'];
            }
            if(count($player['topRPGPlayer']) > 0) {
                $mostFirstRPGs[$key]['amountRPG1st'] = count($player['topRPGPlayer']);
                $mostFirstRPGs[$key]['guid'] = $player['guidShort'];
                $mostFirstRPGs[$key]['alias'] = $player['alias'];
            }
            if(isset($player['countRuns'][0]['runs'])) {
                $mostRuns[$key]['runs'] = $player['countRuns'][0]['runs'];
                $mostRuns[$key]['guid'] = $player['guidShort'];
                $mostRuns[$key]['alias'] = $player['alias'];
            }
        }

        array_multisort(array_column($mostFirstTimes, 'amountTime1st'), SORT_DESC, $mostFirstTimes);
        array_multisort(array_column($mostFirstRPGs, 'amountRPG1st'), SORT_DESC, $mostFirstRPGs);
        array_multisort(array_column($mostRuns, 'runs'), SORT_DESC, $mostRuns);
        
        // only get top 50 player
        $mostFirstTimes = array_slice($mostFirstTimes, 0, 50); 
        $mostFirstRPGs = array_slice($mostFirstRPGs, 0, 50); 
        $mostRuns = array_slice($mostRuns, 0, 50); 

        $data = [
            'players'  => json_decode($players, true),
            'mostRuns'   => $mostRuns,
            'mostFirstTimes'   => $mostFirstTimes,
            'mostFirstRPGs'    => $mostFirstRPGs
        ];

        return view('pages.cod4.leaderboard')->with($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($playerGuid)
    {
        $players = Player::with('runs.routeExternal.map', 'topTimePlayer.mapExternal', 'topRPGPlayer.mapExternal', 'topTimeHaxPlayer.mapExternal', 'topRPGHaxPlayer.mapExternal')
                        ->where('guidShort', $playerGuid)
                        ->first();
        
        $longestRuns = Player::with('longestRuns.routeExternal.map')
                        ->where('guidShort', $playerGuid)
                        ->first();
        

        $data = [
            'players'  => json_decode($players, true),
            'longestRuns'  => json_decode($longestRuns, true)
        ];

        // var_dump($players);
        // var_dump(json_encode($longestRuns));
        // return response()->json($players);
        return view('pages.cod4.player_show')->with($data);
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
