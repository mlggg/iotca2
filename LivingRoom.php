<!DOCTYPE html>
<?php
require "config.php";


$dynamodb = $sdk->createDynamoDb();


?>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="plugins/images/house.png">
    <title>IOT CA2 - TNC SMART HOME</title>
    <!-- Bootstrap Core CSS -->
    <link href="bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Menu CSS -->
    <link href="plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.css" rel="stylesheet">
    <!-- animation CSS -->
    <link href="css/animate.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="css/style.css" rel="stylesheet">
    <link href="css/own.css" rel="stylesheet">
    <!-- color CSS -->
    <link href="css/colors/blue-dark.css" id="theme" rel="stylesheet">
   
     <link rel="stylesheet" href="plugins/amcharts/plugins/export/export.css" type="text/css" media="all" />

     <style>
.material-switch > input[type="checkbox"] {
    display: none;   
}

.material-switch > label {
    cursor: pointer;
    height: 0px;
    position: relative; 
    width: 40px;  
}

.material-switch > label::before {
    background: rgb(0, 0, 0);
    box-shadow: inset 0px 0px 10px rgba(0, 0, 0, 0.5);
    border-radius: 8px;
    content: '';
    height: 16px;
    margin-top: -8px;
    position:absolute;
    opacity: 0.3;
    transition: all 0.4s ease-in-out;
    width: 40px;
}
.material-switch > label::after {
    background: rgb(255, 255, 255);
    border-radius: 16px;
    box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.3);
    content: '';
    height: 24px;
    left: -4px;
    margin-top: -8px;
    position: absolute;
    top: -4px;
    transition: all 0.3s ease-in-out;
    width: 24px;
}
.material-switch > input[type="checkbox"]:checked + label::before {
    background: inherit;
    opacity: 0.5;
}
.material-switch > input[type="checkbox"]:checked + label::after {
    background: inherit;
    left: 20px;
}
 #chartdiv {
                width	: 100%;
                height	: 500px;
            }

</style>
</head>

<body>
    <!-- Preloader -->
    <div class="preloader">
        <div class="cssload-speeding-wheel"></div>
    </div>
    <div id="wrapper">
        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top m-b-0">
            <div class="navbar-header"> <a class="navbar-toggle hidden-sm hidden-md hidden-lg " href="javascript:void(0)" data-toggle="collapse" data-target=".navbar-collapse"><i class="fa fa-bars
