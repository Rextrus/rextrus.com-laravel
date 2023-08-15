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
		document.write("(" + formattedTime + ")");
	}
</script>

@php

if(isSet($_GET['map'])) {
	$map = $_GET['map'];
	// App\Http\Controllers\cod4\MapsController::downloadMap($map);

	echo "<script>
	var popout = window.open('http://www.rextrus.com/cod4/map/download/$map.php');
	window.setTimeout(function(){
		popout.close();
	}, 1000);

	</script>";

}


@endphp


<style>

body {
	background: #0D1017;
	background: -moz-linear-gradient(top, #0D1017 9%, #1b2637 23%, #0c0f16 100%);
	background: -webkit-linear-gradient(top, #0D1017 9%, #1b2637 23%, #0c0f16 100%);
	background: linear-gradient(to bottom, #0D1017 9%, #1b2637 23%, #0c0f16 100%);
    background-repeat: no-repeat;
    background-attachment: fixed;
}

#map .content-box-desc .chart_div {
	margin: auto;
}

#map .content-box-desc {
	
	background-color: #14171c !important;
}

@media (max-width: 479px) {
	td:nth-of-type(1):before { content: "#"; }
	td:nth-of-type(2):before { content: "map"; }
	td:nth-of-type(3):before { content: "author"; }
	td:nth-of-type(4):before { content: "release date"; }
}

</style>
<section id="maps">
		@if(count($maps) > 0)
			<div class="content-box-title">
				<div class="row" style="padding-top: 8px;">
					<h3>codjumper maps</h3>
				</div>
			</div>
			<div class="content-box-desc">
				<div class="row quickInfo" style="top: 10px;">
					<div class="col-sm-4 chart no-mobile">
						@include('inc.map_chart')
						<div id="chart_div" style="margin: auto;"></div>
					</div>
					<div class="col-sm-4 left">
						<p style="margin-top: 10px;">popular maps</p>
						<p>
							@foreach($popularMaps as $key=>$popularMap)
								#{{$key+1}} <a href="/cod4/map/{{$popularMap['name']}}">{{$popularMap["name"]}}</a> - {{$popularMap["totalRuns"]}} runs<br>
							@endforeach
						</p>
					</div>
					<div class="col-sm-4 right" >
						<p style="margin-top: 10px;">latest maps</p>
						<p>
							@foreach($latestMaps as $key=>$latestMap)
							@php
								if(!$latestMap['date'])
									$mapAdded = "long time";
								else {
									$now = time();
									$releaseTime = strtotime($latestMap['date']);
									$datediff = $now - $releaseTime;
									$days = floor($datediff / (60 * 60 * 24));
									$hours = floor($datediff / (60 * 60));
									$minutes = floor($datediff / (60));

									if($days < 1) {
										if($hours < 0) {
											if($minutes != 0)
												$mapAdded = "$minutes minutes";
										} elseif($hours == 1) {
											$mapAdded = "$hours hour";
										}  else {
											$mapAdded = "$hours hours";
										}
									} elseif($days == 1) {
										$mapAdded = "$days day";
									} else {
										$mapAdded = "$days days";
									}
								}
							@endphp
								<a href='/cod4/map/{{$latestMap['name']}}'>{{$latestMap['name']}}</a> - {{$mapAdded}} ago<br>
							@endforeach
						</p>
					</div>
				</div>
			</div>
			<div class="content-box-info">
				<div class="row" style="padding-top: 25px;">
					<div class="col-sm-4">
						<p>{{count($maps)}} maps</p>
					</div>
					<div class="col-sm-4">
						<p>
							@php
								$count = 0;
								foreach($maps as $map) {
									$count += $map['totalRuns'];
								}
								echo $count . " runs";
							@endphp
						</p>
					</div>
					<div class="col-sm-4">
						<p>
							@php
								$count = 0;
								foreach($maps as $map) {
									$count += $map['download'];
								}
								echo $count . " downloads";
							@endphp
						</p>
					</div>
				</div>
			</div>
			
			<div class="inputSearchEngine">
				<input type="text" id="searchInput" onkeyup="filterMaps()" placeholder="Search for maps or route name">
			</div>
			
			<form action="/cod4/map" method="get">
			<table class="table table-hover table-sm" id="mapsTable">
				<thead class="no-mobile">
					<tr>
						<th scope="col">#</th>
						<th scope="col">map</th>
						<th scope="col">author</th>
						<th scope="col">release date</th>
						<th scope="col no-mobile">action</th>
					</tr>
				</thead>
				<tbody>
				@foreach($maps as $key=>$map)
					@if(count($map["routes_external"]) > 0)
						<tr data-toggle="collapse" data-target="#demo{{$key}}" class="accordion-toggle content">
					@else 
						<tr>
					@endif
						<td scope="row">{{$key+1}}</td>
						<td><a href="/cod4/map/{{$map['name']}}">{{$map['name']}}</a> </td>
						<td>
							{{$map['mapper']}}
						</td>
						<td>
							@if($map['release_date'] == "1998-11-28")
								unknown
							@else 
								{{$map['release_date']}}
							@endif
						</td>
						<td class="no-mobile">
							{{-- <input type='submit' class="btn btn-outline-dark me-2 greyText" name='map' style='cursor:pointer;' value='{{$map['name']}}'> --}}
							{{-- <button type="submit" class="btn btn-outline-dark me-2">Download</button> --}}
							<a target="_blank" type="button" class="btn btn-outline-dark me-2" href="/cod4/map/download/{{$map['name']}}">Download</a>
						</td>
					</tr>

					<tr class="no-mobile">
						<td colspan="12" class="hiddenRow">
						<div class="accordian-body collapse" id="demo{{$key}}"> 
							@if(count($map["routes_external"]) > 0)
							<table class="table table-padding table-colored table-sm">
								<thead>
									<tr class="info">
										<th class="col-route">Route</th>
										<th class="col-runs">Runs</th>
										<th class="col-top">#1 Time</th>	
										<th class="col-top">#1 RPG</th>	
										<th class="col-action">YouTube</th>	
									</tr>
								</thead>		
								<tbody>
								@if($map["routes_external"])
									@foreach($map["routes_external"] as $routeInfo)
									<tr data-toggle="collapse"  class="accordion-toggle" data-target="#demo{{$key}}">
										<td class="mapsChild"><a href="/cod4/route/{{$routeInfo['id']}}">{{$routeInfo['name']}}</a></td>
										@if(count($routeInfo["count_runs"]) > 0)
											<td>{{$routeInfo["count_runs"][0]["runs"]}}</td>
										@else
											<td>0</td>
										@endif

										@if(count($routeInfo["routes_internal"]["top_time_player"]) > 0)
											<td class="col-top"><a href="/cod4/statistics/{{$routeInfo["routes_internal"]["top_time_player"][0]["guidShort"]}}">{{$routeInfo["routes_internal"]["top_time_player"][0]["alias"]}}</a>
												<script type="text/javascript">										
													msToHMS("{{$routeInfo["routes_internal"]["toptime"]}}");
												</script>
											</td>
										@else
											<td class="col-top">alias unknown</td>
										@endif

										@if(count($routeInfo["routes_internal"]["top_r_p_g_player"]) > 0)
											<td class="col-top"><a href="/cod4/statistics/{{$routeInfo["routes_internal"]["top_r_p_g_player"][0]["guidShort"]}}">{{$routeInfo["routes_internal"]["top_r_p_g_player"][0]["alias"]}}</a> ({{$routeInfo["routes_internal"]["topRPG"]}})</td>
										@else
											<td class="col-top">not available</td>
										@endif

										@if($routeInfo["routes_internal"]["walkthrough"] > 0)
											<td><a target="_blank" type="button" class="btn btn-outline-dark me-2" href="https://www.youtube.com/watch?v={{$routeInfo["routes_internal"]["walkthrough"]}}">&#x2192;</a></td>
										@else
											<td class="col-top"></td>
										@endif
									</tr>
									@endforeach
								@else
									<td>0</td>
								@endif
								</tbody>
							</table>
							@endif
						</div> 
						</td>
					</tr>
				@endforeach
				</tbody>
			</table>
			</form>
			<hr>
			@else
				<p>No maps found</p>
			@endif
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