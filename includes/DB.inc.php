

<?php

class DB
{
    private $host      ;
    private $dbUsername ;
    private $dbPass     ;
  

    protected function connect()
    {
        $this->dbUsername="root";
        $this->dbPass="";
        $this->host="mysql:host=localhost;dbname=phpblog";
        $conn = new PDO($this->host, $this->dbUsername, $this->dbPass);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        return $conn;
       
    }
}
?>