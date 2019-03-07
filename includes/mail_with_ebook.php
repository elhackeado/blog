<?php
    $result="";
    $alert_class="";
    

    if(isset($_POST['submit'])){
        $holder_email = mysqli_real_escape_string($connection, $_POST['email']);
        $query="SELECT * from ebook_holders WHERE holder_email='$holder_email'";
        $result = mysqli_query($connection,$query);
        $rowcount=mysqli_num_rows($result);


        if($rowcount<1){
        require 'phpmailer/PHPMailerAutoload.php';
        $mail = new PHPMailer;
        $body = file_get_contents('includes/ebook_email_tempelate.html');
        $mail->isSMTP();
        $mail->Host='smtp.gmail.com';
        $mail->Port=587;
        $mail->SMTPAuth=true;
        $mail->SMTPSecure='tls';
        $mail->Username='senderemail@gmail.com';
        $mail->Password='senderpassword';

        $mail->setFrom('senderemail@gmail.com','DIY.ENTREPRENEUR');
        $mail->addAddress($_POST['email']);
        
        

        $mail->isHTML(true);
        $mail->Subject='DIY.ENTREPRENEUR';
        $mail->MsgHTML($body);

        if(!$mail->send()){
            
            $result = "Something went wrong";
            $alert_class = "alert alert-danger";
            
            
        }
        else{
            $result="We have sent the Ebook to your email.";
            $alert_class = "alert alert-success";
            $query="INSERT into ebook_holders (holder_email, holding_date) VALUES ('$holder_email', now())";
            mysqli_query($connection,$query);

           
        }
    }
    else{
        $result = "You already hold the Ebook";
        $alert_class = "alert alert-danger";
    }

}

?>