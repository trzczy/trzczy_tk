<?php
namespace Mvc\Model\Mapper;

class PdoObjectSingletonFactory
{
    private static $instance = NULL;
    static public function getInstance()
    {
        if (self::$instance === NULL) {
            try {
                self::$instance = new \PDO('mysql:host=localhost;port=3306;dbname=john;charset=utf8', 'john', 'passw0rd');
                self::$instance->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
                self::$instance->setAttribute(\PDO::ATTR_EMULATE_PREPARES, false);
            } catch (\PDOException $e) {
                die('<p>Connection failed: ' . $e->getMessage() . '</p>');
            }
        }
        return self::$instance;
    }
}
