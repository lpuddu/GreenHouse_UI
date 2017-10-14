<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>INSPINIA | Main view</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">
	
	    <!-- c3 Charts -->
    <link href="css/plugins/c3/c3.min.css" rel="stylesheet">

    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

</head>

<body>

<div id="wrapper">

    <?php 
	
		include 'template/navigation.php'
	
	?>

    <div id="page-wrapper" class="gray-bg">
        <div class="row border-bottom">
            <nav class="navbar navbar-static-top white-bg" role="navigation" style="margin-bottom: 0">
                <div class="navbar-header">
                    <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
                </div>
            </nav>
        </div>
        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">

				<div class="col-lg-3">
					<div class="ibox float-e-margins">
						<div class="ibox-title">
							<h5 id="title1"></h5>
						</div>
						<div class="ibox-content">
							<div>
								<div id="gauge1"></div>
							</div>
						</div>
					</div>
				</div>
				
				<div class="col-lg-3">
					<div class="ibox float-e-margins">
						<div class="ibox-title">
							<h5 id="title2"></h5>
						</div>
						<div class="ibox-content">
							<div>
								<div id="gauge2"></div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-3">
					<div class="ibox float-e-margins">
						<div class="ibox-title">
							<h5 id="title3"></h5>
						</div>
						<div class="ibox-content">
							<div>
								<div id="gauge3"></div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-3">
					<div class="ibox float-e-margins">
						<div class="ibox-title">
							<h5 id="title4"></h5>
						</div>
						<div class="ibox-content">
							<div>
								<div id="gauge4"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row">	
                <div class="col-lg-12">
                    <div class="text-center m-t-lg">
						
                        
                    </div>
                </div>
            </div>
        </div>
        <div class="footer">
            <div class="pull-right">
                10GB of <strong>250GB</strong> Free.
            </div>
            <div>
                <strong>Copyright</strong> Example Company &copy; 2014-2017
            </div>
        </div>

    </div>
</div>


<!-- Mainly scripts -->
<script src="js/jquery-3.1.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/plugins/metisMenu/jquery.metisMenu.js"></script>
<script src="js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

<!-- Custom and plugin javascript -->
<script src="js/inspinia.js"></script>
<script src="js/plugins/pace/pace.min.js"></script>

    <!-- d3 and c3 charts -->
    <script src="js/plugins/d3/d3.min.js"></script>
    <script src="js/plugins/c3/c3.min.js"></script>

    <script>

        $(document).ready(function () {
            
			window.setInterval(myTimer, 1000);
			function myTimer() {
				$.ajax({
					url: 'scriptdb/helper.php',
					dataType: "json",
					async: false,
					contentType: 'application/json',
					success: function(data) {

						for(i = 0; i < data.length; i++){
							document.getElementById("title"+(i+1)).innerHTML = data[i].title;
						
							c3.generate({
								bindto: '#gauge'+(i+1),
								data:{
									columns: [
										[data[i].title + " " + data[i].measure == "C" ? "°C" : data[i].measure, 
										data[i].value]
									],
									type: 'gauge',
								},
								gauge: {
									label: {
										format: function(value, ratio) {
											return value;
										},
										show: true // to turn off the min/max labels.
									},
									
								min: data[i].min_value, // 0 is default, //can handle negative min e.g. vacuum / voltage / current flow / rate of change
								max: data[i].max_value, // 100 is default
								units: data[i].measure == "C" ? "°C" : data[i].measure,
								},
								color:{
									//pattern: ['#1ab394', '#BABABA']
									pattern: ['#FF0000', '#FF9900', '#1ab394', '#1ab394','#FF9900','#FF0000'], // the three color levels for the percentage values.
									threshold: {
										max: data[i].max_value, // 100 is default
										values: [data[i].good_value - 2*data[i].good_tollerance, 
										data[i].good_value - 1.5*data[i].good_tollerance,
										data[i].good_value - data[i].good_tollerance,
										data[i].good_value + data[i].good_tollerance,
										data[i].good_value + 1.5*data[i].good_tollerance,
										data[i].good_value + 2*data[i].good_tollerance]
									}
								},
							});
						}
					},
					error: function(data){
						alert("Stato: " + data.status +" " + data.description);
					},
				});
			}
        });

    </script>

</body>

</html>