<h1>OESK results</h1>

<script src="http://code.highcharts.com/adapters/mootools-adapter.js"></script>
<script src="http://code.highcharts.com/highcharts.js"></script>
<script src="http://code.highcharts.com/modules/exporting.js"></script>

<script>
    var initChart = function() {
        chart1 = new Highcharts.Chart({
            chart: {
                renderTo: 'chartContainerKraken',
                type: 'column'
            },
            title: {
                text: 'Czas wykonania testów - Kraken'
            },
            subtitle: {
                text: 'Mniej - lepiej'
            },
            xAxis: {
                categories: categories.kraken,
                labels: {
                    rotation: -45,
                    align: 'right',
                    style: {
                        fontSize: '13px',
                        fontFamily: 'Verdana, sans-serif'
                    }
                }
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Czas wykonania (ms)'
                }
            },
            legend: {
                enabled: false
            },
            tooltip: {
                formatter: function() {
                    return ''+
                        this.x +': '+ this.y +' ms';
                }
            },
            plotOptions: {
                column: {
                    pointPadding: 0.2,
                    borderWidth: 0,
                    color: '#81C0C5'
                }
            },
                series: [allData.kraken]
        });
        
        
        
        chart2 = new Highcharts.Chart({
            chart: {
                renderTo: 'chartContainerSunspider',
                type: 'column'
            },
            title: {
                text: 'Czas wykonania testów - Sunspider'
            },
            subtitle: {
                text: 'Mniej - lepiej'
            },
            xAxis: {
                categories: categories.sunspider,
                labels: {
                    rotation: -45,
                    align: 'right',
                    style: {
                        fontSize: '13px',
                        fontFamily: 'Verdana, sans-serif'
                    }
                }
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Czas wykonania (ms)'
                }
            },
            legend: {
                enabled: false
            },
            tooltip: {
                formatter: function() {
                    return ''+
                        this.x +': '+ this.y +' ms';
                }
            },
            plotOptions: {
                column: {
                    pointPadding: 0.2,
                    borderWidth: 0,
                    color: '#FB8335'
                }
            },
                series: [allData.sunspider]
        });
        
        
        chart3 = new Highcharts.Chart({
            chart: {
                renderTo: 'chartContainerV8',
                type: 'column'
            },
            title: {
                text: 'Czas wykonania testów - V8'
            },
            subtitle: {
                text: 'Mniej - lepiej'
            },
            xAxis: {
                categories: categories.v8,
                labels: {
                    rotation: -45,
                    align: 'right',
                    style: {
                        fontSize: '13px',
                        fontFamily: 'Verdana, sans-serif'
                    }
                }
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Czas wykonania (ms)'
                }
            },
            legend: {
                enabled: false
            },
            tooltip: {
                formatter: function() {
                    return ''+
                        this.x +': '+ this.y +' ms';
                }
            },
            plotOptions: {
                column: {
                    pointPadding: 0.2,
                    borderWidth: 0,
                    color: '#B5D045'
                }
            },
                series: [allData.v8]
        });
    };
    
    var categories = <?php echo $categories ?>;
    var allData = <?php echo $data; ?>;
    
    setTimeout(initChart, 500);
</script>

<?php echo oesk_nav('results') ?>

<div id="body">
    Wyniki dać panowie!
    
    <div id="chartContainerKraken" style="min-width: 400px; height: 500px; margin: 0 auto"></div>
    
    <div id="chartContainerSunspider" style="min-width: 400px; height: 500px; margin: 0 auto"></div>
    
    <div id="chartContainerV8" style="min-width: 400px; height: 500px; margin: 0 auto"></div>
</div>