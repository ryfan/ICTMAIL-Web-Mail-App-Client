<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
    <script src="./assets/plugins/sweetalert/js/sweetalert.min.js"></script>
    <link rel="stylesheet" type="text/css" href="./assets/plugins/sweetalert/css/sweetalert.css">
  </head>
  <body>
  </body>
</html>
<?php
  session_start();
  error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
  include ('phpmailer/PHPMailerAutoload.php');
  include "crypto/AES.php";
  include "crypto/RC4.php";
  if(isset($_POST['kirimemail'])){
    $mail = new PHPMailer;
    $mail->isSMTP();
    /*dipakai debugging. 0 = off (for production use), 1 = client messages, 2 = client and server messages */
    $mail->SMTPDebug = 2;
    $mail->Debugoutput = 'html';

    $from = $_SESSION['email'];
    $nmp = explode("@", $from, 2);
    $namapengirim = $nmp[0];

    $to = $_POST['tujuan'];
    $subject = $_POST['judulpesan'];
    $nmn = explode("@", $to, 2);
    $namapenerima = $nmn[0];

    if(strpos($from, "@yahoo")==true || strpos($from, "@ymail")==true){
        $mail->Host = 'smtp.mail.yahoo.com';
      }elseif(strpos($from, "@aol")==true){
      	$mail->Host = 'smtp.aol.com';
      }else{
        $mail->Host = 'smtp.gmail.com';
      }
    $mail->Port       = 587; //port smtp
    $mail->SMTPSecure = 'tls'; //security pakai ssl atau tls, tapi ssl telah deprecated
    $mail->SMTPAuth   = true; //menandakan butuh authentifikasi
    $mail->Username   = $_SESSION['email'];//email
    $mail->Password   = $_SESSION['pswd']; //password
    $messages          = $_POST['isipesan'];
    $key		          = substr(md5($_POST['kunci']), 0,16);
    $start_time = microtime(true);
    if (get_magic_quotes_gpc()){
      $subject = stripslashes($subject);
      $message = stripslashes($message);
    }
    $mail->setFrom($from, $namapengirim);
    $mail->addReplyTo($from, $namapengirim);
    $mail->addAddress($to, $namapenerima);
    $mail->Subject = $subject;
    //Enkripsi Pesan
    $loop 		= (strlen($messages) % 16 == 0) ? strlen($messages)/16 : intVal(strlen($messages)/16) + 1;
	  $ciphertext	= "";
	  for ($i=0; $i<$loop; $i++) {
		$start      = $i * 16;
		$plaintext	= substr($messages, $start, 16);
		$aes 	      = new AES($key);
		$enkrip1    = $aes->encrypt($plaintext);
		$rc4 	      = new rc4($key);
		$enkrip2    = $rc4->encrypt($enkrip1);
		$ciphertext	.= $enkrip2;
	  }

    //Enkripsi Attachment
    $file_tmpname   = $_FILES['file']['tmp_name'];
    $filename       = rand(1000,100000)."-".$_FILES['file']['name'];
    $new_filename   = strtolower($filename);
    $finalfile      = str_replace(' ','-',$new_filename);
    $size           = filesize($file_tmpname);
    $size2          = (filesize($file_tmpname))/1024;
    $file_source		= fopen($file_tmpname, 'rb');

    if($size2>25600){
      echo "<script>
      setTimeout(function() {
      swal({
          title: 'Pesan tidak dapat dikirim !',
          text: 'Maaf file terlampir tidak dapat lebih dari 25 MB',
          type: 'error'
      }, function() {
          window.location = 'compose.php';
      });
      });
      </script>";
          exit();
      }

    $url = $finalfile.".ict";
    $file_url = "attachment/$url";
    $file_output		= fopen($file_url, 'wb');
    $mod    = $size%16;
    if($mod==0){
        $banyak = $size / 16;
    }else{
        $banyak = ($size - $mod) / 16;
        $banyak = $banyak+1;
    }
    if(is_uploaded_file($file_tmpname)){
        ini_set('max_execution_time', -1);
        ini_set('memory_limit', -1);
        $aesfile = new AES($key);
        for($bawah=0;$bawah<$banyak;$bawah++){
           $data    = fread($file_source, 16);
           $cipher  = $aesfile->encrypt($data);
           fwrite($file_output, $cipher);
       }
       fclose($file_source);
       fclose($file_output);
       $fopen           = fopen($file_url, "rb");
       $size            = filesize($file_url);
       $fread           = fread($fopen, $size);
       $rc4file         = new rc4($key);
       $enc             = $rc4file->encrypt($fread);
       $fopen2          = fopen($file_url, "wb");
       fwrite($fopen2, $enc);
     }else {
     }
    $ciphertext = base64_encode($ciphertext);
    $mail->msgHTML($ciphertext);
    $mail->AltBody = '';
    $mail->addAttachment($file_url);
    if (!$mail->send()) {
      echo "<script>
      setTimeout(function() {
      swal({
          title: 'Pesan tidak dapat dikirim !',
          text: 'Error $mail->ErrorInfo',
          type: 'error'
      }, function() {
          window.location = 'compose.php';
      });
      });
      </script>";
    } else {
    }
    $end_time = microtime(true);
    $waktu= round(($end_time - $start_time), 3);
        echo "<script>
        setTimeout(function() {
        swal({
            title: 'Pengiriman Berhasil',
            text: 'Waktu pengiriman $waktu, Tekan OK untuk melanjutkan.',
            type: 'success'
        }, function() {
            window.location = 'compose.php';
        });
        });
        </script>";
    }
?>
