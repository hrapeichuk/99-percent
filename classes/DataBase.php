<?php

namespace classes;

class DataBase
{
    /** @var null|DataBase */
    private static $instance = null;
    
    /** @var \mysqli */
    private $connection;
    
    private function __construct()
    {
        $config = $this->getConfig();   

        $this->connection = new \mysqli($config['hostname'], $config['username'], $config['password'], $config['database']);
        if ($this->connection->connect_error) die($this->connection->connect_error);
        $this->connection->set_charset("utf8");
    }
    
    public static function getInstance()
    {
        if (self::$instance == null) {
            self::$instance = new self();
        }
        
        return self::$instance;
    }

    /**
     * @return \mysqli
     */
    public function getConnection()
    {
        return $this->connection;
    }
    
    private function getConfig()
    {
        return [
            'hostname' => 'localhost',
            'database' => 'workers',
            'username' => 'vita',
            'password' => 'vita',
        ];
    }
}