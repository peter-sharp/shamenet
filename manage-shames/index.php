<?
//Require security helpers
require_once('../authenticator.php');
$authenticator = new AuthenticatorHelper();
$db = new DatabaseHelper();
// Secured content redierct unauthenticated users.
$authenticator->redirectUnauthenticatedUser();

switch($_GET['action']){
    case 'add-shame':
        require('add-shame.php');
        die();
        break;
        
    case 'edit-shame':
        require('edit-shame.php');
        die();
        break;
        
    case 'view-shame':
        require('view-shame.php');
        die();
        break;
        
    defalult:
}



if($shames = $db->getAllFromTable('shames') ) {
    echo 'Success';
}
else {
    echo 'Error: table name not supplied';
};

include('../header.php');
?>
<h1>Manage Shames</h1>
<? if($_GET['success'] ) echo '<p class="alert alert-success">'.$_GET['success'].'</p>'; ?>
<? if($_GET['error'] ) echo '<p class="alert alert-danger">'.$_GET['error'].'</p>'; ?>
<a href="/peter/shamenet/manage-shames/?action=add-shame" class="btn btn-success">Add shame</a>
<h3>List Shames</h3>
<ul> <?
foreach($shames as $shame){
    ?>
    <li>
        <strong><?= $shame['websiteid']?></strong>
        <em>- <?= $shame['description'] ?></em>
        <a href="/peter/shamenet/manage-shames/?action=edit-shame&shame_id=<?=$shame['id'] ?>"><i class="fa fa-pencil"></i>Edit</a>
        <a href="/peter/shamenet/manage-shames/?action=view-shame&shame_id=<?=$shame['id'] ?>"><i class="fa fa-eye"></i>View</a>
    </li>
    <?
} ?>
</ul>
<?include('../footer.php');?>