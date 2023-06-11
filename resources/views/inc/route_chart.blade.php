<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script>
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(draw_my_chart);
    function draw_my_chart() {
        var data = new google.visualization.DataTable();
        var my_2d = @json($mapRoutes['routes_external']);

        data.addColumn('string', 'language');
        data.addColumn('number', 'Nos');
        for(i = 0; i < my_2d.length; i++) {
            if(my_2d[i]['count_runs'][0]) {
                data.addRow([my_2d[i]['name'], parseInt(my_2d[i]['count_runs'][0]['runs'])]);
            }
        }

        var options = {
            // pieSliceText: 'value',
            backgroundColor: 'none',
            width: '100%',
            height: 300,
            pieHole: 0.3,
            legend: 'none',
            chartArea: {
                left: '10%', 
                top: '10px',
                'width': '90%', 
                'height': '90%',
                backgroundColor: {
                    stroke: 'white',
                    strokeWidth: 10
                },
            },
            pieSliceTextStyle: {
                fontSize: 10,
                opacity: '0.6'
            },
            slices: {
                0: {color: '#14171C'}, 
                1: {color: '#1A1D22'}, 
                2: {color: '#202327'}, 
                3: {color: '#23262A'}, 
                4: {color: '#26292D'}, 
                5: {color: '#2C2F32'},
                6: {color: '#323538'}, 
                7: {color: '#35383B'}, 
                8: {color: '#373A3C'}, 
                9: {color: '#383B3D'},
                10: {color: '#23262A'}, 
                11: {color: '#26292D'}, 
                12: {color: '#2C2F32'}
            }
        };

        // Instantiate and draw the chart
        var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
        chart.draw(data, options);
    }
</script>
<div id="chart_div" style="margin:auto;"></div>
