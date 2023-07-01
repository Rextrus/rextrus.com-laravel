<!-- @extends('layouts.main') -->

@section('content')

<script type="text/javascript">
	function msToHMS(ms) {
		const seconds = Math.floor((ms / 1000) % 60);
		const minutes = Math.floor((ms / 1000 / 60) % 60);
		const hours = Math.floor((ms / 1000 / 60 / 60));
		const formattedTime = [
			hours.toString().padStart(2, "0"),
			minutes.toString().padStart(2, "0"),
			seconds.toString().padStart(2, "0")
		].join(":");
		document.write(formattedTime);
	}

	function showMore(moreText, btnText) {
		var moreText = document.getElementById(moreText);
		var btnText = document.getElementById(btnText);

		if (moreText.style.display === "none") {
			btnText.value = "show less";
			moreText.style.display = "inline";
		} else {
			btnText.value = "show more";
			moreText.style.display = "none";
		}
	}
</script>
<style>

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
</style>
<section id="maps">
			@if(count($players) > 0)


			<div class="content-box-title">
				<div class="row justify-content-md-center" style="padding-top: 8px;">
					<div class="col-1" style="left: 10px; margin-top:5px;">
						<a href="javascript:history.go(-1)">&#x2190;</a>
					</div>
					<div class="col-10">
						<h3>runs from <a href="/cod4/statistics/{{$players['guidShort']}}">{{$players['alias']}}</a></h3>
					</div>
					<div class="col-1"></div>
				</div>
			</div>			
			<div class="content-box-title">
				<p  style="padding-top: 12px;">
					click <a href="/cod4/statistics/{{$players['guidShort']}}">here</a> to see {{$players['alias']}} statistics 
				</p>
			</div>
			{{-- <div class="content-box-desc">
				<div class="row" style="margin-top: 20px;text-align: center;">
					<p style="text-align: center;margin-bottom: 15px;">quick statistics</p>
				</div>
				<div class="row" style="margin-bottom: 25px; text-align: left; line-height: 0.5;">
					<div class="col topTime">
						<p style="font-weight: bold;">#1 Time from {{$players['alias']}}</p>

						@foreach($players['top_time_player'] as $key=>$route)
							@if($key < 11)
								<p><a href="/cod4/map/{{$route['map_external']['mapname']}}">{{$route['map_external']['mapname']}}</a> - <a href="/cod4/route/{{$route['id_3xp_way']}}">{{$route["name"]}}</a></p>
							@elseif($key == 11)
								<span id='top-time-more' style='display: none;'>
							@elseif($key == count($players['top_time_player']) - 1)
								</span>
							@else
								<p><a href="/cod4/map/{{$route['map_external']['mapname']}}">{{$route['map_external']['mapname']}}</a> - <a href="/cod4/route/{{$route['id_3xp_way']}}">{{$route["name"]}}</a></p>
							@endif						
						@endforeach
						@if(count($players['top_time_player']) > 10)
							<input type="button" style="text-align: center;" onclick="showMore('top-time-more', 'top-time-button')" class="btn btn-outline-dark me-2 greyText" id='top-time-button' value='show more'>
						@endif
					</div>
					<div class="col topRPG">
						<p style="font-weight: bold;">#1 RPG from {{$players['alias']}}</p>
						@foreach($players['top_r_p_g_player'] as $key=>$route)					
							@if($key < 11)
								<p><a href="/cod4/map/{{$route['map_external']['mapname']}}">{{$route['map_external']['mapname']}}</a> - <a href="/cod4/route/{{$route['id_3xp_way']}}">{{$route["name"]}}</a></p>
							@elseif($key == 11)
								<span id='top-rpg-more' style='display: none;'>
							@elseif($key == count($players['top_r_p_g_player']) - 1)
								</span>
							@else
								<p><a href="/cod4/map/{{$route['map_external']['mapname']}}">{{$route['map_external']['mapname']}}</a> - <a href="/cod4/route/{{$route['id_3xp_way']}}">{{$route["name"]}}</a></p>
							@endif
						@endforeach
						@if(count($players['top_r_p_g_player']) > 10)
							<input type="button" style="text-align: center;" onclick="showMore('top-rpg-more', 'top-rpg-button')" class="btn btn-outline-dark me-2 greyText" id='top-rpg-button' value='show more'>
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
							<input type="button" style="text-align: center;" onclick="showMore('longest-runs-more', 'longest-runs-button')" class="btn btn-outline-dark me-2 greyText" id='longest-runs-button' value='show more'>
						@endif
					</div>
				</div>
			</div> --}}

			<div class="inputSearchEngine">
				<input type="text" id="searchInput" onkeyup="filterMaps()" placeholder="Search for runs">
			</div>

			<table class="table table-hover" id="runsTable">
				<thead class="no-mobile">
					<tr class="header">
						<th scope="col">#</th>
						<th scope="col">map</th>
						<th scope="col">route</th>
						<th scope="col">time</th>
						<th scope="col">rpg</th>
						<th scope="col">save/loads</th>
						<th scope="col">hax/ele</th>
						<th scope="col">recorded</th>
					</tr>
				</thead>
				<tbody>
				@foreach($players['runs'] as $key=>$run)
					<tr>
						<td scope="row">{{count($players['runs'])-$key}}</td>
						<td><a href="/cod4/map/{{$run['route_external']['map']['mapname']}}">{{$run['route_external']['map']['mapname']}}</a></td>
						<td><a href="/cod4/route/{{$run['route_external']['id']}}">{{$run['route_external']['name']}}</a></td>
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

		
			<hr>
			@else
				<p>No players found</p>
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