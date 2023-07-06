<!-- @extends('layouts.main') -->

@section('content')

<style>
@media (min-width: 479px) {
	.mobile {display:none;}
}
@media (max-width: 479px) {

	tbody td {
		padding-left: 30% !important; 
	}
	td:before { 
		width: 25%; 
		left: 25px;
	}

	.content-box-title {
		min-width: 229px !important;
		line-height: 0.7 !important;
	}
	.content-box-title {
		width: 100% !important;
		margin-left: 0px !important;
	}

	td:nth-of-type(1):before { content: "#"; }
	td:nth-of-type(2):before { content: "1"; }
	td:nth-of-type(3):before { content: "2"; }
	td:nth-of-type(4):before { content: "3"; }
	td:nth-of-type(5):before { content: "4"; }
	td:nth-of-type(6):before { content: "5"; }
	td:nth-of-type(7):before { content: "6"; }
	td:nth-of-type(8):before { content: "7"; }
	td:nth-of-type(9):before { content: "8"; }
	td:nth-of-type(10):before { content: "9"; }
	td:nth-of-type(11):before { content: "10"; }
	td:nth-of-type(12):before { content: "11"; }
	td:nth-of-type(13):before { content: "12"; }
	td:nth-of-type(14):before { content: "13"; }
	td:nth-of-type(15):before { content: "14"; }
	td:nth-of-type(16):before { content: "15"; }
	td:nth-of-type(17):before { content: "16"; }
	td:nth-of-type(18):before { content: "17"; }
	td:nth-of-type(19):before { content: "18"; }
	td:nth-of-type(20):before { content: "19"; }
	td:nth-of-type(21):before { content: "20"; }
}
</style>

<section id="maps">
			@if(count($players) > 0)
			<div class="content-box-title">
				<div class="row" style="padding-top: 8px;">
					<h3>players</h3>
				</div>
			</div>
			<div class="inputSearchEngine" style="max-width: 666px; margin:auto; margin-bottom: 10px;">
				<input type="text" id="search" autocomplete="off" placeholder="search guid or alias">
				<div class="content-box-title" id="searchbox" style="margin-top:10px; line-height: 0.5; font-size:16px;">
					<div id="search_result" style="text-align:center; margin-top: 17px;"></div><br>
				</div>
			</div>
			<div class="content-box-title">
				<div class="row" style="padding-top: 8px;">
					<h3>global leaderboard</h3>
				</div>
			</div>
			{{-- <div class="content-box-desc"> --}}
				<table class="table table-hover table-sm no-mobile" id="mapsTable">
					<thead class="no-mobile">
						<tr>
							<th scope="col">#</th>
							<th scope="col">Most #1 Time</th>
							<th scope="col">Most #1 RPG</th>
							<th scope="col">Most Runs</th>
						</tr>
					</thead>
					<tbody>
						@for ($i = 0; $i < count($mostRuns); $i++)
						<tr>
							<td>{{$i+1}}</td>
							<td><a href="/cod4/statistics/{{$mostFirstTimes[$i]['guid']}}">{{$mostFirstTimes[$i]["alias"]}}</a> ({{$mostFirstTimes[$i]["amountTime1st"]}})</td>
							<td><a href="/cod4/statistics/{{$mostFirstRPGs[$i]['guid']}}">{{$mostFirstRPGs[$i]["alias"]}}</a> ({{$mostFirstRPGs[$i]["amountRPG1st"]}})</td>
							<td><a href="/cod4/statistics/{{$mostRuns[$i]['guid']}}">{{$mostRuns[$i]["alias"]}}</a> ({{$mostRuns[$i]["runs"]}})</td>
						</tr>
					@endfor
					</tbody>
				</table>

				<table class="table table-hover mobile" id="mapsTable">
					<tbody>
						<tr>
							<td>Most #1 Time</td>
							@for ($i = 0; $i < 20; $i++)
								<td><a href="/cod4/statistics/{{$mostFirstTimes[$i]['guid']}}">{{$mostFirstTimes[$i]["alias"]}}</a> ({{$mostFirstTimes[$i]["amountTime1st"]}})</td>
							@endfor
						</tr>
					</tbody>
				</table>
				<table class="table table-hover mobile" id="mapsTable">
					<tbody>
						<tr>
							<td>Most #1 RPGs</td>
							@for ($i = 0; $i < 20; $i++)
								<td><a href="/cod4/statistics/{{$mostFirstRPGs[$i]['guid']}}">{{$mostFirstRPGs[$i]["alias"]}}</a> ({{$mostFirstRPGs[$i]["amountRPG1st"]}})</td>
							@endfor
						</tr>
					</tbody>
				</table>
				<table class="table table-hover mobile" id="mapsTable">
					<tbody>
						<tr>
							<td>Most Runs</td>
							@for ($i = 0; $i < 20; $i++)
								<td><a href="/cod4/statistics/{{$mostRuns[$i]['guid']}}">{{$mostRuns[$i]["alias"]}}</a> ({{$mostRuns[$i]["runs"]}})</td>
							@endfor
						</tr>
					</tbody>
				</table>
			{{-- </div> --}}
			<hr>
			@else
				<p>No maps found</p>
			@endif

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
		<script type="text/javascript">
		
			$('#search').on('keyup', function(){
				search();
			});
			search();

			function search() {
				var keyword = $('#search').val();
				console.log(keyword.length);
				if(keyword.length < 1) {
					$('#searchbox').css('display', 'none');
				}
				if(keyword.length > 0) {
					$('#searchbox').css('display', 'block');
					$.post('{{ route("player.search") }}',
					{
						_token: '{!! csrf_token() !!}',
						keyword:keyword
					},
					function(data){
						table_post_row(data);
						console.log(data);
					});
				}
			}

			function table_post_row(res){
				let htmlView = '';
				for(let i = 0; i < res.players.length; i++){
					htmlView += `
						<p>
							<a href="/cod4/statistics/`+res.players[i].guidShort+`">`+res.players[i].alias+`</a> 
							(<a href="/cod4/statistics/`+res.players[i].guidShort+`">`+res.players[i].guidShort+`</a>)
						</p>`;
				}
				$('#search_result').html(htmlView);
			}

		</script>
	</section>
	
@endsection