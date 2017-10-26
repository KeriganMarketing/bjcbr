<?PHP
######################################################
#                                                    #
#                Forms To Go 4.1.1                   #
#             http://www.bebosoft.com/               #
#                                                    #
######################################################




define('kOptional', true);
define('kMandatory', false);




error_reporting(E_ERROR | E_WARNING | E_PARSE);
ini_set('track_errors', true);

function DoStripSlashes($fieldValue)  { 
 if ( get_magic_quotes_gpc() ) { 
  if (is_array($fieldValue) ) { 
   return array_map('DoStripSlashes', $fieldValue); 
  } else { 
   return stripslashes($fieldValue); 
  } 
 } else { 
  return $fieldValue; 
 } 
}

function FilterCChars($theString) {
 return preg_replace('/[\x00-\x1F]/', '', $theString);
}

function CheckEmail($email, $optional) {
 if ( (strlen($email) == 0) && ($optional === kOptional) ) {
  return true;
 } elseif ( eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$", $email) ) {
  return true;
 } else {
  return false;
 }
}


function CheckTelephone($telephone, $valFormat, $optional) {
 if ( (strlen($telephone) == 0) && ($optional === kOptional) ) {
  return true;
 } elseif ( ereg($valFormat, $telephone) ) {
  return true;
 } else {
  return false;
 }
}



if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
 $clientIP = $_SERVER['HTTP_X_FORWARDED_FOR'];
} else {
 $clientIP = $_SERVER['REMOTE_ADDR'];
}

$FTGquestion = DoStripSlashes( $_POST['question'] );
$FTGname = DoStripSlashes( $_POST['name'] );
$FTGemail = DoStripSlashes( $_POST['email'] );
$FTGradio = DoStripSlashes( $_POST['radio'] );
$FTGname2 = DoStripSlashes( $_POST['name2'] );
$FTGphone = DoStripSlashes( $_POST['phone'] );



$validationFailed = false;

# Fields Validations


if (!CheckEmail($FTGemail, kOptional)) {
 $FTGErrorMessage['email'] = 'Please make sure you entered your email address correctly.';
 $validationFailed = true;
}

if (!CheckTelephone($FTGphone, '[0-9]{3}\-[0-9]{3}\-[0-9]{4}', kOptional)) {
 $FTGErrorMessage['phone'] = 'Please make sure you entered your phone number correctly.';
 $validationFailed = true;
}



# Include message in error page and dump it to the browser

if ($validationFailed === true) {

 $errorPage = '<html><head><title>Error</title></head><body>Errors found: <!--VALIDATIONERROR--></body></html>';

 $errorPage = str_replace('<!--FIELDVALUE:question-->', $FTGquestion, $errorPage);
$errorPage = str_replace('<!--FIELDVALUE:name-->', $FTGname, $errorPage);
$errorPage = str_replace('<!--FIELDVALUE:email-->', $FTGemail, $errorPage);
$errorPage = str_replace('<!--FIELDVALUE:radio-->', $FTGradio, $errorPage);
$errorPage = str_replace('<!--FIELDVALUE:name2-->', $FTGname2, $errorPage);
$errorPage = str_replace('<!--FIELDVALUE:phone-->', $FTGphone, $errorPage);
$errorPage = str_replace('<!--ERRORMSG:email-->', $FTGErrorMessage['email'], $errorPage);
$errorPage = str_replace('<!--ERRORMSG:phone-->', $FTGErrorMessage['phone'], $errorPage);


 $errorList = @implode("<br />\n", $FTGErrorMessage);
 $errorPage = str_replace('<!--VALIDATIONERROR-->', $errorList, $errorPage);

 echo $errorPage;

}

if ( $validationFailed === false ) {

 # Email to Form Owner

$emailSubject = FilterCChars("User question from Doctor's Orders e-newsletter");

$emailBody = "I have a Question\n"
 . "\n"
 . "My question is: $FTGquestion\n"
 . "\n"
 . "My name is: $FTGname\n"
 . "My email address is: $FTGemail\n"
 . "\n"
 . "\n"
 . "I want to schedule an appointment\n"
 . "\n"
 . "Please call me to schedule an appointment with: $FTGradio\n"
 . "\n"
 . "my name is: $FTGname2\n"
 . "My phone number is: $FTGphone\n"
 . "";
 $emailTo = 'ddarby@boneandjointclinicbr.com';

$emailFrom = FilterCChars("doctorsorders@boneandjointclinicbr.com");

$emailHeader = "From: $emailFrom\n"
 . 'Cc: jack@kerigan.com' . "\n"
 . "MIME-Version: 1.0\n"
 . "Content-type: text/plain; charset=\"ISO-8859-1\"\n"
 . "Content-transfer-encoding: 7bit\n";

mail($emailTo, $emailSubject, $emailBody, $emailHeader);


  # Redirect user to success page

header("Location: http://www.boneandjointclinicbr.com/thankyou.html");

}

?>