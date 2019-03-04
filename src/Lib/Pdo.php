<?php

namespace App\Lib;

class Pdo
{
    /** @var \PDO $connection */
    private static $connection = null;

    private function __construct()
    {
        $this->init();
    }

    private function init()
    {
        if (self::$connection === null) {
            $host = getenv('DB_HOST');
            $port = getenv('DB_PORT');
            $database = getenv('DB_NAME');

            $dns = "mysql:host={$host};port={$port};dbname={$database}";
            $user = getenv('DB_USER');
            $pass = getenv('DB_PASS');

            self::$connection = new \PDO($dns, $user, $pass);
        }
    }

    public static function getInstance()
    {
        return new self();
    }

    public function getConnection()
    {
        return self::$connection;
    }

    public function getVersion()
    {
        return self::$connection->query('SELECT VERSION()')->fetch();
    }
}
