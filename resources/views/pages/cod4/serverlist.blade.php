<!-- @extends('layouts.main') -->

@section('content')

<style>
#maps .content-box p, h1, td, tr {
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


</style>
<section id="maps">
	{{-- <div class="container"> --}}
		<div class="content-box-title">
			<div class="row justify-content-md-center" style="padding-top: 8px;">
				<h3>serverlist</h3>
			</div>
		</div>
		<table class="table table-hover" id="mapsTable" style="table-layout: fixed;">
			<thead class="no-mobile">
				<tr>
					<th>map</th>
					<th></th>
					<th>players</th>
					<th>ip:port</th>
				</tr>
			</thead>
			<tbody>
				<tr>				
					<td>
						<div class="table-map-img" style="position: relative; max-width: 200px;">
							@php 
							if(isSet($server_3xp_cj_data['rcon'])) {
								$loadscreen = $server_3xp_cj_data['rcon']['serv']['mapname'];								
								if(!file_exists("/Images/cod4/loadscreens/$loadscreen.png")) {
									$loadscreen = "no_loadscreen";
								} 
							}
							else {
								$loadscreen = "no_loadscreen";
							}

							@endphp
							<img src="/Images/cod4/loadscreens/{{$loadscreen}}.png" height="112" width="200">
							<div class="trapeziumTopLeft" style="position: absolute;">
								@php if(isSet($server_3xp_cj_data['rcon']))
									echo '<div class="textTopLeft"><a style="position: absolute; color: #FFF; text-transform: none;" href="/cod4/map/' . $server_3xp_cj_data["rcon"]["serv"]["mapname"] . '">' . $server_3xp_cj_data["rcon"]["serv"]["mapname"]. '</a></div>';
								@endphp
							</div>
						</div>
					</td>
					<td class="leaveFull">
						<div class="row" style="margin:auto;">
							<div class="col" style="max-width: 70px;">
								<img src="/Images/cod4/icons/3xp_128px.png" alt="3xp_logo" width="45px" height="45px" style="margin-right:20px;">
							</div>					
							<div class="col">
								@php if(isSet($server_3xp_cj_data['rcon']))
									echo $server_3xp_cj_data['serverName'];
								@endphp
							</div>					
						</div>
					</td>

					<td style="line-height: 0.5;">
						@if(count($players) > 0)
							@php
								if(isSet($server_3xp_cj_data['rcon']))
									echo '<p style="line-height: 1;"> ' . count($players) . '/' . $server_3xp_cj_data["rcon"]["serv"]["sv_maxclients"]. ' players</p>';
							@endphp
							<span id='players-more' style='display: none;'>
							@foreach($players as $player)
								@if($player)
									<p><a href="/cod4/statistics/{{$player['guidShort']}}">{{$player['alias']}}</a></p>
								@else	
									{{-- <p><a href="/cod4/player/{{$player['guidShort']}}">{{$player['alias']}}</a></p> --}}
								@endif
							@endforeach
							</span>
							<input type="button" style="text-align: center; margin-top: 10px;" onclick="showMore('players-more', 'players-button')" class="btn btn-outline-dark me-2" id='players-button' value='show playerlist'>
						@endif
					</td>
					<td>
						{{$server_3xp_cj_data['serverIP']}}:{{$server_3xp_cj_data['serverPort']}}
					</td>
				</tr>
				@foreach($servers as $serverKey=>$server)
				<tr>				
					<td>
						<div class="table-map-img" style="position: relative; max-width: 200px;">
							@php 
								$loadscreen = $server['currentMap'];
								if(!file_exists("Images/cod4/loadscreens/$loadscreen.png")) {
									$loadscreen = "no_loadscreen";
								} 
							@endphp
							<img src="/Images/cod4/loadscreens/{{$loadscreen}}.png" height="112" width="200">
							<div class="trapeziumTopLeft" style="position: absolute;">
								<div class="textTopLeft"><a style="position: absolute; color: #FFF; text-transform: none;" href="/cod4/map/{{$server['currentMap']}}">{{$server['currentMap']}}</a></div>
							</div>
						</div>
					</td>
					<td>
						<div class="row" style="margin:auto;">
							<div class="col" style="max-width: 70px;">
								<img src="/Images/cod4/icons/{{$server['owner']}}_128px.png" alt="3xp_logo" width="45px" height="45px" style="margin-right:20px;">
							</div>					
							<div class="col">
								{{$server['currentMOTD']}}
							</div>					
						</div>
					</td>

					<td style="line-height: 0.5;">
						@if($server['get_current_players'])
							<p style="line-height: 1;">{{count($server['get_current_players'])}}/{{$server['maxClients']}} players</p>						
							<span id='players-more{{$serverKey}}' style='display: none;'>
							@if(count($players) > 0)
								@foreach($server['get_current_players'] as $player)
									<p>{{$player['player']}}</p>		
								@endforeach
							@endif
							</span>
							<input type="button" style="text-align: center; margin-top: 10px;" onclick="showMore('players-more{{$serverKey}}', 'players-button{{$serverKey}}')" class="btn btn-outline-dark me-2" id='players-button{{$serverKey}}' value='show playerlist'>
						@else
							<p style="line-height: 1;">0/{{$server['maxClients']}} players</p>		
						@endif
					</td>
					<td>
						{{$server['ip']}}:{{$server['port']}}
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
		
		@php
			// var_dump($server_3xp_cj_data);
		@endphp
	{{-- </div> --}}
</section>
<script> 
	function showMore(moreText, btnText) {
		var moreText = document.getElementById(moreText);
		var btnText = document.getElementById(btnText);

		if (moreText.style.display === "none") {
			btnText.value = "hide playerlist";
			moreText.style.display = "inline";
		} else {
			btnText.value = "show playerlist";
			moreText.style.display = "none";
		}
	}
</script>
@endsection