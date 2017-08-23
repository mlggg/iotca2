<!DOCTYPE html>
<?php

require 'aws/aws-autoloader.php';
use Aws\S3\S3Client;
use  Aws\Api\DateTimeResult;
$return=isset($_GET['room']) ? $_GET['room'] : 'livingroom';
if ($return=='livingroom'){
$bucket = 'iotlivingroom';
}else if ($return=='babyroom'){

    $bucket = 'babyroom';
}
// Instantiate the client.
$s3Client = S3Client::factory([
    'version' => 'latest',
    'region' => 'us-east-2',
    'credentials' => [
        'key' => '',
        'secret' => '',
    ],
        ]);

// Get an object.
$result = $s3Client->listObjects(array('Bucket' => $bucket));

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
   
</head>
<style>
    #myImg {
    border-radius: 5px;
    cursor: pointer;
    transition: 0.3s;
}

#myImg:hover {opacity: 0.7;}

/* The Modal (background) */
.modal {
    display: none; /* Hidden by default */
    position: fixed; /* Stay in place */
    z-index: 1; /* Sit on top */
    padding-top: 100px; /* Location of the box */
    left: 0;
    top: 0;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    overflow: auto; /* Enable scroll if needed */
    background-color: rgb(0,0,0); /* Fallback color */
    background-color: rgba(0,0,0,0.9); /* Black w/ opacity */
}

/* Modal Content (image) */
.modal-content {
    margin: auto;
    display: block;
    width: 80%;
    max-width: 700px;
}

/* Caption of Modal Image */
#caption {
    margin: auto;
    display: block;
    width: 80%;
    max-width: 700px;
    text-align: center;
    color: #ccc;
    padding: 10px 0;
    height: 150px;
}

/* Add Animation */
.modal-content, #caption {    
    -webkit-animation-name: zoom;
    -webkit-animation-duration: 0.6s;
    animation-name: zoom;
    animation-duration: 0.6s;
}

@-webkit-keyframes zoom {
    from {-webkit-transform:scale(0)} 
    to {-webkit-transform:scale(1)}
}

@keyframes zoom {
    from {transform:scale(0)} 
    to {transform:scale(1)}
}

/* The Close Button */
.close {
    position: absolute;
    top: 70px;
    right: 35px;
    color: #f1f1f1;
    font-size: 40px;
    font-weight: bold;
    transition: 0.3s;
}

.close:hover,
.close:focus {
    color: #bbb;
    text-decoration: none;
    cursor: pointer;
}

/* 100% Image Width on Smaller Screens */
@media only screen and (max-width: 700px){
    .modal-content {
        width: 100%;
    }
    .close {
    position: absolute;
    top: 30px;
    right: 35px;
    color: #f1f1f1;
    font-size: 40px;
    font-weight: bold;
    transition: 0.3s;
}
}
    
</style>
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
                        <h4 class="page-title">Past Photos</h4> </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- row -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="white-box">
                            <div class="row page-titles">
                    <div class="col-md-6 col-8 align-self-center">
                        <h3 class="text-themecolor m-b-0 m-t-0">Photo</h3>
                       
                    </div>
                                <div class="col-md-6 col-8">
                  
                        <select class="custom-select pull-right"  onchange="location = this.value;">
                              <?php 
                              if($return == "livingroom"){
                              ?>
				<option value='photo.php?room=livingroom' selected>Living Room</option>
				<option value='photo.php?room=babyroom'>Baby Room</option>
                           <?php 
                              }else if($return == "babyroom"){
                                  
                             
                              ?>
                                    <option value='photo.php?room=livingroom' >Living Room</option>
				<option value='photo.php?room=babyroom' selected>Baby Room</option>
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
				
                            
                                <div class="table-responsive m-t-40">
                                    <table class="table stylish-table">
                                        <thead>
                                            <tr>
                                               
                                                <th>Pic</th>
                                                <th>Time</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            
				       <?php
					
                                        foreach ($result['Contents'] as $seq=> $object) {
                                         $file= "https://s3.us-east-2.amazonaws.com/{$bucket}/{$object['Key']}";
                                         $array=(array)$object['LastModified'];
                                      
                                        echo "<tr>
						<td><image src='{$file}' width='150px' height='150px' id='$seq' onclick='show($seq);' /></td>
                  
                                                <td>{$array['date']}</td>
					      </tr>";
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
            </div>
            <div id="myModal" class="modal">
  <span class="close">&times;</span>
  <img class="modal-content" id="img01">

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
var modal = document.getElementById('myModal');
// Get the image and insert it inside the modal - use its "alt" text as a caption

function show(a){
var img = document.getElementById(a);
var modalImg = document.getElementById("img01");

    modal.style.display = "block";
    modalImg.src = img.src;
  

}

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks on <span> (x), close the modal
span.onclick = function() { 
    modal.style.display = "none";
}
        </script>
</body>

</html>
