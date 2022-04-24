<?php
namespace Apkpanel;

use Exception;
use JetBrains\PhpStorm\ArrayShape;
use PDO;

class Login
{
    protected $db = null; // Database
    protected string $username = ""; // Username
    protected string $password = ""; // Password
    public string $date = ""; // For user logging

    public function __construct($db = null, $username = "", $password = "") // define variables
    {
        $this->db = $db;
        $this->username = strip_tags(trim($username));
        $this->password = strip_tags(trim($password));
        $this->date = date("d.m.Y H:i");

    }

    #[ArrayShape(['status' => "string", 'redirect' => "string"])] public function login(): array
    {
        try {
            if ($this->usernameExists()) {
                if ($this->verifyPassword()) {
                    $this->accessRecord();
                    $config = new Config();
                    $_SESSION['username'] = $this->username;
                    $_SESSION['rank'] = $this->getUser('u_rank');
                    $_SESSION['site_limit'] = $this->getUser('u_site_limit');
                    $_SESSION['license'] = $this->getUser('u_license');
                    $_SESSION['mail'] = $this->getUser('u_mail');
                    $_SESSION[$config->getSessionName()] = "";
                    return ['status' => 'success','redirect' => 'dashboard'];
                } elseif ($this->verifyPassword() == 0) {
                    return ['status' => 'error','redirect' => 'index'];
                }
            } else {
                return ['status' => 'error','redirect' => 'index'];
            }
        } catch (Exception $e) {
            return ['status' => 'server-error','redirect' => 'index'];
        }
        return ['status' => 'server-error','redirect' => 'index'];
    }

    public function hash($value): string
    {
        try {
            $hashed = sha1(md5($value));
        } catch (Exception $e) {
            header("Location: ../../login.php?status=server-error");
        }
        return substr($hashed, 0, 33);

    }

    private function usernameExists(): bool
    {
        try {
            $userExists = $this->db->prepare("SELECT * from users where u_username=:u_username");
            $userExists->execute(array('u_username' => $this->username));
        } catch (Exception $e) {
            header("Location: ../../login.php?status=server-error");
        }
        return $userExists->rowCount() > 0 ? true : false;
    }

    private function getPassword()
    {
        try {
            $password = $this->db->prepare("SELECT * from users where u_username=:u_username");
            $password->execute(array('u_username' => $this->username));
            $password = $password->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            header("Location: ../../login.php?status=server-error");
        }
        return $password['u_password'];
    }

    private function verifyPassword(): bool
    {
        return $this->hash($this->password) == $this->getPassword();
    }

    private function accessRecord(): bool
    {

        try {
            $ipAdress = $_SERVER['REMOTE_ADDR'];
            $userAgent = $_SERVER['HTTP_USER_AGENT'];
            $record = $this->db->prepare("INSERT INTO acces_logs set 
            acc_user_id=:user_id,
            acc_username=:username,
            acc_ip=:ip,
            acc_useragent=:useragent
            ");
            $insert = $record->execute(array(
                'user_id' => $this->getUser("u_id"),
                'username' => $this->getUser("u_username"),
                'ip' => $ipAdress,
                'useragent' => $userAgent,
            ));
        } catch (Exception $e) {
            header("Location: ../../login.php?status=server-error");
        }
        return $insert;
    }

    private function getUser($key)
    {
        try {
            $user = $this->db->prepare("SELECT * from users where u_username=:u_username and u_password=:u_password");
            $user->execute(array('u_username' => $this->username, 'u_password' => $this->hash($this->password)));
        } catch (Exception $e) {
            header("Location: ../../login.php?status=server-error");
        }
        return $user->fetch(PDO::FETCH_ASSOC)[$key];
    }
}