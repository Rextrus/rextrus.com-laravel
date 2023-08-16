<!-- @extends('layouts.main') -->

@section('content')

<style>
#serverlist h1, #serverlist td, #serverlist tr {
	color: #bbbaba;
	text-transform: none;
}

img .bigger {
    height: 600px;
    width: 600px;
}

table tr th:nth-child(1){
	width: 250px;
}

table tr th:nth-child(3){
	width: 20%;
}


@media (max-width: 479px) {

	tbody img {
		max-width: 100%;
	}
	#maps .table-map-img .trapeziumTopLeft {
		max-width: 100% ;
		/* width: 100px; */
	}

	tbody td:nth-child(2) {
		padding-left: 0% !important; 
	}

	td:nth-of-type(1):before { content: "map"; }
	/* td:nth-of-type(2):before { content: ""; } */
	td:nth-of-type(3):before { content: "players"; }
	td:nth-of-type(4):before { content: "ip:port"; }
}


.tooltip-inner  {
	line-height: 1.3px !important;
	max-width: 350px !important;
    width: 150px !important; 
	background: #11121a !important;
	text-align: left !important;
}
.tooltip-inner a {
	color: white !important;
	font-size: 16px !important;
} 

.tooltiplist {
	margin-top: 10px !important;
}




</style>
<section id="serverlist">
    <div class="description-box">
        <img src="/Images/logos/codjumper.png" alt="codjumper" style="margin-top:20px;">
        <h2 style="margin-bottom: 20px;">serverlist</h2>
    </div>
    <div class="hr"></div>
    <div class="card table-responsive" style="min-width:100%; top: 10px;">
        <table class="table table-fixed table-hover">
            <thead>
                <tr>
                    <th style="width:5%;"></th>
                    <th style="width:30%;">Server</th>
                    <th style="width:5%;">Country</th>
                    <th>State</th>
                    <th>Players</th>
                    <th>Map</th>
                    <th>IP Address</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        
                        <img src="/Images/cod4/icons/3xp_128px.png" alt="3xp_logo" width="40px" height="40px" style="float:left;">
                    </td>
                    <td id="server-3xp-name">
                        @if(isset($server_3xp_cj_data['rcon']))
                            {{ $server_3xp_cj_data['serverName'] }}
                        @endif
                    </td>
                    <td class="col-xs-1"><img src="https://flagsapi.com/FR/shiny/32.png"></td>
                    <td id="server-3xp-state">
                        @if(isset($server_3xp_cj_data['rcon']) && count($players) > 0)
                            <img src="/Images/icons/online.png" alt="online" width="30px" height="30px">
                        @else
                            <img src="/Images/icons/offline.png" alt="offline" width="30px" height="30px">
                        @endif
                    </td>
                    <td id="server-3xp-players">
                        @if(count($players) > 0)
                            @php
                                $playerList = "<div class='tooltiplist'>";
                                foreach($players as $player) {
                                    if($player) {
                                        $guidShort = $player['guidShort'];
                                        $alias = $player['alias'];
                                        $playerList .= "<p><a href='/cod4/statistics/$guidShort'>$alias</a></p>";
                                    }
                                }
                                if(isSet($server_3xp_cj_data['rcon']))
                                    echo '<a href="#" class="tooltip-css" data-bs-html="true" data-toggle="tooltip" title="' . $playerList . '</div>">' . count($players) . '/' . $server_3xp_cj_data["rcon"]["serv"]["sv_maxclients"]. ' players</a>';
                            @endphp
                            </a>
                        @endif
                    </td>

                    {{-- <td id="server-3xp-players">
                        @if(count($players) > 0)
                            <a href="#" class="tooltip-css" data-bs-html="true" data-toggle="tooltip" title="">
                                {{ count($players) }}/{{ $server_3xp_cj_data['rcon']['serv']['sv_maxclients'] }} players
                            </a>
                        @endif
                    </td> --}}
                    <td id="server-3xp-map">
                        @if(isset($server_3xp_cj_data['rcon']))
                            <a style="color: #FFF;" href="/cod4/map/{{ $server_3xp_cj_data['rcon']['serv']['mapname'] }}">
                                {{ $server_3xp_cj_data['rcon']['serv']['mapname'] }}
                            </a>
                        @endif
                    </td>
                    <td id="server-3xp-ip">
                        {{ $server_3xp_cj_data['serverIP'] }}:{{ $server_3xp_cj_data['serverPort'] }}
                    </td>
                </tr>

                {{-- Rest of the servers --}}
				@foreach($servers as $serverKey => $server)
				<tr>
					<td>
                        @if(file_exists(public_path('/Images/cod4/icons/' . $server['owner'] . '_128px.png')))
                            <img src="/Images/cod4/icons/{{ $server['owner'] }}_128px.png" alt="{{ $server['owner'] }}_LOGO" width="40px" height="40px" style="float:left;">
                        @else
                            <img class="invert-color"  src="/Images/icons/nologo.png" alt="{{ $server['owner'] }}_LOGO" width="40px" height="40px" style="float:left;">
                        @endif
						
					</td>
					<td id="server-{{ $serverKey }}-name">
						{{ $server['currentMOTD'] }}
					</td>
					<td class="col-xs-1"><img src="https://flagsapi.com/{{ $server['country'] }}/shiny/32.png"></td>
					<td id="server-{{ $serverKey }}-state">
						@if($server['status'] == "on")
							<img src="/Images/icons/online.png" alt="online" width="30px" height="30px">
						@else
							<img src="/Images/icons/offline.png" alt="offline" width="30px" height="30px">
						@endif
					</td>
					<td id="server-{{ $serverKey }}-players">
						@php
						$playerList = "<div class='tooltiplist'>";
						$currentPlayers = $server->getCurrentPlayers->toArray(); // Verwende die Methode getCurrentPlayers()
						
						if(!empty($currentPlayers)) {
							if(count($currentPlayers) > 0) {
								foreach($currentPlayers as $player) {
									if($player) {
										$alias = $player['player'];
										$playerList .= "<p>$alias</p>";
									}
								}
								echo '<a href="#" class="tooltip-css" data-bs-html="true" data-toggle="tooltip" title="' . $playerList . '</div>">' . count($currentPlayers) . '/' . $server['maxClients'] . ' players'. '</a>';
							}
						} else {
							echo '0/' . $server['maxClients'] . ' players';
						}
						@endphp
					</td>
					<td id="server-{{ $serverKey }}-map">
						<a style="color: #FFF;" href="/cod4/map/{{ $server['currentMap'] }}">
							{{ $server['currentMap'] }}
						</a>
					</td>
					<td id="server-{{ $serverKey }}-ip">
						{{ $server['ip'] }}:{{ $server['port'] }}
					</td>
				</tr>
				@endforeach
            </tbody>
        </table>
    </div>
