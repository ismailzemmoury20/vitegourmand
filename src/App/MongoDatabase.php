<?php
namespace App;

use MongoDB\Client;
use MongoDB\Database as MongoDB;
use MongoDB\Collection;

class MongoDatabase
{
    private static ?MongoDatabase $instance = null;
    private Client $client;
    private MongoDB $db;

    private function __construct()
    {
        $uri = $_ENV['MONGO_URI'] ?? 'mongodb://localhost:27017';
        $dbName = $_ENV['MONGO_DB_NAME'] ?? 'vite-gourmand';
        $this->client = new Client($uri);
        $this->db = $this->client->selectDatabase($dbName);
    }

    public static function getInstance(): MongoDatabase
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getCollection(string $name): Collection
    {
        return $this->db->selectCollection($name);
    }
}