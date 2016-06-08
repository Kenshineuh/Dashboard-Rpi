<?php
require_once 'model.php';
// Get all information of database.
$allInfo = allInfo();
// Get only the last
$lastInfo = end($allInfo);
// Transform into Datetime type.
$date = date_create($lastInfo["date"]);

// Get the 24 last information for the Chart
$plant = chartPlant();
// Array of string for the Chart with chart.js
$plantData = array();
$humiditeData = array();
$tempData = array();
$chartDate = array();
foreach ($plant as $row){
    // Put record into a table for the graph
    array_push($plantData, $row["plante"]);
    array_push($humiditeData, $row["humidite"]);
    array_push($tempData, $row["temp"]);
    // Format the type datatime into array of string.
    array_push($chartDate, "\"".substr($row["date"], 5, 11)."\"");
}

include "header.php";
?>

	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Dashboard</h1>
			</div>
		</div><!--/.row-->

		<div class="row">
			<div class="col-xs-12 col-md-6 col-lg-3">
				<div class="panel panel-blue panel-widget ">
					<div class="row no-padding">
						<div class="col-sm-3 col-lg-5 widget-left">
							<svg class="glyph stroked dashboard-dial"><use xlink:href="#stroked-dashboard-dial"/></svg>
						</div>
						<div class="col-sm-9 col-lg-7 widget-right">
							<div class="large"><?=$lastInfo["temp"]?> °C</div>
							<div class="text-muted">Température</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-md-6 col-lg-3">
				<div class="panel panel-orange panel-widget">
					<div class="row no-padding">
						<div class="col-sm-3 col-lg-5 widget-left">
							<svg class="glyph stroked dashboard-dial"><use xlink:href="#stroked-dashboard-dial"/></svg>
						</div>
						<div class="col-sm-9 col-lg-7 widget-right">
							<div class="large"><?=$lastInfo["humidite"]?> %</div>
							<div class="text-muted">Humidité</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-md-6 col-lg-3">
				<div class="panel panel-teal panel-widget">
					<div class="row no-padding">
						<div class="col-sm-3 col-lg-5 widget-left">
							<svg class="glyph stroked heart"><use xlink:href="#stroked-heart"></use></svg>
						</div>
						<div class="col-sm-9 col-lg-7 widget-right">
							<div class="large"><?=$lastInfo["plante"]?></div>
							<div class="text-muted">Humidité Plante</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-md-6 col-lg-3">
				<div class="panel panel-red panel-widget">
					<div class="row no-padding">
						<div class="col-sm-3 col-lg-5 widget-left">
							<svg class="glyph stroked clock"><use xlink:href="#stroked-clock"></use></svg>
						</div>
						<div class="col-sm-9 col-lg-7 widget-right">
							<div class="large"><?=date_format($date, 'd M H:i');?></div>
							<div class="text-muted">Date</div>
						</div>
					</div>
				</div>
			</div>
		</div><!--/.row-->

        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Chart Temp</div>
                    <div class="panel-body">
                        <div class="canvas-wrapper">
                            <canvas class="main-chart" id="line-chart-temp" height="120" width="600"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div><!--/.row-->

        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Chart Humidity</div>
                    <div class="panel-body">
                        <div class="canvas-wrapper">
                            <canvas class="main-chart" id="line-chart-humidity" height="120" width="600"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div><!--/.row-->

		<div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Chart Plant</div>
                    <div class="panel-body">
                        <div class="canvas-wrapper">
                            <canvas class="main-chart" id="line-chart-plant" height="150" width="600"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div><!--/.row-->
        
		<?php //include "allInformation.php"; ?>
        
	</div>	<!--/.main-->

	<script>
    // PHP variable into JS.
	var plantData = <?php echo json_encode(array_reverse($plantData)); ?>;
    var humiditeData = <?php echo json_encode(array_reverse($humiditeData)); ?>;
    var tempData = <?php echo json_encode(array_reverse($tempData)); ?>;
    var chartDate = <?php echo json_encode(array_reverse($chartDate)); ?>;

    // Format for the Chart.
	var plantData = JSON.parse("[" + plantData + "]");
    var humiditeData = JSON.parse("[" + humiditeData + "]");
    var tempData = JSON.parse("[" + tempData + "]");
    var chartDate = JSON.parse("[" + chartDate + "]");

	var lineChartData1 = {
        labels : chartDate,
        datasets : [
            {
                label: "temp",
                fillColor : "rgba(48, 164, 255, 0.2)",
                strokeColor : "rgba(48, 164, 255, 1)",
                pointColor : "rgba(48, 164, 255, 1)",
                pointStrokeColor : "#fff",
                pointHighlightFill : "#fff",
                pointHighlightStroke : "rgba(48, 164, 255, 1)",
                data : tempData
            }
        ]

    }

    var lineChartData2 = {
        labels : chartDate,
        datasets : [
            {
                label: "Humidite",
                fillColor : "rgba(255,140,0,0.2)",
                strokeColor : "rgba(255,140,0,1)",
                pointColor : "rgba(48, 164, 255, 1)",
                pointStrokeColor : "#fff",
                pointHighlightFill : "#fff",
                pointHighlightStroke : "rgba(48, 164, 255, 1)",
                data : humiditeData
            }
        ]

    }

    var lineChartData3 = {
        labels : chartDate,
        datasets : [
            {
                label: "Humidité Plante",
                fillColor : "rgba(48, 164, 255, 0.2)",
                strokeColor : "rgba(48, 164, 255, 1)",
                pointColor : "rgba(48, 164, 255, 1)",
                pointStrokeColor : "#fff",
                pointHighlightFill : "#fff",
                pointHighlightStroke : "rgba(48, 164, 255, 1)",
                data : plantData
            }
        ]

    }

    window.onload = function(){
        var chart1 = document.getElementById("line-chart-temp").getContext("2d");
        var chart2 = document.getElementById("line-chart-humidity").getContext("2d");
        var chart3 = document.getElementById("line-chart-plant").getContext("2d");
        window.myLine = new Chart(chart1).Line(lineChartData1, {
            responsive: true
        });
        window.myLine = new Chart(chart2).Line(lineChartData2, {
            responsive: true
        });
        window.myLine = new Chart(chart3).Line(lineChartData3, {
            responsive: true
        });

    };
	</script>
</body>

</html>
