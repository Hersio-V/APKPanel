<?php


namespace Apkpanel;


class Site
{
    protected mixed $db = ""; // Database
    protected string $username = ""; // Username


    public function __construct($db = null, $username = "") // define variables
    {
        $this->db = $db;
        $this->username = strip_tags(trim($username));
    }


}