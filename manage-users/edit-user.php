<?
//secure file
if(!isset($authenticator) ) 
    die();

$authenticator->redirectUnauthenticatedUser();

#create user
if($_POST['add_user'])
    $db->update('users',$_POST['edit_user'], $_GET['user_id']);
   
if($_GET['user_id']){
    $user_id = $_GET['user_id'];
    $edit_user = $db->queryRow("SELECT * FROM `users` WHERE id = '$user_id'");
} 
else {
    header('Location: /manage-users/?error=No ID supplied.');
}

include('../header.php');
?>

<h3>Edit a user</h3>
<form method="POST" action="<? $_SERVER['PHP_SELF']?>">
        <? include('_user-form.php') ?>
        <button class="btn btn-success">Edit user</button>
</form>
<?include('../header.php');?>