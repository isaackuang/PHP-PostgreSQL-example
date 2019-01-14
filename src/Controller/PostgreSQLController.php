<?php
namespace DEMO\Controller;

date_default_timezone_set('UTC');


class PostgreSQLController
{
    private static $conn;
    //$credentials = new Aws\Credentials\Credentials('key', 'secret');
    public function hello()
    {
        $resp = "hello";
        return $resp;
    }

    public static function get()
    {
        if (null === static::$conn)
        {
            static::$conn = new static();
        }
        return static::$conn;
    }

    public function connect()
    {
        $host       = "postgresql";
        $port       = "5432";
        $dbname     = "testdb";
        $username   = "postgres";
        $password   = "postgres";

        $conStr = sprintf("pgsql:host=%s;port=%d;dbname=%s;user=%s;password=%s",
                $host,$port,$dbname,$username,$password);

        $pdo = new \PDO($conStr);
        $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

        return $pdo;
    }

}
