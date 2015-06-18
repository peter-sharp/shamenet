<?
//Require security helpers
require('authenticator.php');
// Secured content redierct unauthenticated users.
redirectUnauthenticatedUser();

#list all users

global $mysql;
$users = array();
connectToDatabase();

#create user
if($_POST['add_user']){
    $username = $_POST['add_user']['username'];
    $password = $_POST['add_user']['password'];
    
    $add_user_sql = "INSERT INTO users (username, password) VALUES('$username','$password')";
    $add_user = mysql_query($add_user_sql);
    
    $message = "successfuly added <strong>$username</strong>."
}

if($_GET['user_id']){
    $user_id = $_GET['user_id'];
    $edit_user_sql = "SELECT * FROM users WHERE id = '$user_id'"
    $edit_user_query = mysql_query($edit_user_sql, $mysql);
    $edit_user = mysql
}


$query_sql = "SELECT * FROM `users`";

$query = mysql_query($query_sql, $mysql)
        or die( 'query failed:'.mysql_error() );
        
while($user = mysql_fetch_assoc($query)){
    $users[] = $user;
    // JAVASCRIPT: users.push(user);
}
// Start the output buffer
ob_start();
?>
<h1>Manage Users</h1>

<? if($message): ?>
    <p class="alert alert-success"></p>
<?endif; ?>

<h3>List Users</h3>
<ul> <?
foreach($users as $user){
    ?>
    <li><strong><?= $user['username']?></strong> - <? date('D jS F Y h:i:s A', strtotime($user['date_created']) ) ?></li>
    <?
} ?>
</ul>




<h3>Add a User</h3>
<form action="<? 1_SERVER['PHP_SELF']?>" method="POST">
        <? include('_user-form.php') ?>
        <button class="btn btn-success">Add User</button>
</form>

<h3>Edit a User</h3>
<form action="<? 1_SERVER['PHP_SELF']?>" method="POST">
        <? include('_user-form.php') ?>
        <button class="btn btn-success">Add User</button>
</form>

<h3>View User</h3>
<form>
    <?
     $readOnly = true;
     include('_user-form.php');
    ?>
</form>



#edit user
#view user
#delete user