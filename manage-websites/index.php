<?
//Require security helpers
require_once('../authenticator.php');
$authenticator = new AuthenticatorHelper();
$db = new DatabaseHelper();
// Secured content redierct unauthenticated users.
$authenticator->redirectUnauthenticatedUser();

switch($_GET['action']){
    case 'add-website':
        require('add-website.php');
        die();
        break;
        
    case 'edit-website':
        require('edit-website.php');
        die();
        break;
        
    case 'view-website':
        require('view-website.php');
        die();
        break;
        
    defalult:
}



if($websites = $db->getAllFromTable('websites') ) {
    echo 'Success';
}
else {
    echo 'Error: table name not supplied';
};

include('../header.php');
?>
<h1>Manage Websites</h1>
<? if($_GET['message'] ) echo '<p class="alert alert-success">'.$_GET['message'].'</p>'; ?>
<? if($_GET['error'] ) echo '<p class="alert alert-danger">'.$_GET['error'].'</p>'; ?>
<a href="/peter/shamenet/manage-websites/?action=add-website" class="btn btn-success">Add Website</a>
<h3>List Websites</h3>
<ul> <?
foreach($websites as $website){
    ?>
    <li>
        <strong><?= $website['name']?></strong>
        <em>- <?= date('D jS F Y h:i:s A', strtotime($website['date_created']) ) ?></em>
        <a href="/peter/shamenet/manage-websites/?action=edit-website&website_id=<?=$website['id'] ?>"><i class="fa fa-pencil"></i>Edit</a>
        <a href="/peter/shamenet/manage-websites/?action=view-website&website_id=<?=$website['id'] ?>"><i class="fa fa-eye"></i>View</a>
    </li>
    <?
} ?>
</ul>

<?include('../footer.php');?>