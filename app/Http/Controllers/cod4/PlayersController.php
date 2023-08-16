<?php

namespace App\Http\Controllers\cod4;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\cod4\Player;

class PlayersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.cod4.player');
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
            $players = Player::where('alias','LIKE','%'.$request->keyword.'%')->limit(25)->get();
        }

        return response()->json([
            'players' => $players
        ]);
     }
}
