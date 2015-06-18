<?
//secure file
if(!isset($authenticator) ) 
    die();




#create shame
if($_POST['add_user'])
    $db->insert('users',$_POST['add_user']);
   
include('../header.php');
?>

<h3>Add a User</h3>
<form action="<? $_SERVER['PHP_SELF']?>" method="POST">
        <? include('_user-form.php') ?>
        <button class="btn btn-success">Add User</button>
</form>

<?include('../footer.php');?>