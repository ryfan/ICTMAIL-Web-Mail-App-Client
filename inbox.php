<?php
session_start();
if( !isset($_SESSION["email"]) && !isset($_SESSION["pswd"]) ){
  header('location:login.php');
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
    <title>Pesan Masuk - ICT Mail</title>
    <link href="./assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="./assets/plugins/datatables/css/jquery.dataTables.css" rel="stylesheet">
    <link href="./assets/css/style.css" rel="stylesheet">
    <link href="./assets/css/colors/blue.css" id="theme" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body class="fix-header fix-sidebar card-no-border">
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
                    <li> <a class="waves-effect waves-dark active" href="inbox.php" aria-expanded="false"><i class="mdi mdi-inbox-arrow-down"></i><span class="hide-menu">Pesan Masuk</span></a></li>
                    <li> <a class="waves-effect waves-dark" href="help.php" aria-expanded="false"><i class="mdi mdi-help-circle"></i><span class="hide-menu">Bantuan</span></a></li>
                    <li> <a class="waves-effect waves-dark" href="about.php" aria-expanded="false"><i class="mdi mdi-information-variant"></i><span class="hide-menu">Tentang</span></a>
                  </ul>
                </nav>
            </div>
        </aside>
        <div class="page-wrapper">
            <div class="container-fluid">
                <div class="row page-titles">
                    <div class="col-md-5 col-8 align-self-center">
                      <h3 class="text-themecolor m-b-0 m-t-0">Pesan Masuk</h3>
                      <ol class="breadcrumb">
                          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                          <li class="breadcrumb-item active">Pesan Masuk</li>
                      </ol>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-block">
                              <div class="table-responsive">
                              <table id="inbox" class="table striped">
                          			<thead>
                          				<tr>
                          					<th>No</th>
                          					<th>Dari</th>
                          					<th>Tgl & Waktu</th>
                          					<th>Subjek</th>
                          					<th>Ukuran</th>
                          					<th>Lihat</th>
                          				</tr>
                          			</thead>
                          			<tbody>
                          				<?php
                          					$usermail = $_SESSION['email'];
                          					$password = $_SESSION['pswd'];

                          					if(strpos($usermail, "@yahoo")==true || strpos($usermail, "@ymail")==true){
                              					$hostname = '{imap.mail.yahoo.com:993/imap/ssl/novalidate-cert}INBOX';
                              				}elseif(strpos($usermail, "@aol")==true){
                                      	$hostname = '{imap.aol.com:993/imap/ssl}INBOX';
                                      }else{
                              					$hostname = '{imap.gmail.com:993/imap/ssl/novalidate-cert}INBOX';
                              				}
                          					$mbox = imap_open($hostname,$usermail,$password) or die('Cannot connect to mail server: ' . imap_last_error());
                          					$MC=imap_check($mbox);
                          					$MN=$MC->Nmsgs;
                          					$overview=imap_fetch_overview($mbox,"1:$MN",0);
                          					$size=sizeof($overview);
                          					echo "";
                          					//$no=0;
                          					for($i=$size-1;$i>=0;$i--){
                          					   	$val=$overview[$i];
                          						$msg=$val->msgno;
                          						$date=date('Y-m-d H:i:s', strtotime($val->date));
                          						$subj=isset($val->subject)?$val->subject:"(no subject)";
                          						$header = imap_header($mbox, $msg);
                          						$from = $header->from;
                          						$email_size = $val->size;
                          						$size2 = number_format ($email_size/1024);
                          						foreach ($from as $id => $object){
                          						   	$fromname = isset($object->personal)?$object->personal:$object->mailbox;
                          							  $fromaddress = $object->mailbox . "@" . $object->host;
                          						}//$no++;
                          		?>
                          					<tr>
                                    				<td> <?php echo $msg; ?> </td>
                                    				<td> <?php echo $fromaddress; ?> </td>
                                    				<td> <?php echo $date; ?> </td>
                                    				<td> <?php echo substr($subj, 0,15)."..."; ?> </td>
                                    				<td> <?php echo $size2; ?> KB</td>
                                    				<td> <a href="viewmail.php?msgno=<?php echo $msg; ?>&msgdate=<?php echo $date; ?>&msgfrom=<?php echo $fromname; ?>&msgemail=<?php echo $fromaddress ?>&msgsubj=<?php echo $subj ?>">Lihat Pesan</a> </td>
                                  			</tr>
                                  <?php } imap_close($mbox); ?>
                          			</tbody>
                          		</table>
                            </div>
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
    <script src="./assets/plugins/datatables/js/dataTables.bootstrap.min.js"></script>
    <script src="./assets/plugins/datatables/js/jquery.dataTables.js"></script>
    <script src="./assets/js/jquery.slimscroll.js"></script>
    <script src="./assets/js/waves.js"></script>
    <script src="./assets/js/sidebarmenu.js"></script>
    <script src="./assets/plugins/sticky-kit-master/dist/sticky-kit.min.js"></script>
    <script src="./assets/js/custom.min.js"></script>
    <script type="text/javascript">
    $(document).ready(function() {
    $('#inbox').DataTable( {
        "order": [[ 0, "desc" ]]
    } );
} );
    </script>
    <script src="./assets/plugins/eModal/eModal.min.js"></script>
    <script type="text/javascript">
    $('.email').click(ajaxDemo);
    function ajaxDemo() {
    var url = "viewmail.php?msgno=<?php echo $msg; ?>&msgdate=<?php echo $date; ?>&msgfrom=<?php echo $fromname; ?>&msgemail=<?php echo $fromaddress ?>&msgsubj=<?php echo $subj ?>";
        eModal.ajax(url);
    }
    </script>
</body>

</html>
