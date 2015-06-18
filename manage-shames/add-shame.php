<?
//secure file
if(!isset($authenticator) ) 
    die();




#create shame
if($_POST['add_shame'])
    $db->insert('shames',$_POST['add_shame']);
   
include('../header.php');
?>

<h3>Add a Shame</h3>
<form method="POST" action="<? $_SERVER['PHP_SELF']?>">
        <? include('_shame-form.php') ?>
        <button class="btn btn-success">Add Shame</button>
</form>
<?include('../footer.php');?>