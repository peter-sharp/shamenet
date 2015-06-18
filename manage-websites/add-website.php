<?
//secure file
if(!isset($authenticator) ) 
    die();




#create website
if($_POST['add_website'])
    $db->insert('websites',$_POST['add_website']);
   
include('../header.php');
?>

<h3>Add a Website</h3>
<form action="<? $_SERVER['PHP_SELF']?>" method="POST">
        <? include('_website-form.php') ?>
        <button class="btn btn-success">Add Website</button>
</form>
<?include('../footer.php');?>