<?
require_once('authenticator.php');
$authenticator = new AuthenticatorHelper();
$db = new databaseHelper();
?>

<!DOCTYPE html>
<html>
<head>
  <title>Shame-net</title>
     <link href='http://fonts.googleapis.com/css?family=Creepster' rel='stylesheet' type='text/css'>
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">
     <link rel="stylesheet" href='/peter/shamenet/css/main.css'>
     <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
     
</head>
 
<body>
<div class="top"></div>
<div class="container">
    <div class="row">
             <? if ( $authenticator->isAuthenticated() ): ?>
                <nav>
                     <ul>
                            <li><a href="/peter/shamenet/admin.php?action=manage-shames">Manage Shame</a></li>
                            <li><a href="/peter/shamenet/admin.php?action=manage-websites">Manage Websites</a></li>
                            <li><a href="/peter/shamenet/admin.php?action=manage-users">Manage Users</a></li>
                            <li><a href="/peter/shamenet/index.php?logout=yes">logout</a></li>
                    </ul>
                </nav>
            <? endif; ?>
            
        <main class="col-xs-12">
        <? if ( !$authenticator->isAuthenticated() ): ?>
                <div class="container">
                  <h1>Shamenet#</h1>
                    <form method="POST" action="<?= $_SERVER['PHP_SELF'] ?>">
                       <h2>Login</h2>
                             <div class="form-group">
                                <label for="name">Name</label>
                                  <div class="input-group">
                                    <input type="text" class="form-control" name="login[username]" id="name" placeholder="Enter Name" required>
                                    <span class="input-group-addon"></span>
                                  </div>
                              </div>
                              <div class="form-group">
                                <label for="name">Password</label>
                                  <div class="input-group">
                                    <input type="password" class="form-control" name="login[password]" id="name" placeholder="Enter Password" required>
                                    <span class="input-group-addon"></span>
                                  </div>
                              </div>
                             <input type="submit" name="submit" id="submit" value="Submit" class="btn btn-success pull-right">
                    </form>
                </div>
            <? endif; ?>