<?
session_start();
require_once('database.php');
require_once('logger.php');
/**
 * Authenticator Helper Class
 **/

class AuthenticatorHelper {
    private $db;
    private $logger;
    
     /**
     * constructor method that initialises the database connection
     */
    function AuthenticatorHelper(){
        $this->db = new DatabaseHelper();
        $this->logger = new Logger();
        
        if($_POST['login']){
            $username = $_POST['login']['username'];
            $password = $_POST['login']['password'];
        
            if($user = $this->login($username, $password) ){
                // $user being a user db row
                $_SESSION['user'] = $user;
            }
            else {
                $this->logger->setLog('notification', "Attempted login failed, user name:<strong>$username</strong> password:<strong>$password</strong>");
                $this->logger->sendEmail();
                $this->logout();
            }
        }
        if( $_GET['logout'] == 'yes' ) {
                $this->logout();
        }
        
    }
    
    /**
     * Authentication functions
     **/
    /**
     * attempts to log in to the database.
     * @param $username string User name of database user
     * @param $passowrd string Password of that user
     * @return boolean True if successfully logged in otherwise false.
     **/
    public function login($username, $password){
        
        //build query to find all users
        $sql = "SELECT * FROM users WHERE username = '$username' ";
        
        //run query to find specific user
        if ($result = $this->db->queryRow($sql) ){
            if ($result['password'] == $password ){
                $_SESSION['username'] = $username;
                $_SESSION['loggedIn'] = true;
            } 
            else{
                $result = false;
            }
            
        }
        return $result;
    }
    /**
     * Destroys the user session and redirects to the home page.
     **/
    public function logout(){
        session_destroy();
        header('Location: index.php');
    }
    
    /**
     * ############################ Authenticator helper functions ############################
     **/
     
     /**
      * checks if the user is logged in
      * @return boolean True if logged in otherwise false.
      **/
    public function isAuthenticated(){
        return $_SESSION['loggedIn'];
    }
    /**
      * checks if the user is logged in
      * and calls the logout() function to kick out the user if false.
      **/
    public function redirectUnauthenticatedUser(){
        if(!$this->isAuthenticated() )
            $this->logout();
    }
    
}
?>