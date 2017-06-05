<?
class DB {

    //Static variables to connect to database (Static so I don't have to use $this)
    protected static $connection;
    protected static $db_host;
    protected static $db_user;
    protected static $db_pass;
    protected static $db_name;

    //Establish DB connection upon object creation
    public function __construct() {

        self::$db_host = DB_HOST;
        self::$db_user = DB_USER;
        self::$db_pass = DB_PASS;
        self::$db_name = DB_NAME;
        self::$connection = new mysqli(self::$db_host, self::$db_user, self::$db_pass, self::$db_name);

    }

    //Query to database
    public function query($query) {
        return self::$connection->query($query);
    }

    //Special function for select queries
    public function select($query) {
        
        $rows = array();
        
        $result = $this->query($query);

        if($result === false) return false;

        while($row = $result->fetch_assoc()) {
            $rows[] = $row;
        }

        return $rows;
    }

    public function close() {
        self::$connection->close();
    }

    //Get the last error thrown by DB connection
    public function error() {
        return self::$connection->error;
    }

    public function quote($value) {
        return "'".self::$connection->real_escape_string($value)."'";
    }

}
?>