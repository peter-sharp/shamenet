<?
require_once('authenticator.php');

class loggerException extends Exception { };

/**
 * Provides loging functionality including recording errors, sending
 * error/notifications emails and display error/notification flash messages to
 * the user
 **/
class Logger {
    private $db;
    private $type;
    private $message;
    private $IP;
    private $user;
    private $host_http;
    
    
    // Some defaults for the mmail method
    private $emailTo;
    private $emailSubject;
    private $emailHeaders;
    public  $lastEmailSent;
    
    // optional file to save to
    private $logFile;
    /**
     * initialises Logger class
     **/
    
    public function Logger (){
        $this->host_http = $_SERVER['HTTP_HOST'];
        
        $this->emailTo = 'peter@petersharp.co.nz';
        $this->emailSubject = 'Shamenet notification';
        $this->emailHeaders = "MIME-Version: 1.0\r\nContent-type: text/html; charset=iso-8859-1\r\n"; //header strings are special
        
        $this->logFile = "shamenetLog.txt";
    }
    
    /**
     * Setter method for a log entry
     * @return outputs true if logging was successful false if not
     **/
    public function setLog($type = '', $message = ''){
        try {
            $this->setType($type);
            $this->setMessage($message);
        } catch(Exception $error) {
             throw new loggerException('setLog: ' . $error->getMessage() );
            
        }
    }
    /**
     * Saves error/notification to the database
     **/
    public function getLog(){
        return array(
            'type' => $this->getType(),
            'message' => $this->getMessage(),
            'ip' => $this->getIP()
        );
    }
    
    
    /**
     * Save error/notification to the database or a file if parameters are given
     * @param string $file (optional) Save log to the sepcified file instead of the database.
     * @return outputs true if logging was successful false if not
     **/
    public function saveLog($medium = 'database', $location = ''){
        try{
            
            switch ($medium) { // no parameters given so will save to file
                case 'database':    
                    $this->db = new DatabaseHelper();
                    
                    $log = $this->getLog();
                    #save log data to database
                    $this->db->insert('logs', $this->getLog() );
                    break;    
          
                case 'file':
                    $file = ($location === 'default') ? $this->logFile: $location ;
                    $log = (implode(', ',$this->getLog() )) . "\n";
                    // using the FILE_APPEND flag to append the content to the end of the file
                    // and the LOCK_EX flag to prevent anyone else writing to the file at the same time
                    file_put_contents($file, $log , FILE_APPEND | LOCK_EX);
                    break;
                default:
                    throw new loggerException( 'Log medium not supported');
                    return false;
                
            }
            
        }   catch ( Exception $error) {
                throw new loggerException( 'Failed to save log, ' . $error->getMessage());
                return false;
        }
        #return or redirect user
        return true;
        
        //$user = $_SESSION['user'];
        //$user_id = $user['id'];
    }
    
    /**
     * Generates a notification based on logged data
     **/
    public function notification(){}
    
    /**
     * A temporary message shown to user
     * @param $userMessage string The message to be shown to the user
     **/
    public function flashMessage($userMessage){}
    
    /**
     * Generates and sends an error or notification email based on $this->type
     * @param string $to (optional) Email address of message recipient.
     * @param string $headers (optional) Header tag with name of sender.
     **/
    public function sendEmail($to = '', $headers = ''){
        $to = ($to) ? $to : $this->emailTo;
        $headers = ($headers) ? $headers : $this->emailHeaders;
        
        switch ($this->getType()){
            case 'error':
                $mail = $this->generateErrorEmail($this->message);
                break;
                
            case 'notification':
            case 'test':
                $mail = $this->generateNotificationEmail($this->message);
                break;
                
            default:
                throw new loggerException('sendEmail: unknown message type');
        }
        
        try{
            $subject = $mail['subject'];
            $content = $mail['content'];
            $sent = mail ( $to , $subject , $content , $headers );
            $this->setLog('notification', "Sent log email, $subject: $content." );
            $this->saveLog();
            
            if(!$sent)
                throw new loggerException("sendEmail: Failed to send email\n to: $to \n subject: $subject \n content: $content \n headers: $headers.");
        }
        catch(Exception $error){
            $this->saveLog(); //saves the original mesage
            
            throw new loggerException('Failed to send log email: '.$error->getMessage());
            $this->setLog('error', 'Failed to send log email: '.$error->getMessage() );
            $this->saveLog();
            return false;
        }
        return true;
    }
    /**
     * Recieves error data and calls sendEmail()
     **/
    private function generateErrorEmail($message){
        $subject = 'Shamenet- an error occured';
        $content = $this->generateEmailTemplate($message,'error');
        
        $mail = array(
            subject => $subject,
            content => $content
        );
        return $mail;
    }
    
    /**
     * Processes the notification and sends data to sendEmail()
     * 
     * @returns string $emailContent The mail to send
     **/
    private function generateNotificationEmail($message){
        $subject = 'Shamenet- new notification';
        $content = $this->generateEmailTemplate($message,'notification');
        $mail = array(
            subject => $subject,
            content => $content
        );
        return $mail;
    }
    
    /**
     * Generates an HTML template to send emails
     * @param 
     * @param 
     **/
    private function generateEmailTemplate($message, $type){
        $host_http = $this->host_http;
        $content = "<h1>Message from Shamenet:</h1><p>$message</p><br><a href=\"$host_http\"></a>";
        return $content;
    }
 
    public function setType($type = ''){
        if(!$type)
            throw new Exception('Can not set Message type, type not supplied');
        $this->type = $type;
        
    }
    public function getType(){
        return $this->type;
    }
    
    public function setMessage($message = ''){
        if(!$message)
            throw new Exception('Can not set message, message not supplied');
        $this->message = $message;
    }
    public function getMessage(){
        return $this->message;
    }
    
    private function getIP(){
        return $this->IP;
    }
    private function getUser(){
        return $this->user;
    }
}