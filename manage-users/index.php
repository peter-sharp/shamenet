<?
//require logging helper class
require_once('../logger.php');
//Require security helpers
require_once('../authenticator.php');
$authenticator = new AuthenticatorHelper();
$logger = new Logger();
$db = new DatabaseHelper();
// Secured content redierct unauthenticated users.
$authenticator->redirectUnauthenticatedUser();

switch($_GET['action']){
    case 'add-user':
        require('add-user.php');
        die();
        break;
        
    case 'edit-user':
        require('edit-user.php');
        die();
        break;
        
    case 'view-user':
        require('view-user.php');
        die();
        break;
        
    default:
}



if( !( $users = $db->getAllFromTable('users')) ) {
    $logger->setLog('error','Error: table name not supplied');
    $logger->saveLog();
};

if($_GET['message'] ) {
    $message =  '<p class="alert alert-success">'.$_GET['message'].'</p>'; // @TODO move this to Logger's flashMesage nethod
    $logger->setLog('notification', $_GET['message']);
    $logger->saveLog();
}
else if($_GET['error'] ){
    $message = '<p class="alert alert-danger">'.$_GET['error'].'</p>';
    $logger->setLog('error', $_GET['error']);
    $logger->saveLog();
} 


include('../header.php');
?>
<h1>Manage Users</h1>
<? if($message ) echo $message; ?>

<a href="/peter/shamenet/manage-users/?action=add-user" class="btn btn-success">Add User</a>
<h3>List Users</h3>
<ul> <?
foreach($users as $user){
    ?>
    <li>
        <strong><?= $user['username']?></strong>
        <em>- <?= date('D jS F Y h:i:s A', strtotime($user['date_created']) ) ?></em>
        <a href="/peter/shamenet/manage-users/?action=edit-user&user_id=<?=$user['id'] ?>"><i class="fa fa-pencil"></i>Edit</a>
        <a href="/peter/shamenet/manage-users/?action=view-user&user_id=<?=$user['id'] ?>"><i class="fa fa-eye"></i>View</a>
    </li>
    <?
} ?>
</ul>

<?include('../footer.php');?>