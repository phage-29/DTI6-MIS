<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'src/Exception.php';
require 'src/PHPMailer.php';
require 'src/SMTP.php';

function sendEmail($sendTo, $subject, $content)
{
    $mail = new PHPMailer;

    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->Port = 587;
    $mail->SMTPAuth = true;
    $mail->Username = 'phpmailer720@gmail.com';
    $mail->Password = 'rodfdvywkirdtwnd';
    $mail->SMTPSecure = 'tls';
    $mail->isHTML(true);
    $mail->setFrom('phpmailer720@gmail.com', 'MSG-IT Administrator');
    $mail->addAddress($sendTo);
    // $mail->AddBCC('angelopatrimonio@dti.gov.ph');
    // $mail->AddBCC('bemyjohncollado@dti.gov.ph');
    $mail->AddBCC('dace.phage@gmail.com');
    $mail->Subject = $subject;
    $mail->Body = $content;

    if ($mail->send()) {
        return 'Email sent successfully';
    } else {
        return 'Email could not be sent. Error: ' . $mail->ErrorInfo;
    }
}

// $Email = 'dace.phage@gmail.com';
// $Subject = "MSG-IT - " . $RequestNo;
// $Message = "";
// $Message .= "<p><img src='https://upload.wikimedia.org/wikipedia/commons/1/14/DTI_Logo_2019.png' alt='' width='58' height='55'></p>";
// $Message .= "<hr>";
// $Message .= "<div>";
// $Message .= "<div>Dear " . $acc->FirstName . " " . $acc->LastName . ",</div>";
// $Message .= "<div>I hope this email finds you well. We acknowledge and appreciate your report related to IT/ICT Issue. We understand that you have encountered " . $Complaint . ".</div>";
// $Message .= "<div>Here are the details of your ticket:</div>";
// $Message .= "<div>Ticket Number: " . $RequestNo . "</div>";
// $Message .= "<div>Date Submitted: " . $DateRequested . "</div>";
// $Message .= "<div>Description of Issue: " . $Complaint . "</div>";
// $Message .= "<div>Please be assured that we are committed to resolving this matter at the earliest. Our support team will reach out to you with updates and, if necessary, additional information required to assist in the resolution.</div>";
// $Message .= "<div>We appreciate your patience and understanding as we work to resolve this matter. Thank you.</div>";
// $Message .= "<div>Best Regards,</div>";
// $Message .= "<div>MSG-IT Administrator</div>";
// $Message .= "<div>IT Support Staff</div>";
// $Message .= "<div>DTI Region VI</div>";
// $Message .= "<div><hr>&copy; Copyright <strong>MSG-IT </strong>2024. All Rights Reserved</div>";
// $Message .= "</div>";
// $result = sendEmail($Email, $Subject, $Message);
// echo $result;