"></i></a>
                <div class="top-left-part"><a class="logo" href="index.php"><b><img src="plugins/images/house2.png" alt="home" height="45px" width="45px"/></b><span class="hidden-xs">&nbsp&nbsp&nbsp Smart Home</span></a></div>
                <ul class="nav navbar-top-links navbar-left m-l-20 hidden-xs">
                    <li>
                        <form role="search" class="app-search hidden-xs">
                            <input type="text" placeholder="Search..." class="form-control"> <a href=""><i class="fa fa-search"></i></a>
                        </form>
                    </li>
                </ul>
                <ul class="nav navbar-top-links navbar-right pull-right">
                    <li>
                        <a class="profile-pic" href="#"> <img src="plugins/images/users/user.png" alt="user-img" width="36" class="img-circle"><b class="hidden-xs">MS Dora</b> </a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-header -->
            <!-- /.navbar-top-links -->
            <!-- /.navbar-static-side -->
        </nav>
        <!-- Left navbar-header -->
        <div class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav navbar-collapse slimscrollsidebar">
                   <ul class="nav" id="side-menu">
                    <li style="padding: 10px 0 0;">
                        <a href="index.php" class="waves-effect"><i class="fa fa-clock-o fa-fw" aria-hidden="true"></i><span class="hide-menu">Dashboard</span></a>
                    </li>
                    <li>
                        <a href="MasterRoom.php" class="waves-effect"><i class="fa fa-bed fa-fw" aria-hidden="true"></i><span class="hide-menu">Master Room</span></a>
                    </li>
                    <li>
                        <a href="LivingRoom.php" class="waves-effect"><i class="fa fa-home fa-fw" aria-hidden="true"></i><span class="hide-menu">Living Room</span></a>
                    </li>
                    <li>
                        <a href="BabyRoom.php" class="waves-effect"><i class="glyphicon glyphicon-baby-formula fa-fw" aria-hidden="true"></i><span class="hide-menu">Baby Room</span></a>
                    </li>
                    <li>
                        <a href="history.php" class="waves-effect"><i class="fa fa-table fa-fw" aria-hidden="true"></i><span class="hide-menu">Past Records</span></a>
                    </li>
                        <li>
                               <a href="photo.php" class="waves-effect"><i class="fa fa-table fa-fw" aria-hidden="true"></i><span class="hide-menu">Past Photos</span></a>
                        </li>
               
                </ul>
            </div>
        </div>
        <!-- Left navbar-header end -->
        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row bg-title">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title">Living Room</h4> </div>

                    <!-- /.col-lg-12 -->
                </div>
                <!-- /row -->
                <div class="row">
                    <!-- Column -->
                    
                  <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                        <div class="white-box">
                            <div class="col-in row">
                               <h4 class="card-title">Led One</h4>
                               <br />
                                <div class="material-switch pull-left">
                                   <?php ?>
                                <input id="someSwitchOptionDanger" name="someSwitchOption001" type="checkbox" class="off" onclick="toggleState(this,1)" />
                                <label for="someSwitchOptionDanger" class="label-danger"></label>
                                </div>
 				<div class="pull-right" style="margin-top:-15%;">
				<img src="plugins/images/led-red.png" alt="led" width="80" />
				</div>
                            </div>
                        </div>
                    </div>


                  

                   <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                        <div class="white-box">
                            <div class="col-in row">
                               <h4 class="card-title">Led Two</h4>
                               <br />
                                 <div class="material-switch pull-left">
                                <input id="someSwitchOptionWarning" name="someSwitchOption001" type="checkbox" class="off" onclick="toggleState2(this,2)"/>
                                <label for="someSwitchOptionWarning" class="label-warning"></label>
                                </div>
 				<div class="pull-right" style="margin-top:-15%;">
				<img src="plugins/images/led-yellow.png" alt="led" width="80" />
				</div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                        <div class="white-box">
                            <div class="col-in row">
                               <h4 class="card-title">Led Three</h4>
                               <br />
                             <div class="material-switch pull-left">
                                <input id="someSwitchOptionSuccess" name="someSwitchOption001" type="checkbox" class="off" onclick="toggleState3(this,3)"/>
                                <label for="someSwitchOptionSuccess" class="label-success"></label>
                                </div>
 				<div class="pull-right" style="margin-top:-15%;">
				<img src="plugins/images/led-green.png" alt="led" width="80" />
				</div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
                <!-- /.row -->
                  <div class="row">
                        <div class="col-md-12">
                            <div class="white-box">
                                <div id="chartdiv"></div>
                            </div>
                        </div>
                    </div>
            </div>
            <!-- /.container-fluid -->
           
        </div>
        <!-- /#page-wrapper -->
    </div>
    <!-- /#wrapper -->
    <!-- jQuery -->
     <script src="plugins/bower_components/jquery/dist/jquery.min.js"></script>
            <!-- Bootstrap Core JavaScript -->
            <script src="bootstrap/dist/js/bootstrap.min.js"></script>
            <!-- Menu Plugin JavaScript -->
            <script src="plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.js"></script>
            <!--slimscroll JavaScript -->
            <script src="js/jquery.slimscroll.js"></script>
            <script src="plugins/amcharts/amcharts.js"></script>
            <script src="plugins/amcharts/serial.js"></script>
            <script src="plugins/amcharts/plugins/export/export.min.js"></script>

            <script src="plugins/amcharts/themes/light.js"></script>

            <!--Wave Effects -->
            <script src="js/waves.js"></script>
            <!-- Custom Theme JavaScript -->
            <script src="js/custom.min.js"></script>
            <script>
                function toggleState(item,colour){
			
			if(item.className == "on1") {
            		  	item.className="off1";
				var a= new XMLHttpRequest();
				a.open("GET","ledon.php?off=OFF&led="+colour);
				a.onreadystatechange=function(){
				if(a.readyState==4){
					if(a.status == 200){
					}
					else alert("HTTP ERROR")
				}
			}
				a.send();

          		 } else {
             		 	item.className="on1";
				var a= new XMLHttpRequest();
				a.open("GET","ledon.php?on=ON&led="+colour);
				a.onreadystatechange=function(){
				if(a.readyState==4){
					if(a.status == 200){
					}
					else alert("HTTP ERROR")
				}
			}
			a.send();

           		 }
			
			
		};
                
                function toggleState2(item,colour){
			
			if(item.className == "on2") {
            		  	item.className="off2";
				var a= new XMLHttpRequest();
				a.open("GET","ledon.php?off=OFF&led="+colour);
				a.onreadystatechange=function(){
				if(a.readyState==4){
					if(a.status == 200){
					}
					else alert("HTTP ERROR")
				}
			}
				a.send();

          		 } else {
             		 	item.className="on2";
				var a= new XMLHttpRequest();
				a.open("GET","ledon.php?on=ON&led="+colour);
				a.onreadystatechange=function(){
				if(a.readyState==4){
					if(a.status == 200){
					}
					else alert("HTTP ERROR")
				}
			}
			a.send();

           		 }
			
			
		};
                
                function toggleState3(item,colour){
			
			if(item.className == "on3") {
            		  	item.className="off3";
				var a= new XMLHttpRequest();
				a.open("GET","ledon.php?off=OFF&led="+colour);
				a.onreadystatechange=function(){
				if(a.readyState==4){
					if(a.status == 200){
					}
					else alert("HTTP ERROR")
				}
			}
				a.send();

          		 } else {
             		 	item.className="on3";
				var a= new XMLHttpRequest();
				a.open("GET","ledon.php?on=ON&led="+colour);
				a.onreadystatechange=function(){
				if(a.readyState==4){
					if(a.status == 200){
					}
					else alert("HTTP ERROR")
				}
			}
			a.send();

           		 }
			
			
		};
                
                 function labelFunction(item, label) {
                                                if (item.index === item.graph.chart.dataProvider.length - 1)
                                                    return label;
                                                else
                                                    return "";
                                            }
                
                                            var chart = AmCharts.makeChart("chartdiv", {
                                                "type": "serial",
                                                "theme": "light",
                                                "marginRight": 40,
                                                "marginLeft": 40,
                                                "autoMarginOffset": 20,
                                                "mouseWheelZoomEnabled": true,
                                                "dataDateFormat": "SS:NN:HH",
                                                "valueAxes": [{
                                                        
                                                        "id": "v1",
                                                        "axisAlpha": 0,
                                                        "position": "left",
                                                        "maximum": 100,
                                                        "minimum": 0,
                                                        "title": "value"
                                                    }],
                                                "balloon": {
                                                    "borderThickness": 1,
                                                    "shadowAlpha": 0
                                                },
                                                "graphs": [{
                                                        "id": "g1",
                                                        "balloon": {
                                                            "drop": true,
                                                            "adjustBorderColor": false,
                                                            "color": "#ffffff"
                                                        },
                                                        "labelText": "[[title]]",
                                                        "labelFunction": labelFunction,
                                                        "labelPosition": "right",
                                                        "bullet": "round",
                                                        "bulletBorderAlpha": 1,
                                                        "bulletColor": "#FFFFFF",
                                                        "bulletSize": 5,
                                                        "hideBulletsCount": 50,
                                                        "lineThickness": 2,
                                                        "title": "Humidity",
                                                        "useLineColorForBulletBorder": true,
                                                        "valueField": "Humidity",
                                                        "balloonText": "<span style='font-size:18px;'>[[Humidity]]</span>"
                                                    },{
                                                        "id": "g12",
                                                        "balloon": {
                                                            "drop": true,
                                                            "adjustBorderColor": false,
                                                            "color": "#ffffff"
                                                        },
                                                        "labelText": "[[title]]",
                                                        "labelFunction": labelFunction,
                                                        "labelPosition": "right",
                                                        "bullet": "round",
                                                        "bulletBorderAlpha": 1,
                                                        "bulletColor": "#FFFFFF",
                                                        "bulletSize": 5,
                                                        "hideBulletsCount": 50,
                                                        "lineThickness": 2,
                                                        "title": "Temperature",
                                                        "useLineColorForBulletBorder": true,
                                                        "valueField": "Temperature",
                                                        "balloonText": "<span style='font-size:18px;'>[[Temperature]]</span>"
                                                    }],
                                                "chartScrollbar": {
                                                    "graph": "g1",
                                                    "oppositeAxis": false,
                                                    "offset": 30,
                                                    "scrollbarHeight": 80,
                                                    "backgroundAlpha": 0,
                                                    "selectedBackgroundAlpha": 0.1,
                                                    "selectedBackgroundColor": "#888888",
                                                    "graphFillAlpha": 0,
                                                    "graphLineAlpha": 0.5,
                                                    "selectedGraphFillAlpha": 0,
                                                    "selectedGraphLineAlpha": 1,
                                                    "autoGridCount": true,
                                                    "color": "#AAAAAA"
                                                },
                                                "chartCursor": {
                                                    "pan": true,
                                                    "valueLineEnabled": true,
                                                    "valueLineBalloonEnabled": true,
                                                    "cursorAlpha": 1,
                                                    "cursorColor": "#258cbb",
                                                    "limitToGraph": "g1",
                                                    "valueLineAlpha": 0.2,
                                                    "valueZoomable": true
                                                },
                                                "valueScrollbar": {
                                                    "oppositeAxis": false,
                                                    "offset": 50,
                                                    "scrollbarHeight": 10
                                                },
                                                "categoryField": "Time",
                                                "categoryAxis": {

                                                    "dashLength": 1,
                                                    "minorGridEnabled": true
                                                },
                                                "export": {
                                                    "enabled": true
                                                },
                                                "dataProvider": [
<?php
$getobj = scanAllData($dynamodb, 'LivingRoom');

foreach ($getobj as $key => $row) {
    $volume[$key]  = $row['Time']['S'];
   
}
array_multisort($volume, SORT_ASC, $getobj);
$cut=array_slice($getobj, -10);
foreach ($cut as $seq => $val) {
    echo "{'Time':'{$val['Time']['S']}','Humidity':'{$val['Humidity']['S']}','Temperature':'{$val['Temperature']['S']}'},";
}
?>
                                                ]
                                            });

                                            chart.addListener("rendered", zoomChart);

                                            zoomChart();

                                            function zoomChart() {
                                                chart.zoomToIndexes(chart.dataProvider.length - 40, chart.dataProvider.length - 1);
                                            }

                                            setInterval(function () {
                                                if(chart.dataProvider.length >10){
                                                 chart.dataProvider.shift();
                                             }
                                              var last = chart.dataProvider.length-1;
                                              var lt;
                                                if(last == 0){
                                                  lt =0;
                                                    }else{
                                                   lt = last;
                                                    }
                                                 console.log(chart.dataProvider[lt]['Time']);
                                                $.get("chartdata.php?id=living", function (data) {
                                                    var ddata = JSON.parse(data);
                                                    console.log(ddata[0])
                                                    if (ddata[0] !== chart.dataProvider[lt]['Time']) {
                                                         chart.dataProvider.push({
                                                        'Time': ddata[0],
                                                        'Humidity': ddata[1],
                                                        'Temperature':ddata[2]
                                                    }, );
                                                    }
                                                   

                                                });

                                                chart.validateData();
                                            }, 3000);
            </script>
</body>

</html>
