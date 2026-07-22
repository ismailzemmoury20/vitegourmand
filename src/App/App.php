<?php
namespace App;

class App
{
    private static ?App $_instance = null;
    private static ?Database $db_instance = null;

    public static function getInstance(): App
    {
        if (self::$_instance === null) {
            self::$_instance = new App();
        }
        return self::$_instance;
    }

    public function getTable(string $name): object
    {
        $class = '\\App\\Table\\' . ucfirst($name) . 'Table';
        return new $class();
    }

    public function getDb(): Database
    {
        if (self::$db_instance === null) {
            $config = Config::getInstance();
            self::$db_instance = new Database(
                $config->get('db_name'),
                $config->get('db_host'),
                $config->get('db_port'),
                $config->get('db_user'),
                $config->get('db_pass')
            );
        }
        return self::$db_instance;
    }
}
