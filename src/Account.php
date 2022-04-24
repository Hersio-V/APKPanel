<?php


namespace Apkpanel;


use Exception;
use PDO;

class Account
{
    protected $db = null; // Database
    protected string $username = ""; // Username
    public string $date = ""; // For user logging

    public function __construct($db = null, $username = "") // define variables
    {
        $this->db = $db;
        $this->username = strip_tags(trim($username));
        $this->date = date("d.m.Y H:i");

    }

    public function getUser($key)
    {
        try {
            $user = $this->db->prepare("SELECT * from users where u_username=:u_username");
            $user->execute(array('u_username' => $this->username));
        } catch (Exception $e) {
            header("Location: ../../login.php?status=server-error");
        }
        return $user->fetch(PDO::FETCH_ASSOC)[$key];
    }

    public function getTemplates($key)
    {
        try {
            $templates = [];
            $template = $this->db->prepare("SELECT * from templates where t_user_id=:t_user_id");
            $template->execute(array('t_user_id' => $this->getUser('u_id')));

        } catch (Exception $e) {
            header("Location: ../../dashboard.php?status=server-error");
        }
            while ( $getValue = $template->fetch(PDO::FETCH_ASSOC)) {
                $templates[] = $getValue[$key];
            }
            return $templates;
    }

    public function getTemplate($t_name)
    {
        try {
            $template = $this->db->prepare("SELECT * from templates where t_user_id=:t_user_id and t_name=:t_name");
            $template->execute(array('t_user_id' => $this->getUser('u_id'),'t_name' => $t_name));
            $getValue = $template->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            echo $e;
        }
        return ['t_name' => $t_name,'t_title' => $getValue['t_title'],'t_content' => $getValue['t_content']];
    }

    public function setUserSettings($values)
    {
        $settings = $this->db->prepare("UPDATE users set
            u_mail=:u_mail,
            u_notify=:u_notify
            where u_username=:u_username
        ");
        $update = $settings->execute(array(
            'u_mail' => $values['mail'],
            'u_notify' => $values['notify'],
            'u_username' => $this->username
        ));

        return $update ? ['status' => 'success','redirect' => 'settings'] : ['status' => 'error','redirect' => 'settings'];
    }
}