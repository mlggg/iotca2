<!DOCTYPE html>
<?php

require 'config.php';

$return=isset($_GET['room']) ? $_GET['room'] : 'livingroom';
$bucket ='';
if ($return=='livingroom'){
$bucket = 'LivingRoom';
}else if ($return=='babyroom'){

    $bucket = 'BabyRoom';
}else if ($return == 'masterroom'){
    
     $bucket = 'MasterRoom';
}

$dynamodb = $sdk->createDynamoDb();
$getobj = scanAllData($dynamodb, $bucket);


foreach ($getobj as $key => $row) {
    $volume[$key]  = $row['Time']['S'];
   
}
array_multisort($volume, SORT_ASC, $getobj);

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
    <!-- color CSS -->
    <link href="css/colors/blue-dark.css" id="theme" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body>
    <!-- Preloader -->
    <div class="preloader">
        <div class="cssload-speeding-wheel"></div>
    </div>
    <div id="wrapper">
        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top m-b-0">
            <div class="navbar-header"> <a class="navbar-toggle hidden-sm hidden-md hidden-lg " href="javascript:void(0)" data-toggle="collapse" data-target=".navbar-collapse"><i class="fa fa-bars"></i></a>
                <div class="top-left-part"><a class="logo" href="index.php"><b><img src="plugins/images/house2.png" alt="home" height="45px" width="45px" /></b><span class="hidden-xs">&nbsp&nbsp&nbsp Smart Home</span></a></div>
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
                        <h4 class="page-title">Past Records</h4> </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- row -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="white-box">
                            <div class="row page-titles">
                    <div class="col-md-6 col-8 align-self-center">
                        <h3 class="text-themecolor m-b-0 m-t-0">Records</h3>
                       
                    </div>
                                <div class="col-md-6 col-8">
                  
                        <select class="custom-select pull-right"  onchange="location = this.value;">
                              <?php 
                              if($return == "livingroom"){
                              ?>
				<option value='history.php?room=livingroom' selected>Living Room</option>
				<option value='history.php?room=babyroom'>Baby Room</option>
                                <option value='history.php?room=masterroom'>Master Room</option>
                           <?php 
                              }else if($return == "babyroom"){
                                  
                             
                              ?>
                                    <option value='history.php?room=livingroom' >Living Room</option>
				<option value='history.php?room=babyroom' selected>Baby Room</option>
                                <option value='history.php?room=masterroom'>Master Room</option>
                                <?php
                              }else if($return == "masterroom"){
                                  
                             
                              ?>
                                    <option value='history.php?room=livingroom' >Living Room</option>
				<option value='history.php?room=babyroom'>Baby Room</option>
                                <option value='history.php?room=masterroom'  selected>Master Room</option>
                                <?php
                              }
                                ?>
                                </select>
                    </div>
                   
                </div>

               
              
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-block">
				
                             
                            <table id="example"  cellspacing="0" width="100%" class="table " >
                                <thead>
                                    <tr>
                                        
                                        <th>Date</th>
                                        <th>Time</th>
                                        <th>Humidity</th>
                                        <th>Temperature</th>

                                    </tr>
                                </thead>

                                <tbody>

                                    <?php
                                    if (!isset($getobj)){
                                        echo "<tr><td>Currently no data has be inserted.</td><td></td><td></td></tr>";
                                    }else{
                                        
foreach ($getobj as $seq => $val) {
    echo "<tr>"
    . "<td>{$val['Date']['S']}</td>"
    . "<td>{$val['Time']['S']}</td>"
    . "<td>{$val['Humidity']['S']}</td>"
    . "<td>{$val['Temperature']['S']}</td>"
    . "</tr>";
   }
                                       
                                    }
                                    ?>

                                </tbody>
                            </table>
                               
                            </div>
                        </div>
                    </div>
                </div>
        
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
      <script src="js/jquery.dataTables.min.js"></script>
            <script src="js/dataTables.bootstrap.min.js"></script>
    <!-- Menu Plugin JavaScript -->
    <script src="plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.js"></script>
    <!--slimscroll JavaScript -->
    <script src="js/jquery.slimscroll.js"></script>
    <!--Wave Effects -->
    <script src="js/waves.js"></script>
    <!-- Custom Theme JavaScript -->
    <script src="js/custom.min.js"></script>
    <script>
     $(document).ready(function () {
                                                $('#example').DataTable({
                                                    
                                                });
                                            });

    </script>
</body>

</html>
