<?php


namespace Apkpanel;


use JetBrains\PhpStorm\Pure;

class Config
{
    private string $sessionName = "panelUser";
    /**
     * @var \Apkpanel\Login
     */
    private Login $login;

    #[Pure] public function __construct()
    {
        $this->login = new Login();
    }

    public function getSessionName(): string
    {
        return $this->login->hash($this->sessionName);
    }

}