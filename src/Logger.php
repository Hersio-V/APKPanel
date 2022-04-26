<?php


namespace Apkpanel;


use Exception;
use JetBrains\PhpStorm\Pure;

class Logger
{
    protected mixed $db = ""; // database
    protected string $username = ""; // username
    private mixed $ipAdress;
    /**
     * @var \Apkpanel\Account
     */
    private Account $account;

    #[Pure] public function __construct($db = "", $username = "")
    {
        $this->db = $db;
        $this->username = $username;
        $this->account = new Account($db, $username);
        $this->ipAdress = $_SERVER['REMOTE_ADDR'];

    }

    public function accessLogger(): void
    {
        try {
            $userAgent = $_SERVER['HTTP_USER_AGENT'];
            $record = $this->db->prepare("INSERT INTO access_logs set 
            acc_user_id=:user_id,
            acc_ip=:ip,
            acc_useragent=:useragent
            ");
            $record->execute(array(
                'user_id' => $this->account->getUser("u_id"),
                'ip' => $this->ipAdress,
                'useragent' => $userAgent,
            ));
        } catch (Exception) {
            return;
        }
    }

    public function eventLogger($event): void
    {
        try {
            $record = $this->db->prepare("INSERT INTO event_logs set 
            ev_user_id=:ev_user_id,
            ev_event=:ev_event,
            ev_ip=:ev_ip
            ");
            $record->execute(array(
                'ev_user_id' => $this->account->getUser("u_id"),
                'ev_ip' => $this->ipAdress,
                'ev_event' => $event,
            ));
        } catch (Exception) {
            return;
        }
    }
}