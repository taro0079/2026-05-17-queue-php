<?php

class Db
{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = new PDO("sqlite:" . __DIR__ . "/queue.sqlite3");
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function getPdo(): PDO
    {
        return $this->pdo;
    }
}
