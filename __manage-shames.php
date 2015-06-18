<?
//Require security helpers
require('authenticator.php');
// Secured content redierct unauthenticated users.
redirectUnauthenticatedUser();

#list all users
connectToDatabase();
global $mysql;

$query_sql = "";
$query = mysql_query($query_sql, $mysql)
        or die( 'query failed:'.mysql_error() );
        
while($user = mysql_fetch_assoc($query)){
    $users[] = $user;
}
#create user

#edit user
#view user
#delete user
