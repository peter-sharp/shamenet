<?
require_once('authenticator.php');

class databaseException extends Exception { };
/**
 * helper class contining various database methods
 */
class DatabaseHelper { 
    private $mysql;

    
    /**
     * constructor method that initialises the database connection
     */
    function DatabaseHelper(){
        
        //open connection to database
        try {
            $this->mysql = $this->connect();
            
        } catch (Exception $e) {
            throw new databaseException( 'Database helper mysql connection error: ' . $e->getMessage() );
        }
        
        
    }
    
    /**
     * Select the database and connect to it using given parameters
     * If it is unable to connect it dies with an error message.
     * @returns resource $mysql Successfully connected Mysql database resource.
     */
    private function connect(){
        // Connect and select database
        # @TODO Replace error message with redirect + log + email notification
        $mysql = mysql_connect('localhost', 'mark_shamenet', 'Ch4ng3m3#');
        # @TODO Replace error message with redirect + log + email notification.
        mysql_select_db('mark_shamenet');
        
        return $mysql;
    }
    
    /**
     * inserts a single row of data into database based on params given and redirect
     * user on success/failure with message/error in URL parameter.
     * 
     * @param string $table Name of table to insert new row into
     * @param array $formData Array of data to insert into new row of table
     * 
     * @TODO replace switch with default of 'manage-'.$table, if $redirect param not supplied.
     */
    public function insert($table, $formData){
        

        
        foreach( $formData as $key => $value){
            $values[] = $value;
            $keys[] = $key;
        }
        
        $sql = "INSERT INTO `$table` (".implode(',',$keys).") VALUES ('".implode("','",$values)."')";
        $query = mysql_query($sql, $this->mysql);
        
        $added = implode(' ', $values);
        
        if(!$query){ //log a mysql error
            throw new databaseException( "Error in mysql query, ".mysql_error($query) );
            $message = "error=Failed to add <strong>$added</strong>";//@FIXME terrible because it exposes the my sql to the user!! 
        }                                               //Problem: we want to log the sql error without adding it to the header and send a different message to the user.
        else { // log a scuccess message for any table other than 'logs'
            $message = "message=Successfuly added <strong>$added</strong>"; //@TODO find a way to only insert the strong tags for the message displayed to the user
        }
        
        if($table != 'logs'){
            
            switch($table){
                case 'users':
                    $section = 'manage-users';
                    break;
                case 'websites':
                    $section = 'manage-websites';
                    break;
                case 'shames':
                    $section = 'manage-shames';
                    break;
            }
         
            header("Location: /peter/shamenet/$section/?$message");
        }
        
       
    }
    
     /**
     * Enables updates to specific data in the database for a given table
     * 
     * @param string $table Name of table to update in
     * @param array $formData Array of data to insert into specified row
     * @param int $id Id of form row to update data within specified table
     * 
     * @TODO write update method
     */
    public function update($table, $formData, $id){}
    
     /**
     * removes a row of a given table based on given parameters
     * 
     * @param string $table Name of table to remove row from
     * @param int $id id of row to remove from table
     * 
     * @TODO write remove function
     */
    public function remove($table, $id){}
    
    //look at variables used in function
    
     /**
     * Returns all the rows from a the table given as a parameter
     * 
     * @param string $table Name of table to show
     * @return array of all data in given table
     */
    public function getAllFromTable($table){
        
        if(!isset($table) ) {
            return false;
            throw new databaseException('getAllFromTable: table not set');
        }
        
        $query_sql = "SELECT * FROM `$table`";
        $result = $this->queryRows($query_sql);

        return $result;
    }
    
    /**
   * fetches an associative array of a single row from a table in the given sql. 
   * 
   * @param string $sql SQL to run against connected database
   * @return associative array $row Row matched by the given SQL statement
   */
    public function queryRow($sql = ''){
        # @TODO Replace error message with redirect + log + email notification
        $this->query = ($this->query)
            ? $this->query
            :   mysql_query($sql, $this->mysql)
                  or die('Query failed: ' . mysql_error());
                  
    $row   = mysql_fetch_assoc($this->query);

    return $row;
  }
    /**
     * calls the function queryRow for each row in a table and appends each
     *  result to a table returning an array of the results once finished.
     *  @param string $sql SQL to run against connected database
     * @return array of associative arrays 
     **/
  public function queryRows($sql = ''){
     
    while($row = $this->queryRow($sql) ){
            $result[] = $row;
    }
    return $result;
  }

}