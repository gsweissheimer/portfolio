<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

//error_reporting(0);
//ini_set('display_errors', 0);

/*
* Mysql database class - only one connection alowed
*/
class Database
{
    private $_connection;
    private static $_instance; //The single instance

    private $_host = '213.229.107.44';
    private $_username = 'user_oralswiss'; 
    private $_password = 'oralswiss#SDS#2020!';
    private $_database = 'oralswiss_202008';

    /*private $_host     = 'localhost';
    private $_username = 'root'; 
    private $_password = '';
    private $_database = 'oralswiss_2020';*/


    /*
    Get an instance of the Database
    @return Instance
    */
    public static function getInstance()
    {
        if (!self::$_instance) { // If no instance then make one
            self::$_instance = new self();
        }

        return self::$_instance;
    }

    // Constructor
    private function __construct()
    {
        $this->_connection = new mysqli($this->_host, $this->_username, $this->_password, $this->_database);
        $this->_connection->set_charset('utf8');
        $this->_connection->autocommit(false);
        // Error handling
        if (mysqli_connect_error()) {
            trigger_error('Failed to conencto to MySQL: '.mysql_connect_error(),
                 E_USER_ERROR);
        }
    }

    // Magic method clone is empty to prevent duplication of connection
    private function __clone()
    {
    }

    // Get mysqli connection
    public function getConnection()
    {
        return $this->_connection;
    }

    public function closeConnection()
    {
        return $this->_connection->close();
    }

    public function rollbackAndClose()
    {
        $this->_connection->rollback();

        return $this->closeConnection();
    }

    public function commitAndClose()
    {
        $this->_connection->commit();

        return $this->closeConnection();
    }
}
