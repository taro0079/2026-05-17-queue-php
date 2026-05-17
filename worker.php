<?php

require_once "Db.php";
require_once "Command.php";
require_once "SendEmailCommand.php";

$db = new Db();
$pdo = $db->getPdo();

$stmt = $pdo->query(
    "select id, job_data from jobs where status = 'wait' ORDER BY id ASC LIMIT 1",
);
$record = $stmt->fetch(PDO::FETCH_ASSOC);

if (null === $record || empty($record)) {
    return;
}

$updateStmt = $pdo->prepare(
    "update jobs set status = 'processing' where id = :id and status = 'wait'",
);
$updateStmt->execute([":id" => $record["id"]]);
$job = unserialize($record["job_data"]);

if ($job instanceof Command) {
    $job->execute();
}

$deleteStmt = $pdo->prepare("DELETE FROM jobs WHERE id = :id");
$deleteStmt->execute([":id" => $record["id"]]);
