	

    <?php
	/*require("class.phpmailer.php");
	echo "dimos";    
 	echo "2";
    //$mail = new PHPMailer();
     
    //Send mail using gmail
    if($send_using_gmail){
        $mail->IsSMTP(); // telling the class to use SMTP
        $mail->SMTPAuth = true; // enable SMTP authentication
        $mail->SMTPSecure = "ssl"; // sets the prefix to the servier
        $mail->Host = "smtp.gmail.com"; // sets GMAIL as the SMTP server
        $mail->Port = 465; // set the SMTP port for the GMAIL server
        $mail->Username = "dimosrap7@gmail.com"; // GMAIL username
        $mail->Password = "dr2811991"; // GMAIL password
    }
     
    //Typical mail data
    $mail->AddAddress("raptis.dimos@yahoo.gr", "Raptis Dimos");
    $mail->SetFrom("dimosrap@yahoo.gr", "Test");
    $mail->Subject = "Test Subject";
    $mail->Body = "Testing mail service";
     
    try{
        $mail->Send();
        echo "Success!";
    } catch(Exception $e){
        //Something went bad
        echo "Fail :(";
    }*/
	$headers = 'From: webmaster@example.com'; 
	mail('raptis.dimos@yahoo.gr', 'Test email using PHP', 'This is a test email message', $headers, '-fwebmaster@example.com');     

    ?>


