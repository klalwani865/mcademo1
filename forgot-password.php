<?php
    include 'connection.php';
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;
    if($_POST)
    {
        $email = $_POST['email'];
        $q = mysqli_query($connection,"select * from tbl_emp where emp_email='{$email}'");
        $count = mysqli_num_rows($q);
        if($count == 1)
        {
            $newotp = rand(111111,999999);
            mysqli_query($connection,"update tbl_emp set emp_password='{$newotp}'where emp_email='{$email}'");
            $msg = "Hello <br/>your password is ".$newotp;

            //Load Composer's autoloader
require 'vendor/autoload.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'karanlalwani105@gmail.com';                     //SMTP username
    $mail->Password   = 'qtpfxojivivnxmvs';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('karanlalwani105@gmail.com', 'Karansingh.com');
    $mail->addAddress($email, 'Karansingh.com');     //Add a recipient
    
    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Forgot Password';
    $mail->Body    = $msg;
    $mail->AltBody = $msg;

    $mail->send();
    echo "<script>alert('Password send on Email');</script>";
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

        }else{
            echo "<script>alert('Email Not Found');</script>";
        }
    }
?>
<html>
    <body>
        <form method ="post">
        Email:<input type="email" name="email"/>
        <input type="Submit"/>
        </form>
    </body>
</html>
