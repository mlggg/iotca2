<!DOCTYPE html>
<html lang="en">
<?php

require "alldata.php";
$arr1=array();
$arr2=array();
$arr3=array();

$last =count($getobj)-1;

if($last <0){
    
    $last = 0;
}

array_push($arr1, $getobj[$last]['Time']['S'],$getobj[$last]['Humidity']['S'],$getobj[$last]['Temperature']['S']);

$last2 =count($getobj2)-1;

if($last2 <0){
    
    $last2 = 0;
}
array_push($arr2, $getobj2[$last2]['Time']['S'],$getobj2[$last2]['Humidity']['S'],$getobj2[$last2]['Temperature']['S']);


$last3 =count($getobj3)-1;

if($last3 <0){
    
    $last3 = 0;
}

array_push($arr3, $getobj3[$last3]['Time']['S'],$getobj3[$last3]['Humidity']['S'],$getobj3[$last3]['Temperature']['S'],$getobj3[$last3]['Light']['S']);


?>
    
    
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
    <!-- toast CSS -->
    <link href="plugins/bower_components/toast-master/css/jquery.toast.css" rel="stylesheet">
    <!-- morris CSS -->
    <link href="plugins/bower_components/morrisjs/morris.css" rel="stylesheet">
    <!-- animation CSS -->
    <link href="css/animate.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="css/style.css" rel="stylesheet">
    <link href="css/own.css" rel="stylesheet">
    <!-- color CSS -->
    <link href="css/colors/blue-dark.css" id="theme" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
    
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
</style>
</head>
<script>
 var b='baby';
 var a='master';
 </script>
<body>
    <!-- Preloader -->
    <div class="preloader">
        <div class="cssload-speeding-wheel"></div>
    </div>
    <div id="wrapper">
        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top m-b-0">
            <div class="navbar-header"> <a class="navbar-toggle hidden-sm hidden-md hidden-lg " href="javascript:void(0)" data-toggle="collapse" data-target=".navbar-collapse"><i class="fa fa-bars"></i></a>
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
                               <a href="photo.php" class="waves-effect"><i class="fa fa-table fa-fw" aria-hidden="true"></i><span class="hide-menu">Past Photo</span></a>
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
                        <h4 class="page-title">Dashboard</h4> </div>
                    <!-- /.col-lg-12 -->
                </div>
                
                
                <!-----------------------------------------------------This is the first row LED--------------------------------->
                <div class="row">
                    <!-- Column -->
                    
                  <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                        <div class="white-box">
                            <div class="col-in row">
                               <h4 class="card-title">Living Room</h4>
                               <br />
                                <div class="material-switch pull-left">
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
                               <h4 class="card-title">Master Room</h4>
                               <br />
                                 <div class="material-switch pull-left">
                                <input id="someSwitchOptionWarning" name="someSwitchOption001" type="checkbox" class="off" onclick="toggleState2(this,a)"/>
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
                               <h4 class="card-title">Baby Room</h4>
                               <br />
                             <div class="material-switch pull-left">
                                <input id="someSwitchOptionSuccess" name="someSwitchOption001" type="checkbox" class="off" onclick="toggleState3(this,b)"/>
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
<!-----------------------------------------------------This is the second row Temperature--------------------------------->
                 <div class="row">
                    <!-- Column -->
                    
                  <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                        <div class="white-box">
                            <div class="col-in row">
                               <h4 class="card-title">Living Room</h4>
                                <br />
                            
                                
                                <div class="row">
                                <p class="pull-left" id="livingTem">Temperature: <?php echo "{$arr1[2]}"; ?>&#8451;</p>
                               
 			
                                </div>
                                
                                <div class="row">
                                 <p class="pull-left" id="livingHum">Humidity:  <?php echo "{$arr1[1]}"; ?>%</p>
                               
 			
                                </div>
                              
                            </div>
                        </div>
                    </div>


                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                        <div class="white-box">
                            <div class="col-in row">
                               <h4 class="card-title">Master Room</h4>

                               <br /> 
                               
                                    <div class="row">
                                <p class="pull-left" id="masterTem">Temperature: <?php echo "{$arr2[2]}"; ?>&#8451;</p>
                               
 			
                                </div>
                                
                                <div class="row">
                                 <p class="pull-left" id="masterHum">Humidity:  <?php echo "{$arr2[1]}"; ?>%</p>
                               
 			
                                </div>
                              
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                        <div class="white-box">
                            <div class="col-in row">
                               <h4 class="card-title">Baby Room</h4>

                               <br />
                                    <div class="row">
                                <p class="pull-left" id="babyTem">Temperature: <?php echo "{$arr3[2]}"; ?>&#8451;</p>
                               
 			
                                </div>
                                
                                <div class="row">
                                 <p class="pull-left" id="babyHum">Humidity:  <?php echo "{$arr3[1]}"; ?>%</p>
                               
 			
                                </div>
                                 <div class="row">
                                 <p class="pull-left" id="babyLight">Light:  <?php echo "{$arr3[3]}"; ?></p>
                               
 			
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
                
     <!-----------------------------------------------------This is the THIRD row Humidity--------------------------------->           
                
                 
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
    <!--Wave Effects -->
    <script src="js/waves.js"></script>
    <!--Counter js -->
    <script src="plugins/bower_components/waypoints/lib/jquery.waypoints.js"></script>
    <script src="plugins/bower_components/counterup/jquery.counterup.min.js"></script>
    <!--Morris JavaScript -->
    <script src="plugins/bower_components/raphael/raphael-min.js"></script>
    <script src="plugins/bower_components/morrisjs/morris.js"></script>
    <!-- Custom Theme JavaScript -->
    <script src="js/custom.min.js"></script>
    <script src="js/dashboard1.js"></script>
    <script src="plugins/bower_components/toast-master/js/jquery.toast.js"></script>
    <script type="text/javascript">
    $(document).ready(function() {
        $.toast({
            heading: 'Welcome back Ms Dora!',
           // text: 'Use the predefined ones, or specify a custom position object.',
            position: 'top-right',
            loaderBg: '#ff6849',
            icon: 'info',
            hideAfter: 3500,
            stack: 6
        })
    });
    
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
    
    
    setInterval(function () {
   $.ajax({
       
     type: "GET",
     url: 'alldataTwo.php',
    
     success: function(data) {
         var ddata = JSON.parse(data);
         
          $('#livingTem').html("Temperature: "+ddata[0][2]+"&#8451;");
           $('#livingHum').html("Humidity: "+ddata[0][1]+"%");
            $('#masterTem').html("Temperature: "+ddata[1][1]+"&#8451;");
           $('#masterHum').html("Humidity: "+ddata[1][2]+"%");
           $('#masterLight').html("Light: "+ddata[1][3]);
           
           $('#babyTem').html("Temperature: "+ddata[2][1]+"&#8451;");
           $('#babyHum').html("Humidity: "+ddata[2][2]+"%");
           $('#babyLight').html("Light: "+ddata[2][3]);
     
     }

   });
  }, 3000);
    </script>
</body>

</html>
