<?php

namespace DEMO\PostgreSQL;

class Connection {

    /**
     * Connection
     * @var type
     */
    private static $conn;

    /**
     * Connect to the database and return an instance of \PDO object
     * @return \PDO
     * @throws \Exception
     */
    public function connect() {

        $host       = "postgresql";
        $port       = "5432";
        $dbname     = "testdb";
        $username   = "postgres";
        $password   = "postgres";
        // connect to the postgresql database
        $conStr = sprintf("pgsql:host=%s;port=%d;dbname=%s;user=%s;password=%s",
                $host,$port,$dbname,$username,$password);

        $pdo = new \PDO($conStr);
        $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

        return $pdo;
    }

    /**
     * return an instance of the Connection object
     * @return type
     */
    public static function get() {
        if (null === static::$conn) {
            static::$conn = new static();
        }

        return static::$conn;
    }

    protected function __construct() {

    }

    private function __clone() {

    }

    private function __wakeup() {

    }

}
