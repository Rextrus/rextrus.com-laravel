<?php

namespace App\Http\Controllers\cod4;

use App\Http\Controllers\Controller;
use App\Models\cod4\Server;
use App\Models\cod4\Player;
use Illuminate\Http\Request;

class ServersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function index()
    // {
        /*
        $servers = Server::with('getCurrentPlayers')->where('priority', '>', 0)->where('gametype', 'cj')->whereNot('id', 8)->get();
        // $servers = Server::with('getCurrentPlayers')->get();
        // $servers = ServerPlayers::with('getCurrentPlayers')->get();
        // return response()->json($servers);

        $server_3xp_cj_data = NULL;
        $server_3xp_cj = "https://dev.api.3xp-clan.com/v1/server/7";
        $arrContextOptions=array(
            "ssl"=>array(
                "verify_peer"=>false,
                "verify_peer_name"=>false,
            ),
        );  
        
        $server_3xp_cj = file_get_contents($server_3xp_cj, false, stream_context_create($arrContextOptions));
        if(!is_null($server_3xp_cj)) {
            $server_3xp_cj_data = json_decode($server_3xp_cj, true);
        }
        
        if(isSet($server_3xp_cj_data['rcon'])) {
            foreach($server_3xp_cj_data['rcon']['clients'] as $key=>$client) {
                $players[$key] = Player::where('guidShort', $client['clientGUIDShort'])->first();
            }
        }
        if(!isset($players)) {
            $players[0] = 0;
        }

        $data = [
            'servers'  => json_decode($servers, true),
            'server_3xp_cj_data' => $server_3xp_cj_data,
            'players'  => $players           
        ];
        
        return view('pages.cod4.serverlist')->with($data);
        // return response()->json($players);
        */

    public function index(Request $request)
    {
        $servers = Server::with('getCurrentPlayers')->where('priority', '>', 0)->where('gametype', 'cj')->where('id', '!=', 8)->get();
        
        $server_3xp_cj_data = null;
        $server_3xp_cj = "https://dev.api.3xp-clan.com/v1/server/7";
        $arrContextOptions = array(
            "ssl" => array(
                "verify_peer" => false,
                "verify_peer_name" => false,
            ),
        );  
        
        $server_3xp_cj = file_get_contents($server_3xp_cj, false, stream_context_create($arrContextOptions));
        
        if (!is_null($server_3xp_cj)) {
            $server_3xp_cj_data = json_decode($server_3xp_cj, true);
        }
        
        $players = [];

        if (isset($server_3xp_cj_data['rcon'])) {
            foreach ($server_3xp_cj_data['rcon']['clients'] as $key => $client) {
                $players[$key] = Player::where('guidShort', $client['clientGUIDShort'])->first();
            }
        }

        $data = [
            'servers' => $servers,
            'server_3xp_cj_data' => $server_3xp_cj_data,
            'players' => $players           
        ];

        if ($request->ajax()) {
            return response()->json($data);
        }

        return view('pages.cod4.serverlist')->with($data);
    }

        

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   
}
