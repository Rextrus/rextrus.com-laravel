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
</script>
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
		{{-- @if(count($mapsData) > 0) --}}
			<div class="content-box-title">
				<div class="row" style="padding-top: 8px;">
					<h3>codjumper statistics</h3>
				</div>
			</div>
			<div class="content-box-desc">
				Test
			</div>
			<div class="content-box-info">
				<div class="row" style="padding-top: 25px;">
					<div class="col-sm-4">
						<p>TBD total runs</p>
					</div>
					<div class="col-sm-4">
						<p>
						</p>
					</div>
					<div class="col-sm-4">
						<p>
						</p>
					</div>
                    <p>Note: Only maps which can be played in speedrun are displayed</p>
				</div>
			</div>
			
			<div class="inputSearchEngine">
				<input type="text" id="searchInput" onkeyup="filterMaps()" placeholder="Search for maps or route name">
			</div>
			
			<form action="/cod4/map" method="get">
			<table class="table table-hover" id="mapsTable">
				<thead class="no-mobile">
					<tr>
						<th scope="col">#</th>
						<th scope="col">map</th>
						<th scope="col">routes</th>
						<th scope="col">personal best</th>
					</tr>
				</thead>
				<tbody>
				@foreach($mapsData as $key=>$map)
                @if($map["routes_external"] != null)
					<tr>
						<td scope="row">{{$key+1}}</td>
						<td><a href="/cod4/map/{{$map['name']}}">{{$map['name']}}</a> </td>
						<td>
                            @foreach($map["routes_external"] as $route)
                            <div class="row">
                                <div class="col-sm-4">
                                    <a href="/cod4/route/{{$route['id']}}">{{$route['name']}}</a>
                                </div>
                                <div class="col-sm-2">
                                    @if(isset($route['best_run_by_time']))
                                    
                                    <script type="text/javascript">
                                        msToHMS("{{$route['best_run_by_time']['time']}}");
                                    </script>
                                    @endif
                                </div>


                            </div>
                            @endforeach
						</td>
						<td>
							@if($map['release_date'] == "1998-11-28")
								unknown
							@else 
								{{$map['release_date']}}
							@endif
						</td>

					</tr>
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