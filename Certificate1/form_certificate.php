<?php 

if(isset($_POST['name'])){
	$font="BRUSHSCI.TTF";
	$image=imagecreatefromjpeg("certificate.jpg");
	$color=imagecolorallocate($image,19,21,22);
	$name="Dhiraj Deka";
	imagettftext($image,90,0,740,780,$color,$font,$_POST['name']);
	// $date="6th may 2022";
	// imagettftext($image,20,0,450,595,$color,"AGENCYR.TTF",$date);
	$file=time();
	$file_path="certificate/".$file.".jpg";
	$file_path_pdf="certificate/".$file.".pdf";
	imagejpeg($image,$file_path);
	imagedestroy($image);

	require('fpdf.php');
	$pdf=new FPDF();
	$pdf->AddPage();
	$pdf->Image($file_path,0,0,210,150);
	$pdf->Output($file_path_pdf,"F");

	include('smtp/PHPMailerAutoload.php');
	$mail=new PHPMailer();
	$mail->isSMTP();
	$mail->Host='smtp.gmail.com';
	$mail->Port=587;
	$mail->SMTPSecure="tls";
	$mail->SMTPAuth=true;
	$mail->Username="bhikuayush56@gmail.com";
	$mail->Password="ayushman@50";
	$mail->setFrom("bhikuayush56@gmail.com");
	$mail->addAddress($_POST['email']);
	$mail->isHTML(true);
	$mail->Subjet="Certificate Generated";
	$mail->Body="Certificate Generated";
	$mail->addAttachment($file_path_pdf);
	$mail->SMTPOptions=array("ssl"=>array(
		"verify_peer"=>false,
		"verify_peer_name"=>false,
		"allow_self_signed"=>false,
	));
	if($mail->send()){
		echo '<small style="color:green;">Send Successfully</small>';
	}else{
		echo $mail->ErrorInfo;
	}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">

    <!-- Font Awesome CSS -->
    <link rel="stylesheet" type="text/css" href="../css/all.min.css">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">

    <!-- Custom Style CSS -->
    <link rel="stylesheet" type="text/css" href="../css/style.css" />
</head>
<body>

<div class="container mt-5">
    <div class="row">
    <div class="col-sm-6 offset-sm-3 jumbotron">
    <h3 class="mb-5">Welcome to E-Learning Certificate Page</h3>
    <form method="post" action="">
      <div class="form-group row">
       <label for="" class="col-sm-4 col-form-label">Student Name</label>
       <div class="col-sm-8">
         <input type="textbox" class="form-control" tabindex="2" maxlength="12" size="12" name="name" value="">
       </div>
      </div>
      <div class="form-group row">
       <label for="" class="col-sm-4 col-form-label">Student Email</label>
       <div class="col-sm-8">
        <input type="email" class="form-control" tabindex="10" name="email" value="">
       </div>
      </div>
      <div class="text-center">
       <input value="Request" type="submit"	class="btn btn-primary" onclick="">
       <a href="../Student/studentProfile.php" class="btn btn-secondary">Cancel</a>
      </div>
     </form>
     <small class="form-text text-danger">Note: Get Eduford certificate by completing entire course</small>
     </div>
    </div>
  </div>


<!-- Jquery and Boostrap JavaScript -->
<script type="text/javascript" src="../js/jquery.min.js"></script>
    <script type="text/javascript" src="../js/popper.min.js"></script>
    <script type="text/javascript" src="../js/bootstrap.min.js"></script>

    <!-- Font Awesome JS -->
    <script type="text/javascript" src="../js/all.min.js"></script>

    <!-- Custom JavaScript -->
    <script type="text/javascript" src="../js/custom.js"></script>
</body>
</html>


