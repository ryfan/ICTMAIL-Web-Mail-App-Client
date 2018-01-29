<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="./assets/images/favicon.png">
    <title>Login - ICT Mail</title>
    <link href="./assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="./assets/css/style.css" rel="stylesheet">
    <link href="./assets/css/colors/blue.css" id="theme" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
<script type="text/javascript">
	function displayTime(){
	 var time = new Date();
	 var sh = time.getHours() + "";
	 var sm = time.getMinutes() + "";
	 var ss = time.getSeconds() + "";
	 document.getElementById("clock").innerHTML = (sh.length==1?"0"+sh:sh) + ":" + (sm.length==1?"0"+sm:sm) + ":" + (ss.length==1?"0"+ss:ss);
}
</script>
</head>

<body class="fix-header fix-sidebar card-no-border" onload="displayTime();setInterval('displayTime()', 1000);">
    <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> </svg>
    </div>
    <div id="main-wrapper">
        <header class="topbar">
            <nav class="navbar top-navbar navbar-toggleable-sm navbar-light">
                <div class="navbar-header">
                    <a class="navbar-brand" href="index.php">
                        <b style="color:white;font-size:35px;">ICT</b>
                        <span style="color:white;font-size:35px">M</span><span style="color:white;">ail </span><span style="color:white;font-size:35px">A</span><span style="color:white;">pp</span></a>
                </div>
                <div class="navbar-collapse">
                    <ul class="navbar-nav mr-auto mt-md-0">
                        <li class="nav-item"> <a class="nav-link nav-toggler hidden-md-up text-muted waves-effect waves-dark" href="javascript:void(0)"><i class="mdi mdi-menu"></i></a> </li>
                    </ul>
                    <ul class="navbar-nav my-lg-0">
                        <li><form class="form-inline my-2 my-lg-0" method="post" action="auth.php">
          <input class="form-control mr-sm-2" type="email" name="email" placeholder="Email" required autofocus autocomplete="off">
          <input class="form-control mr-sm-2" type="password" name="pswd" placeholder="Password" required >
          <button class="waves-effect waves-dark btn btn-success mr-sm-2" type="submit" name="login"><i class="mdi mdi-email"></i> Login</button>
        </form></li>
                    </ul>
                </div>
            </nav>
        </header>
        <aside class="left-sidebar">
            <div class="scroll-sidebar">
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                          <li> <a class="waves-effect waves-dark active" href="login.php" aria-expanded="false"><i class="mdi mdi-gauge"></i><span class="hide-menu">Login</span></a>
                    </ul>
                </nav>
            </div>
        </aside>
        <div class="page-wrapper">
            <div class="container-fluid">
                <div class="row page-titles">
                    <div class="col-md-5 col-8 align-self-center">
                        <h3 class="text-themecolor m-b-0 m-t-0">Login</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="">Home</a></li>
                            <li class="breadcrumb-item active">Login</li>
                        </ol>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-block">
                                <h1 style="text-align:center;color:#1e88e5;font-size:50px;">ICT Mail</h1>
                                <h2 style="text-align:center">Kirim Email Lebih Aman Menggunakan Kriptografi</h2>
                                <h4 style="text-align:center;color:silver">Harap <b style="color:#455a64">Login</b> terlebih dahulu untuk menggunakannya..</h4>
                                <center> <img src="assets/images/logo/logo-lab-ict.png" alt="" width="200px"></center>
                                <br><br>
                                <?php
                        				$day = date ("D");
                        				switch ($day) {
                        				case 'Sun' : $hari = "Minggu"; break;
                        				case 'Mon' : $hari = "Senin"; break;
                        				case 'Tue' : $hari = "Selasa"; break;
                        				case 'Wed' : $hari = "Rabu"; break;
                        				case 'Thu' : $hari = "Kamis"; break;
                        				case 'Fri' : $hari = "Jum'at"; break;
                        				case 'Sat' : $hari = "Sabtu"; break;
                        				default : $hari = "Ingatkan hari ini..";
                        				}
                        				// set the default timezone to use. Available since PHP 5.1
                        				date_default_timezone_set('Asia/Jakarta');
                        				// Prints something like: Monday
                        				$tanggal = date("d M Y");
                        				echo "<div style='float:right'>
                                <a href='index.php'>
                                <span>
                                <span class='teal-text'>$hari, </span>$tanggal - </span>
                                <span id='clock'></span>
                                </a>
                                </div>";?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <footer class="footer">
                © 2017 ICT Mail - By Ryfan Aditya Indra.
            </footer>
        </div>
    </div>
    <script src="./assets/plugins/jquery/jquery.min.js"></script>
    <script src="./assets/plugins/bootstrap/js/tether.min.js"></script>
    <script src="./assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <script src="./assets/js/jquery.slimscroll.js"></script>
    <script src="./assets/js/waves.js"></script>
    <script src="./assets/js/sidebarmenu.js"></script>
    <script src="./assets/plugins/sticky-kit-master/dist/sticky-kit.min.js"></script>
    <script src="./assets/js/custom.min.js"></script>
</body>

</html>
