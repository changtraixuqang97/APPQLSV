<?php
function getDatabase()
{
    $dbconn = mysqli_connect("localhost","root",null,"databaseqlsv");
    die("Unable to connect to MySQL: " . mysqli_error());
    return $dbconn;
}
class databaseqlsv
{
    public $dbconn;
    public $debug;
    /**
     * open DB connection
     */
    public function __construct($debug)
    {
		
        try {
            $this->dbconn = mysqli_connect("localhost","root",null,"databaseqlsv") or
    die("Unable to connect to MySQL: " . mysqli_error());
	 mysqli_query($this->dbconn,"SET NAMES 'utf8'");
        } catch (Exception $ex) {}
        $this->debug = ($debug === '1');
    }
    public function isValid()
    {
		//ket noi thanh cong
        return $this->dbconn !== null;
    }
    /**
     * Close DB connection
     */
    public function close()
    {
        if ($this->isValid()) {
			//close connect
            mysqli_close($this->dbconn);
			//giai phong
            $this->dbconn = null;
        }
    }
    /**
     * execute INSERT, SELETE,... sql, return void, no need to clear result
     */
    public function execute($sql)
    {
        if ($this->debug === true) {
            echo ('Query : ' . $sql);
        }
        if ($this->isValid()) {
            try {
              $result=  mysqli_query($this->dbconn,$sql);
			  return $result;
            } catch (Exception $ex) {}
        }
    }
    /**
     * execute SELECT sql, return result or null, need to clear  afer fetching result
     */
    public function select($sql)
    {
        if ($this->debug === true) {
            echo ('Query : ' . $sql);
        }
        if ($this->isValid()) {
            try {
                $result = mysqli_query($this->dbconn,$sql);
                return $result;
            } catch (Exception $ex) {}
        }
        return null;
    }
    /**
     * Close result returned from select function
     */
 
}
