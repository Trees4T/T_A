
<?php
require '../../assets/PHPMailer/PHPMailerAutoload.php';
session_start();
$mail = new PHPMailer;

date_default_timezone_set('Asia/Jakarta');
$partisipan=$_POST['email'];
//$mail->SMTPDebug = 3;                               // Enable verbose debug output

$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'cvps8538361263.hostwindsdns.com';  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'system@trees4trees.org';                 // SMTP username
$mail->Password = '5y5t3m32';                           // SMTP password
$mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 465;                                    // TCP port to connect to

$mail->setFrom('system@trees4trees.org', 'Tree Allocation System');
//$mail->addAddress(''.$partisipan.'', 'Participants');     // Add a recipient
$mail->addAddress('rio.jerico@trees4trees.org');               // Name is optional

//$mail->addReplyTo('info@trees4trees.org', 'Information');
// $mail->addCC('cc@example.com');
// $mail->addBCC('bcc@example.com');

// $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
// $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
$mail->isHTML(true);                                  // Set email format to HTML

$mail->Subject = 'Tree Allocation';

$jumlah_sesi=$_SESSION['jml_sesi'];
$mail->Body    = '


				<table align="center" width="600">

         <tr>
           <td bgcolor="#394a59" align="center">
             <br><br><h2><font color="white">Transaction Successful! </font></h2>
           </td>
         </tr>
         <tr align="center">
          <td bgcolor="#fff">
           <table align="center" class="table">
                          <tr>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                          </tr>
                          <tr>
                            <td><b>Operator</td>
                            <td>:</td>
                            <td>'.$_SESSION['user'] .'</td>
                          </tr>
                          <tr>
                            <td><b>Datetime</td>
                            <td>:</td>
                            <td>'.$_SESSION['waktu'.$jumlah_sesi.''] .'</td>
                          </tr>
                          <tr>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                          </tr>

                          <tr class="active" >
                            <td><b>Transaction Type</td>
                            <td>:</td>
                            <td>'. $_SESSION['type_transaksi'.$jumlah_sesi.'']   .'</td>
                          </tr>
                          <tr>
                            <td><b>Name</td>
                            <td>:</td>
                            <td>'. $_SESSION['nama_partisipan'.$jumlah_sesi.''] .'</td>
                          </tr>
                          <tr class="active" >
                            <td><b>Order</td>
                            <td>:</td>
                            <td>'. $_SESSION['no_order'.$jumlah_sesi.''] .'</td>
                          </tr>
                          <tr>
                            <td><b>Shipment</td>
                            <td>:</td>
                            <td>'. $_SESSION['no_shipment'.$jumlah_sesi.''] .'</td>
                          </tr>
                          <tr>
                            <td><b>BL</td>
                            <td>:</td>
                            <td>'. $_SESSION['bl'.$jumlah_sesi.'']   .'</td>
                          </tr>
                          <tr class="active" >
                            <td><b>Qty Trees</td>
                            <td>:</td>
                            <td>'. $_SESSION['qty_trees'.$jumlah_sesi.''] .' </td>
                          </tr>
                          <tr>
                            <td><b>Qty WINS</td>
                            <td>:</td>
                            <td>'. $_SESSION['qty_wins'.$jumlah_sesi.''] .' </td>
                          </tr>
                          <tr class="active" >
                            <td><b>1st WINS</td>
                            <td>:</td>
                            <td>'. $_SESSION['first_wins'.$jumlah_sesi.''] .'</td>
                          </tr>
                          <tr>
                            <td><b>Last Wins</td>
                            <td>:</td>
                            <td>'. $_SESSION['last_wins'.$jumlah_sesi.''] .'</td>
                          </tr>
                          <tr>
                            <td><b>WIN Status</td>
                            <td>:</td>
                            <td><font color="green">Activated</font></td>
                          </tr>
                          <br>
                      </table>
                      <br><br>
          </td>
         </tr>
         <tr>
          <td bgcolor="#394a59" align="center">
          <br>
          <font color="#fff" size="0.5">&copy; '.date("Y").' Trees4Trees&trade; </font>
          <br><br>
          </td>
         </tr>
        </table>






                      </body>


                      ';
$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo $pesan='Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo $pesan='Message has been sent';
}

$_SESSION['pesan']=$pesan;
header("location:../../admin.php?42de454bbfd728cccac78b8cd02dd7a8dad073cd0507d21247b4f3fe00d74be9");

 ?>
