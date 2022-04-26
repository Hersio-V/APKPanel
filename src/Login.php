<?php
namespace Apkpanel;

use Exception;
use JetBrains\PhpStorm\ArrayShape;
use PDO;

class Login
{
    protected mixed $db = null; // Database
    protected string $username = ""; // Username
    protected string $password = ""; // Password

    public function __construct($db = null, $username = "", $password = "") // define variables
    {
        $this->db = $db;
        $this->username = strip_tags(trim($username));
        $this->password = strip_tags(trim($password));
    }

    #[ArrayShape(['status' => "string", 'redirect' => "string"])] public function login(): array
    {
        try {
            $logger = new Logger($this->db,$this->username);
            $config = new Config();
            if ($this->usernameExists()) {
                if ($this->verifyPassword()) {
                    $logger->accessLogger();
                    $_SESSION['username'] = $this->username;
                    $_SESSION['rank'] = $this->getUser('u_rank');
                    $_SESSION['site_limit'] = $this->getUser('u_site_limit');
                    $_SESSION['license'] = $this->getUser('u_license');
                    $_SESSION[$config->getSessionName()] = "";
                    return ['status' => 'success','redirect' => 'dashboard'];
                } elseif ($this->verifyPassword() == 0) {
                    return ['status' => 'error','redirect' => 'index'];
                }
            } else {
                return ['status' => 'error','redirect' => 'dashboard'];
            }
        } catch (Exception) {
            return ['status' => 'server-error','redirect' => 'dashboard'];
        }
        return ['status' => 'server-error','redirect' => 'dashboard'];
    }

    public function hash($value): string
    {
        try {
            $hashed = sha1(md5($value));
        } catch (Exception) {
            header("Location: ../../dashboard.php?status=server-error");
        }
        if (!empty($hashed)) {
            return substr($hashed, 0, 33);
        }

        return "Hata!";

    }

    private function usernameExists(): bool
    {
        try {
            $userExists = $this->db->prepare("SELECT * from users where u_username=:u_username");
            $userExists->execute(array('u_username' => $this->username));
        } catch (Exception) {
            return false;
        }
        if ($userExists->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    private function getPassword(): string
    {
        try {
            $password = $this->db->prepare("SELECT * from users where u_username=:u_username");
            $password->execute(array('u_username' => $this->username));
            $password = $password->fetch(PDO::FETCH_ASSOC);
        } catch (Exception) {
            return "";
        }
        return $password['u_password'];
    }

    private function verifyPassword(): bool
    {
        return $this->hash($this->password) == $this->getPassword();
    }

    private function getUser($key): string
    {
        try {
            $user = $this->db->prepare("SELECT * from users where u_username=:u_username and u_password=:u_password");
            $user->execute(array('u_username' => $this->username, 'u_password' => $this->hash($this->password)));
        } catch (Exception ) {
            return "";
        }
        return $user->fetch(PDO::FETCH_ASSOC)[$key];
    }



}