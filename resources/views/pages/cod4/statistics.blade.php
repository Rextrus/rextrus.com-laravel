<!-- @extends('layouts.main') -->

@section('content')

<script type="text/javascript">
	function msToHMS(ms) {
		const seconds = Math.floor((ms / 1000) % 60);
		const minutes = Math.floor((ms / 1000 / 60) % 60);
		const hours = Math.floor((ms / 1000 / 60 / 60) % 24);
		const formattedTime = [
			hours.toString().padStart(2, "0"),
			minutes.toString().padStart(2, "0"),
			seconds.toString().padStart(2, "0")
		].join(":");
		document.write("" + formattedTime + "");
	}
	
	function showMore(moreText, btnText) {
		var moreText = document.getElementById(moreText);
		var btnText = document.getElementById(btnText);

		if (moreText.style.display === "none") {
			btnText.value = "collapse";
			moreText.style.display = "inline";
		} else {
			btnText.value = "expand";
			moreText.style.display = "none";
		}
	}
</script>
<style>

#map .content-box-desc {

	background-color: #14171c !important;
}

#maps .content-box-desc .topTime,.topRPG {
	left: 30px;
}

#maps .content-box-desc .longestRuns {
	right: 15px;
}

@media (max-width: 479px) {

	#maps .content-box-desc .topTime,.topRPG,.longestRuns {
		left: 15px;
		margin-bottom: 20px;
		font-size: 14px;
	}

	/* #maps .content-box-desc .longestRuns {
		right: 0px;
	} */
/*  */
	td:nth-of-type(1):before { content: "#"; }
	td:nth-of-type(2):before { content: "map"; }
	td:nth-of-type(3):before { content: "route"; }
	td:nth-of-type(4):before { content: "time"; }
	td:nth-of-type(5):before { content: "rpg"; }
	td:nth-of-type(6):before { content: "save/load"; }
	td:nth-of-type(7):before { content: "hax/ele"; }
	td:nth-of-type(8):before { content: "recorded"; }
}

@media (max-width: 479px) {
	td:nth-of-type(1):before { content: "#"; }
	td:nth-of-type(2):before { content: "map"; }
	td:nth-of-type(3):before { content: "author"; }
	td:nth-of-type(4):before { content: "release date"; }
}

