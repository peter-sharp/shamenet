<?
//secure file
if(!isset($authenticator) ) 
    die();
    
$authenticator->redirectUnauthenticatedUser();

#create shame
if($_POST['add_website'])
    $db->update('websites',$_POST['edit_website'], $_GET['website_id']);
   
if($_GET['website_id']){
    $website_id = $_GET['website_id'];
    $view_website = $db->queryRow("SELECT * FROM `websites` WHERE id = '$website_id'");
    $readonly = true;
} 
else {
    header('Location: /manage-websites/?error=No ID supplied.');
}

include('../header.php');
?>

<h3>View a website</h3>
<form method="POST" action="<? $_SERVER['PHP_SELF']?>">
        <? include('_website-form.php') ?>
        <button class="btn btn-success">View website</button>
</form>

<?include('../footer.php');?>