<?php

namespace App\Lib;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Setup;

class Orm
{
    /** @var \Doctrine\DBAL\Connection $connection */
    private static $connection = null;

    private function __construct()
    {
        $this->init();
    }

    private function getConfig()
    {
        return [
            'driver' => 'pdo_mysql',
            'host' => getenv('DB_HOST'),
            'port' => getenv('DB_PORT'),
            'user' => getenv('DB_USER'),
            'password' => getenv('DB_PASS'),
            'dbname' => getenv('DB_NAME'),
            'charset' => 'utf8',
        ];
    }

    /**
     * @throws \Doctrine\ORM\ORMException
     */
    private function init()
    {
        if (self::$connection === null) {
            $config = Setup::createAnnotationMetadataConfiguration([__DIR__ . '/src/Model'], true);
            $entityManager = EntityManager::create($this->getConfig(), $config);
            self::$connection = $entityManager->getConnection();
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
        return self::$connection->createQueryBuilder()->select('VERSION()')->execute()->fetch();
    }

    /**
     * @param string $table
     * @param array $data
     * @return int
     */
    public function insert(string $table, array $data)
    {
        return self::$connection->insert($table, $data);
    }

    /**
     * @param string $table
     * @param array $data
     * @param array $identifier
     * @return int
     */
    public function update(string $table, array $data, array $identifier)
    {
        return self::$connection->update($table, $data, $identifier);
    }
}