</style>
<section id="maps">
		{{-- @if(count($mapsData) > 0) --}}
			<div class="content-box-title">
				<div class="row" style="padding-top: 8px;">
					<h3>codjumper statistics from {{$playerData['alias']}}</h3>
				</div>
			</div>

			<div class="content-box-desc">
				<div class="row" style="margin-top:25px;margin-bottom: 25px; text-align: left; line-height: 0.5;">
					<div class="col topTime">
						<p style="font-weight: bold;">#1 Time from {{$playerData['alias']}}</p>

						@foreach($playerData['top_time_player'] as $key=>$route)
							@if($key < 11)
								<p><a href="/cod4/map/{{$route['map_external']['mapname']}}">{{$route['map_external']['mapname']}}</a> - <a href="/cod4/route/{{$route['id_3xp_way']}}">{{$route["name"]}}</a></p>
							@elseif($key == 11)
								<span id='top-time-more' style='display: none;'>
							@elseif($key == count($playerData['top_time_player']) - 1)
								</span>
							@else
								<p><a href="/cod4/map/{{$route['map_external']['mapname']}}">{{$route['map_external']['mapname']}}</a> - <a href="/cod4/route/{{$route['id_3xp_way']}}">{{$route["name"]}}</a></p>
							@endif						
						@endforeach
						@if(count($playerData['top_time_player']) > 10)
							<input type="button" style="text-align: center;" onclick="showMore('top-time-more', 'top-time-button')" class="btn btn-outline-dark me-2 greyText" id='top-time-button' value='expand'>
						@endif
					</div>
					<div class="col topRPG">
						<p style="font-weight: bold;">#1 RPG from {{$playerData['alias']}}</p>
						@foreach($playerData['top_r_p_g_player'] as $key=>$route)					
							@if($key < 11)
								<p><a href="/cod4/map/{{$route['map_external']['mapname']}}">{{$route['map_external']['mapname']}}</a> - <a href="/cod4/route/{{$route['id_3xp_way']}}">{{$route["name"]}}</a></p>
							@elseif($key == 11)
								<span id='top-rpg-more' style='display: none;'>
							@elseif($key == count($playerData['top_r_p_g_player']) - 1)
								</span>
							@else
								<p><a href="/cod4/map/{{$route['map_external']['mapname']}}">{{$route['map_external']['mapname']}}</a> - <a href="/cod4/route/{{$route['id_3xp_way']}}">{{$route["name"]}}</a></p>
							@endif
						@endforeach
						@if(count($playerData['top_r_p_g_player']) > 10)
							<input type="button" style="text-align: center;" onclick="showMore('top-rpg-more', 'top-rpg-button')" class="btn btn-outline-dark me-2 greyText" id='top-rpg-button' value='expand'>
						@endif
					</div>
					<div class="col longestRuns">
						<p style="font-weight: bold;">Longest runs</p>
						@foreach($longestRuns['longest_runs'] as $key=>$run)					
							@if($key < 11)
								<p><a href="/cod4/map/{{$run['route_external']['map']['mapname']}}">{{$run['route_external']['map']['mapname']}}</a> - <a href="/cod4/route/{{$run['route_external']['id']}}">{{$run['route_external']['name']}}</a> (<script type="text/javascript">msToHMS("{{$run['time']}}");</script>)</p>
							@elseif($key == 11)
								<span id='longest-runs-more' style='display: none;'>
							@elseif($key == count($longestRuns['longest_runs']) - 1)
								</span>
							@else
								<p><a href="/cod4/route/{{$run['route_external']['map']['id']}}">{{$run['route_external']['map']['mapname']}}</a> - <a href="/cod4/route/{{$run['route_external']['id']}}">{{$run['route_external']['name']}}</a> (<script type="text/javascript">msToHMS("{{$run['time']}}");</script>)</p>
							@endif
						@endforeach
						@if(count($longestRuns['longest_runs']) > 10)
							<input type="button" style="text-align: center;" onclick="showMore('longest-runs-more', 'longest-runs-button')" class="btn btn-outline-dark me-2 greyText" id='longest-runs-button' value='expand'>
						@endif
					</div>
				</div>
			</div>

			<div class="content-box-info">
				<div class="row" style="padding-top: 25px;">
					<div class="col-sm-4">
						<p>{{$finishedRouteCounter}}/{{$routeCounter}} routes finished
							@php
								echo "(" . round($finishedRouteCounter/$routeCounter * 100, 2) . "%)";
							@endphp
						</p>
					</div>
					<div class="col-sm-4">
						<p>
						</p>
					</div>
					<div class="col-sm-4">
						<p>
							click <a href="/cod4/player/{{$playerData['guidShort']}}">here</a> to see all runs
						</p>
					</div>
                    <p>Note: Only maps which can be played legit in speedruns are displayed</p>
				</div>
			</div>
			
			{{-- <div class="inputSearchEngine">
				<input type="text" id="searchInput" onkeyup="filterMaps()" placeholder="Search for maps or route name">
			</div> --}}
			
			<form action="/cod4/map" method="get">
			{{-- <table class="table table-hover" > --}}
			<table class="table table-hover table-sm" id="mapsTable">
				<thead class="no-mobile">
					<tr>
						<th scope="col">#</th>
						<th scope="col">
							<div class="row">
								<div class="col-sm-4">
									route
								</div>
								<div class="col-sm-4">
									PB time
								</div>
								<div class="col-sm-4">
									PB rpg
								</div>
							</div>
						</th>
					</tr>
				</thead>
				<tbody>
				@foreach($mapsData as $key=>$map)
                @if($map["routes_external"] != null)
					@foreach($map["routes_external"] as $keytwo=>$route)
							<tr>
								@if($keytwo == 0)
									<td rowspan="{{count($map["routes_external"])}}" scope="row"><a href="/cod4/map/{{$map["name"]}}">{{$map["name"]}}</a></td>
								@endif
								{{-- <td scope="row">{{$key+1}}</td> --}}
								<td scope="row">
									<div class="row">
										<div class="col-sm-4">
											<a href="/cod4/route/{{$route['id']}}">{{$route['name']}}</a>
										</div>
										<div class="col-sm-4">
											@if(isset($route['best_run_by_time']))
											<script type="text/javascript">
												msToHMS("{{$route['best_run_by_time']['time']}}");
											</script>
											@else
												-
											@endif
										</div>
										<div class="col-sm-4">
											@if(isset($route['best_run_by_rpg']))
												{{$route['best_run_by_rpg']['rpgs']}} (<script type="text/javascript">msToHMS("{{$route['best_run_by_rpg']['time']}}");</script>)
											@else
												-
											@endif
										</div>
									</div>
								</td>
							</tr>
					@endforeach
                @endif
				@endforeach
				</tbody>
			</table>
			</form>
			<hr>
			{{-- @else
				<p>No maps found</p>
			@endif --}}
		<script>

			function filterMaps() {
				const input = document.getElementById("searchInput");
				const filter = input.value.toUpperCase();
				const table = document.getElementById("mapsTable");

				let maps = [];
				let routes = [];
				Array.from(table.rows).forEach((row, i) => {
					if (i === 0) return; // header
					i % 2 === 0 ? routes.push(row) : maps.push(row);
				});

				maps.forEach((row, i) => {
					const td = row.getElementsByTagName("td")[0];
					const td_mapper = row.getElementsByTagName("td")[1];
					const mapName = td.textContent || td.innerText;
					const mapper = td_mapper.textContent || td_mapper.innerText;

					if (mapName.toUpperCase().indexOf(filter) > -1 || mapRouteHasFilter(routes[i], filter)) {
						row.style.display = "";
						routes[i].style.display = "";
					} else if (mapper.toUpperCase().indexOf(filter) > -1 || mapRouteHasFilter(routes[i], filter)) {
						row.style.display = "";
						routes[i].style.display = "";
					} else {
						row.style.display = "none";
						routes[i].style.display = "none";
					}
				});
				}

				function mapRouteHasFilter(routes, filter) {
					const routeList = Array.from(routes.getElementsByClassName("mapsChild"));
					return routeList.some((route) => {
						const routeName = route.textContent || route.innerText;
						return routeName.toUpperCase().indexOf(filter) > -1;
					});
				}
			</script>
	</section>
	
@endsection