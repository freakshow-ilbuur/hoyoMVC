<?php


class Database {
    private $dbname = DB_NAME;
    private $dbhost = DB_HOST;
    private $dbpass = DB_PASS;
    private $dbuser = DB_USER;


    private $dbh;
    private $stmt;
    private $error;

    public function __construct(){
        $dsn = 'mysql:host='.$this->dbhost.';dbname='.$this->dbname;
        $options = array(
            PDO::ATTR_PERSISTENT =>true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        );

        try{
            $this->dbh = new PDO($dsn, $this->dbuser, $this->dbpass, $options);


        }catch(PDOException $e){
            $this->error = $e->getMessage();
            echo $this->error;
        }
    }
    public function query($sql){
        $this->stmt = $this->dbh->prepare($sql);

    }
    public function bind($param, $value, $type=null){
        if(is_null($type)){
            switch(true){
                case is_int($value):
                $type = PDO::PARAM_INT;
                break;
                case is_bool($value):
                $type = PDO::PARAM_BOOL;
                break;
                case is_null($value):
                $type = PDO::PARAM_NULL;
                break;

                default :
                $type = PDO::PARAM_STRING;
            }
        }
        $this->stmt->bindValue($param, $value, $type);
    }
    public function execute(){
       return  $this->stmt->execute();
    }

    public function resultSet(){
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_OBJ);
    }
    public function singleResult(){
        $this->execute();
        return $this->stmt->fetch(PDO::FETCH_OBJ);
    }

}