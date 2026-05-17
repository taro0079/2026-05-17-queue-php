<?php
require_once "Command.php";

class SendEmailCommand implements Command
{
    private string $email;
    private string $message;

    public function __construct(string $email, string $message)
    {
        $this->email = $email;
        $this->message = $message;
    }

    public function execute(): void
    {
        echo " -> Processing: {$this->email}にメール送信中";
        sleep(2);
        echo " -> Processing: {$this->email}にメール送信完了";
    }
}
