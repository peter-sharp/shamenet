<?
//secure file
if(!isset($authenticator) ) 
    die();

$authenticator->redirectUnauthenticatedUser();

#create shame
if($_POST['add_shame'])
    $db->update('shames',$_POST['edit_shame'], $_GET['shame_id']);
   
if($_GET['shame_id']){
    $shame_id = $_GET['shame_id'];
    $edit_shame = $db->queryRow("SELECT * FROM `shames` WHERE id = '$shame_id'");
} 
else {
    header('Location: /manage-shames/?error=No ID supplied.');
}

include('../header.php');
?>

<h3>Edit a Shame</h3>
<form method="POST" action="<? $_SERVER['PHP_SELF']?>">
        <? include('_shame-form.php') ?>
        <button class="btn btn-success">Edit Shame</button>
</form>
<?include('../footer.php');?>