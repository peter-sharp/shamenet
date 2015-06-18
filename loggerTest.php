<?
require('logger.php');
class loggerTest extends PHPUnit_Framework_TestCase {
    
    public function testCanSaveLogToDatabase(){
        $logger = new Logger();
        
        $logger->setLog('test', 'message');
        $this->assertEquals(true ,$logger->saveLog(), "Log did not save to database!" );
    }
    
    public function testCanSaveLogToFile(){
        $logger = new Logger();
        
        $logger->setLog('test', 'message');
        $this->assertEquals(true ,$logger->saveLog('file', 'default'), "Log did not save to file!" );
    }
    
    public function testCanSendLogEmail(){
        $logger = new Logger();
        
        $logger->setLog('test', 'email');
        $this->assertEquals(true ,$logger->sendEmail(), "Log email could not be sent!" );
    }
}