</section>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script>
$(document).ready(function() {
    // Funktion zum Aktualisieren der Webseite mit den neuen Daten

    function updatePage(data) {
			$('[data-toggle="tooltip"]').tooltip('dispose');
        // Aktualisiere die 3XP-CJ-Serverdaten
        if (data.server_3xp_cj_data) {
            // Aktualisiere den Servernamen
            $("#server-3xp-name").text(data.server_3xp_cj_data.serverName);

            // Aktualisiere den Serverzustand
            if (data.players.length > 0) {
                $("#server-3xp-state").html('<img src="/Images/icons/online.png" alt="3xp_logo" width="30px" height="30px">');
            } else {
                $("#server-3xp-state").html('<img src="/Images/icons/offline.png" alt="3xp_logo" width="30px" height="30px">');
            }

            // Aktualisiere die Spieleranzahl
            var playerList = "";
            if (data.players.length > 0) {
                playerList = '<div class="tooltiplist">';
                data.players.forEach(function(player) {
                    playerList += '<p>' + player.alias + '</p>';
                });
                playerList += '</div>';
            }
            var playersText = data.players.length + '/' + data.server_3xp_cj_data.rcon.serv.sv_maxclients + ' players';
            $("#server-3xp-players a").attr('title', playerList).text(playersText);

            // Aktualisiere die Karteninformation
            $("#server-3xp-map a").attr("href", "/cod4/map/" + data.server_3xp_cj_data.rcon.serv.mapname);
            $("#server-3xp-map a").text(data.server_3xp_cj_data.rcon.serv.mapname);

            // Aktualisiere die IP-Adresse
            $("#server-3xp-ip").text(data.server_3xp_cj_data.serverIP + ":" + data.server_3xp_cj_data.serverPort);
        }

        // Aktualisiere die Serverliste
        if (data.servers) {
			data.servers.forEach(function(server, index) {
                var serverKey = index;

                // Aktualisiere den Servernamen
                $("#server-" + serverKey + "-name").text(server.currentMOTD);

                // Aktualisiere den Serverzustand
                var stateElement = $("#server-" + serverKey + "-state");
                if (server.status == "on") {
                    stateElement.html('<img src="/Images/icons/online.png" alt="online" width="30px" height="30px">');
                } else {
                    stateElement.html('<img src="/Images/icons/offline.png" alt="offline" width="30px" height="30px">');
                }

                // Aktualisiere die Spieleranzahl
				var playersElement = $("#server-" + serverKey + "-players");
				if (server.get_current_players) {
					var playerList = $('<div class="tooltiplist">');
					// playerList = JSON.stringify(playerList);
					playerList = playerList.toString();
					
					console.log(typeof playerList);
					if (server.get_current_players.length > 0) {
						server.get_current_players.forEach(function(player) {
							if (player) {
								var alias = player.player;
								playerList += '<p>' + alias + '</p>';
							}
						});
						playerList = playerList.replace('[object Object]', '');
						console.log(playerList);
						playersElement.html('<a href="#" class="tooltip-css" data-bs-html="true" data-toggle="tooltip" title="' + playerList + '">' + server.get_current_players.length + '/' + server.maxClients + ' players' + '</a></div>');
					} else {
						playersElement.html('0/' + server.maxClients + ' players');
					}
				} else {
					playersElement.empty();
				}
                // Aktualisiere die Karteninformation
                var mapElement = $("#server-" + serverKey + "-map");
                mapElement.find("a").attr("href", "/cod4/map/" + server.currentMap);
                mapElement.find("a").text(server.currentMap);

                // Aktualisiere die IP-Adresse
                $("#server-" + serverKey + "-ip").text(server.ip + ":" + server.port);
            });
        }
		
		// Tooltip initialisieren
		$('[data-toggle="tooltip"]').tooltip({ html: true });
    }

    // Funktion zum Abrufen und Aktualisieren der Daten
    function fetchData() {
      $.ajax({
		url: "/",
        method: "GET",
        dataType: "json",
        success: function(response) {
          updatePage(response);
        },
        error: function() {
          // Behandlung von Fehlern
        }
      });
    }

	$('[data-toggle="tooltip"]').tooltip({ html: true });
    // Rufe die fetchData-Funktion in regelmäßigen Intervallen auf
    setInterval(fetchData, 10000); // Polling-Intervall von 5 Sekunden

});
</script>
@endsection