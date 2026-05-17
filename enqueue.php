<?php

require_once "SendEmailCommand.php";

$pdo = new PDO("sqlite:" . __DIR__ . "/queue.sqlite3");
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$address = "test@example.com";
$message = "test";
$sendEmailJob = new SendEmailCommand($address, $message);

$stmt = $pdo->prepare("INSERT INTO jobs (job_data) values (:job_data)");
$stmt->execute([":job_data" => serialize($sendEmailJob)]);
echo "ジョブをid: " . $pdo->lastInsertId() . "に登録しました";
