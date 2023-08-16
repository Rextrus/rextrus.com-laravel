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

	@media (max-width: 479px) {

		#maps .content-box-desc .topTime,.topRPG,.longestRuns {
			left: 15px;
			margin-bottom: 20px;
			font-size: 14px;
		}

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
	<section id="runs">
			@if(count($players) > 0)

			<div class="description-box">
				<img src="/Images/logos/3xp.svg" height="90" width="210" style="margin-top:20px;">
				<img src="/Images/logos/codjumper.png" alt="codjumper" style="margin-top:20px;">
				<h2 style="margin-bottom: 20px;">runs from {{$players['alias']}}</h2>
				<p  style="padding-top: 12px;">
					click <a href="/cod4/statistics/{{$players['guidShort']}}">here</a> to view {{$players['alias']}} statistics 
				</p>
			</div>

			<div class="hr"></div>

			<div class="inputSearchEngine">
				<input type="text" id="searchInput" autocomplete="off" onkeyup="filterMaps()" placeholder="search for runs" style="height: 50px; font-size:18px;">
			</div>

			<div class="hr"></div>

			<div class="card table-responsive" style="min-width:100%;">
				<table class="table table-hover table-sm" id="runsTable">
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
			</div>

		
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