<?php

include "config.php";

class ConnectionProvider
{
    private $conHandle = null;
    function __construct()
    {
        switch(DATABASE_TYPE)
        {
            case 'mysql':
            {
                try
                {
                    $this->conHandle = new PDO("mysql:dbname=".MYSQL_DBNAME.";host=".MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD);  
                }
                catch(PDOException $e)
                {
                    $this->conHandle = null;
                }
            }
        }
    }
    public function get()
    {
        return $this->conHandle;
    }
}
?>