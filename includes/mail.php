<?php
    $result="";
    $alert_class="";
    if(isset($_POST['submit'])){
        require 'phpmailer/PHPMailerAutoload.php';
        $mail = new PHPMailer;

        $mail->isSMTP();
        $mail->Host='smtp.gmail.com';
        $mail->Port=587;
        $mail->SMTPAuth=true;
        $mail->SMTPSecure='tls';
        $mail->Username='senderemail@gmail.com';
        $mail->Password='Password';

        $mail->setFrom($_POST['email'],$_POST['name']);
        $mail->addAddress('tothisemail@gmail.com');
        

        $mail->isHTML(true);
        $mail->Subject='Form Submission: Contact Us';
        $mail->Body='<h1 align=center>Name :'.$_POST['name'].'<br>Email: '.$_POST['email'].'<br>Phone: '.$_POST['phone'].'</h1>'.'<br>'.$_POST['msg'];

        if(!$mail->send()){
            
            $result = "Something went wrong";
            $alert_class = "alert alert-danger";
            
            
        }
        else{
            $result="Thanks <strong>".$_POST['name']."</strong> for contacting us. I'll get back to you soon!";
            $alert_class = "alert alert-success";
           
        }

}

?>