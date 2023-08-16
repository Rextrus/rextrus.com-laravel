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
		td:nth-of-type(3):before { content: "time"; }
		td:nth-of-type(4):before { content: "rpg"; }
		td:nth-of-type(5):before { content: "save/load"; }
		td:nth-of-type(6):before { content: "hax/ele"; }
		td:nth-of-type(7):before { content: "recorded"; }
	}
	
	@media (max-width: 479px) {
		h3 {
			font-size: 16px;
			padding-top: 8px;
		}
	}
	
</style>
<section id="maps">
		@if(count($runs) > 0)
		<div class="description-box">
			<img src="/Images/logos/3xp.svg" height="90" width="210" style="margin-top:20px;">
			<img src="/Images/logos/codjumper.png" alt="codjumper" style="margin-top:20px;">
				<div class="row justify-content-md-center" style="padding-top: 8px;">
					<h2 style="margin-bottom: 20px;"><a href="/cod4/map/{{$runs['map']['mapname']}}">{{$runs['map']['mapname']}}</a> - {{$runs['name']}}</h2>
				</div>
			</div>
			<div class="hr"></div>
			<div class="description-box">
				<div class="row" style="margin-bottom: 10px; margin-top: 10px;">
					<div class="col-4">
						average time per run: <script type="text/javascript">msToHMS("{{$avgTime}}");</script>
					</div>
					<div class="col-4">
						@if(count($runs["count_runs"]) > 0)
							{{$runs["count_runs"][0]["runs"]}} runs
						@else
							0 runs
						@endif
						in total
					</div>
					<div class="col-4">
						average rpg per run: {{$avgRPG}}
					</div>
				</div>
			</div>
			
			<div class="hr"></div>
					
			<div class="inputSearchEngine">
				<input type="text" id="searchInput" onkeyup="filterMaps()" placeholder="search for player" style="height: 50px; font-size:18px;">
			</div>

			<div class="hr"></div>
			
			<div class="card table-responsive" style="min-width:100%;">
				<table class="table table-hover table-sm" id="runsTable">
					<thead class="no-mobile">
						<tr class="header">
							<th scope="col">#</th>
							<th scope="col">Player</th>
							<th scope="col">Time</th>
							<th scope="col">RPG</th>
							<th scope="col">Saves/Loads</th>
							<th scope="col">Hax/Ele</th>
							<th scope="col">Recorded</th>
						</tr>
					</thead>
					<tbody>
					@foreach($runs['runs'] as $key=>$run)
						<tr>
							<td scope="row">{{$key+1}}</td>
							@if($run['guid'])
								<td><a href="/cod4/statistics/{{$run['guid']['guidShort']}}">{{$run['guid']['alias']}}</a></td>
							@else 
								<td>alias unknown</td>
							@endif
							
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
			<p>No runs found</p>
		@endif
		<script>
			function filterMaps() {
				const input = document.getElementById("searchInput");
				const filter = input.value.toUpperCase();
				const table = document.getElementById("runsTable");
				tr = table.getElementsByTagName("tr");

				for (i = 0; i < tr.length; i++) {
					td = tr[i].getElementsByTagName("td")[1];
					if(td) {
						txtValue = td.textContent || td.innerText;
						if (txtValue.toUpperCase().indexOf(filter) > -1) {
							tr[i].style.display = "";
						} else {
							tr[i].style.display = "none";
						}
					}
				}
			}
			</script>
	</section>
	
@endsection