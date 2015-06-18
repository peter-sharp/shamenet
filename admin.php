<?
//Include security helpers
require_once('authenticator.php');
$authenticator = new AuthenticatorHelper();
$db = new databaseHelper();
// Secured content redierct unauthenticated users.

$authenticator->redirectUnauthenticatedUser();

switch($_GET['action']){
    case 'manage-shames':
        header('Location: /peter/shamenet/manage-shames/');
        break;
    case 'manage-websites':
        header('Location: /peter/shamenet/manage-websites/');
        break;
    case 'manage-users':
        header('Location: /peter/shamenet/manage-users/');
        break;
}

echo "Hello Mr Adminson";
include('header.php');
?>

<!-- html content for admin page -->

<h1>The bridge</h1>
<div class="col-xs-4">
    <h2>manage users</h2>
</div>
<div class="col-xs-4">
    <h2>manage websites</h2>
</div>
<div class="col-xs-4">
    <h2>manage shame</h2>
</div>

<?


include('footer.php');
?>