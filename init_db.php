<?php

$pdo = new PDO("sqlite:" . __DIR__ . "/queue.sqlite3");
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$pdo->exec("CREATE TABLE IF NOT EXISTS jobs(
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    job_data TEXT NOT NULL,
    status TEXT DEFAULT 'wait',
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
)");
