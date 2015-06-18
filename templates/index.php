<?
//require security helpers
require('authenticator.php');
$authenticator = new AuthenticatorHelper();

// start the output buffer
ob_start();
?>

<!-- homepage $htmlContent goes here -->



<?
//get the content of the buffer
$htmlContent = ob_get_contents();
// clean the buffer
ob_end_clean();
//load the template, ouputting $htmlContent
require('template.php');
?>