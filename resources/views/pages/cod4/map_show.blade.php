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
		document.write(formattedTime);
	}
</script>
<style>
@media (max-width: 479px) {
	td:nth-of-type(1):before { content: "#"; }
	td:nth-of-type(2):before { content: "player"; }
	td:nth-of-type(3):before { content: "route"; }
	td:nth-of-type(4):before { content: "time"; }
	td:nth-of-type(5):before { content: "rpg"; }
	td:nth-of-type(6):before { content: "save/load"; }
	td:nth-of-type(7):before { content: "hax/ele"; }
	td:nth-of-type(8):before { content: "recorded"; }
}

@media (max-width: 479px) {
	h3 {
		font-size: 16px;
		padding-top: 8px;
	}
}

</style>
<section id="maps">
		@if($mapRoutes)
		<div class="description-box">
			<img src="/Images/logos/3xp.svg" height="90" width="210" style="margin-top:20px;">
			<img src="/Images/logos/codjumper.png" alt="codjumper" style="margin-top:20px;">
			<h2 style="margin-bottom: 20px;">
				<a href="/cod4/map/{{$mapRoutes['name']}}">{{$mapRoutes['name']}}</a> -
				@if($mapRoutes['mapper'])
					by {{$mapRoutes['mapper']}}
				@endif 
			</h2>
		</div>

		<div class="hr"></div>

		<div class="description-box">
			<div class="row quickInfo" style="top: 10px;">
				<div class="col-4 no-mobile" style="margin: auto;">
					@include('inc.route_chart')
				</div>
				<div class="col-8">
					<p style="margin-top: 20px;">{{$mapRoutes['name']}} has got {{count($mapRoutes['routes_external'])}} routes ({{$mapRoutes['totalRuns']}} runs in total)</p>
					<p style>
						@if(count($mapRoutes['routes_external']))
						<div class="row" style="text-align: left; line-height: 0.5;">
							<div class="col-4">
								<p style="font-weight: bold;">Route</p>
								@foreach($mapRoutes['routes_external'] as $route)
								<p><a href="/cod4/route/{{$route['id']}}">{{$route["name"]}}</a>
									@if(count($route["count_runs"]) > 0)
										({{$route["count_runs"][0]["runs"]}} runs)
									@else
										(0 runs)
									@endif
								</p>
								@endforeach
							</div>
							<div class="col-4">
								<p style="font-weight: bold;">#1 Time</p>
								@foreach($mapRoutes['routes_external'] as $route)
								@if($route["routes_internal"]["top_time_player"])
									<p><a href="/cod4/statistics/{{$route["routes_internal"]["top_time_player"][0]['guidShort']}}">
									{{$route["routes_internal"]["top_time_player"][0]["alias"]}}</a>
									(<script type="text/javascript">msToHMS("{{$route["routes_internal"]["toptime"]}}");</script>)</p>
								@else
									<p>alias unknown </p>
								@endif
								@endforeach
							</div>
							<div class="col-4">
								<p style="font-weight: bold;">#1 RPG</p>
								@foreach($mapRoutes['routes_external'] as $route)
								<p>
									@if(count($route["routes_internal"]["top_r_p_g_player"]) > 0)
									<a href="/cod4/statistics/{{$route["routes_internal"]["top_r_p_g_player"][0]['guidShort']}}">{{$route["routes_internal"]["top_r_p_g_player"][0]["alias"]}}</a> ({{$route["routes_internal"]["topRPG"]}})
									@else
										not available
									@endif
								</p>
								@endforeach
							</div>
						</div>
						@endif
					</p>
					@if($mapRoutes['mapper'])
						<p>It was created by {{$mapRoutes['mapper']}}
						@if($mapRoutes['release_date'])
							and published on
							<script type="text/javascript">
								const date = new Date("{{$mapRoutes['release_date']}}");
								const options = { year: 'numeric', month: 'long', day: 'numeric' };
								document.write(date.toLocaleDateString('en-us', options));
							</script>
						@endif
						</p>
					@else 
						@if($mapRoutes['release_date'])
							<p>It was published on {{$mapRoutes['release_date']}}</p>
						@endif
					@endif
				</div>
				</div>
			</div>
			
			<div class="hr"></div>

			<div class="inputSearchEngine">
				<input type="text" id="searchInput" onkeyup="filterMaps()" placeholder="search for player or route name" style="height: 50px; font-size:18px;">
			</div>
			
			<div class="hr"></div>

			<div class="card table-responsive" style="min-width:100%;">
				<table class="table table-hover table-sm" id="runsTable">
					<thead class="no-mobile">
						<tr class="header">
							<th scope="col">#</th>
							<th scope="col">Player</th>
							<th scope="col">Route</th>
							<th scope="col">Time</th>
							<th scope="col">RPG</th>
							<th scope="col">Saves/Loads</th>
							<th scope="col">Hax/Ele</th>
							<th scope="col">Recorded</th>
						</tr>
					</thead>
					<tbody>
					@foreach($runs as $key=>$run)
						<tr>
							<td scope="row">{{$key+1}}</td>
							@if($run['guid'])
								<td><a href="/cod4/statistics/{{$run['guid']['guidShort']}}">{{$run['guid']['alias']}}</a></td>
							@else 
								<td>alias unknown</td>
							@endif
							<td><a href="/cod4/route/{{$run['way_id']}}">{{$run['route']}}</a></td>
							<td>
								<script type="text/javascript">										
									msToHMS("{{$run['time']}}");
								</script>
							</td>
							<td>{{$run['rpgs']}}</td>
							<td>{{$run['saves']}}/{{$run['loads']}}</td>
							<td>
								@if($run['haxfps'] == 1)
									hax
								@endif
								@if($run['ele'] == 1 && $run['haxfps'] == 1)
									+
								@endif
								@if($run['ele'] == 1)
									ele
								@endif
								
								@if($run['ele'] == 0 && $run['haxfps'] == 0)
									legit
								@endif
							</td>
							<td>{{$run['created_date']}}</td>
						</tr>
					@endforeach
					</tbody>
				</table>
			</div>
		@else
			<p>{{$mapName}} is not available. Maybe it is not public yet?</p>
			<a href="javascript:history.go(-1)">Go back</a>
		@endif
		<script>
			const table = document.getElementById("runsTable");
			const tr = table.getElementsByTagName("tr");
			function filterMaps() {
				const input = document.getElementById("searchInput");
				const filter = input.value.toUpperCase();

				const hasFilter = (node) => {
					const value = node.textContent || node.innerText;
					return value.toUpperCase().indexOf(filter) > -1;
				};

				for (i = 1; i < tr.length; i++) {
					const [, name, route] = tr[i].getElementsByTagName("td");

					if (hasFilter(name) || hasFilter(route)) {
					tr[i].style.display = "";
					} else {
					tr[i].style.display = "none";
					}
				}
			}
			</script>
	</section>
	
@endsection