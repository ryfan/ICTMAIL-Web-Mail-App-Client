<?php
session_start();
if( !isset($_SESSION["email"]) && !isset($_SESSION["pswd"]) ){
  header('location: login.php');
}
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="./assets/images/favicon.png">
    <title>Bantuan Penggunaan - ICT Mail</title>
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
                      <li class="nav-item dropdown" style="top:5px;"><span style="color:white;">Saat ini login sebagai <code><?php echo $_SESSION['email'];?></code></li>
                        <li>&nbsp;</li>
                        <li class="nav-item dropdown">
                              <a href="logout.php" class="waves-effect waves-dark btn btn-danger"><i class="mdi mdi-power"></i> Logout</a>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <aside class="left-sidebar">
            <div class="scroll-sidebar">
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <li> <a class="waves-effect waves-dark" href="index.php" aria-expanded="false"><i class="mdi mdi-gauge"></i><span class="hide-menu">Dashboard</span></a></li>
                        <li> <a class="waves-effect waves-dark" href="compose.php" aria-expanded="false"><i class="mdi mdi-pencil"></i><span class="hide-menu">Kirim Pesan</span></a></li>
                        <li> <a class="waves-effect waves-dark" href="inbox.php" aria-expanded="false"><i class="mdi mdi-inbox-arrow-down"></i><span class="hide-menu">Pesan Masuk</span></a></li>
                        <li> <a class="waves-effect waves-dark active" href="help.php" aria-expanded="false"><i class="mdi mdi-help-circle"></i><span class="hide-menu">Bantuan</span></a></li>
                        <li> <a class="waves-effect waves-dark" href="about.php" aria-expanded="false"><i class="mdi mdi-information-variant"></i><span class="hide-menu">Tentang</span></a>
                    </ul>
                </nav>
            </div>
        </aside>
        <div class="page-wrapper">
            <div class="container-fluid">
                <div class="row page-titles">
                    <div class="col-md-5 col-8 align-self-center">
                      <h3 class="text-themecolor m-b-0 m-t-0">Bantuan Penggunaan</h3>
                      <ol class="breadcrumb">
                          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                          <li class="breadcrumb-item active">Bantuan Penggunaan</li>
                      </ol>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-block">
                                <h2>Bantuan Penggunaan Aplikasi</h2><hr>
                                <ul>
                                  <ol>
                                    <li>Menu <code>Dashboard</code> merupakan menu halaman utama ketika sudah login.</li>
                                    <li>Menu <code>Kirim Pesan</code> merupakan menu untuk mengirim pesan atau email.</li>
                                    <li>Menu <code>Pesan Masuk</code> merupakan menu untuk melihat pesan masuk dengan mengklik "Baca Pesan" <br>kemudian masukan kunci kriptografi untuk mendekrip pesan beserta lampiran.</li>
                                    <li>Menu <code>Bantuan</code> merupakan menu untuk membantu user dalam penggunaan aplikasi.</li>
                                    <li>Menu <code>Tentang</code> merupakan menu informasi mengenai aplikasi ICT Mail.</li>
                                  </ol>
                                </ul>
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
