<?
//secure file
if(!isset($authenticator) ) 
    die();
    
$authenticator->redirectUnauthenticatedUser();

#create shame
if($_POST['view_shame'])
    $db->update('shames',$_POST['view_shame'], $_GET['shame_id']);
   
if($_GET['shame_id']){
    $shame_id = $_GET['shame_id'];
    $view_shame = $db->queryRow("SELECT * FROM `shames` WHERE id = '$shame_id'");
    $readonly = true;
} 
else {
    header('Location: /manage-shames/?error=No ID supplied.');
}

include('../header.php');
?>

<h3>View a Shame</h3>
<form method="POST" action="<? $_SERVER['PHP_SELF']?>">
        <? include('_shame-form.php') ?>
        <button class="btn btn-success">View Shame</button>
</form>
<?include('../footer.php');?>