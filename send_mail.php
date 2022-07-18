<?php

if(isset($_POST['submit-form'])){
    $name = ucwords($_POST['name']); // required 
    $email = $_POST['email']; // required 
    $gender = $_POST['gender']; // required 
    $comments = ucfirst($_POST['messages']);
    $date=date("F d, Y - h:i");

    require('classes/PHPMailerAutoload.php');
    $mail = new PHPMailer();
    $mail->IsSMTP(true);
    $mail->Host = "mail.onesteprepairs.in";
    $mail->SMTPOptions = array(
        'ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true,
        )
    );
    $mail->SMTPDebug  = 0; 
    $mail->SMTPAuth   = true;   
    $mail->Port       = 587;  
    $mail->Username   = "support@onesteprepairs.in";
    $mail->Password   = "supercoder@#123"; 
    $mail->IsHTML(true);   
    $mail->SetFrom('support@onesteprepairs.in'); 
    $mail->AddAddress('developer@savit.in');
    $mail->AddAddress('manit921@gmail.com');   
    $mail->Subject="New Enquiry From ".$email;
    if(get_magic_quotes_gpc()) { $comment = stripslashes($comment); }

    if(!empty($name)){
    $mail->Body='<table width="570" cellpadding="0" cellspacing="0" border="0" align="left">
         <tbody><tr><td>.
            </td><td style="font-size:13px;line-height:1.4"><br>
        Please find customer details for enquiry made on <b>'.$date.'</b><br><br><table width="95%" cellpadding="3" cellspacing="0" border="0">
            <tbody><tr>
                <td colspan="3" style="font-size:13px"><b>Enquiry Details:</b></td>
            </tr><tr valign="top">
                <td width="35%" style="font-size:13px">Client Name</td>
        <td width="1%" style="font-size:13px">:</td>
                <td style="font-size:13px"><b>'.ucwords($name).'</b></td>
            </tr><tr valign="top">
                <td width="35%" style="font-size:13px">Email</td>
        <td width="1%" style="font-size:13px">:</td>
                <td style="font-size:13px"><b>'.$email.'</b></td>
            </tr><tr valign="top">
                <td width="35%" style="font-size:13px">Gender</td>
        <td width="1%" style="font-size:13px">:</td>
                <td style="font-size:13px"><b>'.$gender.'</b></td>
            </tr><tr valign="top">
                <td width="35%" style="font-size:13px">Message</td>
        <td width="1%" style="font-size:13px">:</td>
                <td style="font-size:13px"><b>'.ucfirst($comments).'</b></td>
            </tr></tbody></table><br><br></td></tr></tbody></table>';
    $sent = $mail->send();
    if($sent){      
    $mail->ClearAllRecipients();
    $mail->From = "support@onesteprepairs.in"; //$email;
    $mail->FromName = 'Enquiry Form Submission For '.$email.' - '.$date.'';
    $mail->AddAddress($email);
    $mail->Subject = "Enquiry Form Summary";
    $mail->Body = "Thank you for submitting your enquiry to us. We will try to contact you asap to discuss more details with you further.";
    $mail->send();
    }
    echo '<script>window.history.back(alert("Thank you for submitting your enquiry to us. We will try to contact you asap to discuss more details with you further."));</script>';
    }
}else{
    echo 'false';
}

?>
