<?php


namespace Apkpanel;


use Exception;
use JetBrains\PhpStorm\ArrayShape;
use PDO;


class Account
{
    protected mixed $db = ""; // Database
    protected string $username = ""; // Username


    public function __construct($db = null, $username = "") // define variables
    {
        $this->db = $db;
        $this->username = strip_tags(trim($username));

    }

    public function getUser($key)
    {
        try {
            $user = $this->db->prepare("SELECT * from users where u_username=:u_username");
            $user->execute(array('u_username' => $this->username));
        } catch (Exception) {
            return "Hata!";
        }
        if (!empty($user)) {
            return $user->fetch(PDO::FETCH_ASSOC)[$key];
        }
        return "Hata!";
    }


    public function getTemplates($key): array
    {
        try {
            $templates = [];
            $template = $this->db->prepare("SELECT * from templates where t_user_id=:t_user_id");
            $template->execute(array('t_user_id' => $this->getUser('u_id')));

        } catch (Exception) {
            return ['status' => 'server-error', 'redirect' => 'templates'];
        }
        if (!empty($template)) {
            while ($getValue = $template->fetch(PDO::FETCH_ASSOC)) {
                $templates[] = $getValue[$key];
            }
        }
        return $templates;
    }

    #[ArrayShape(['t_name' => "", 't_title' => "", 't_content' => ""])] public function getTemplate($t_name): array
    {
        try {
            $template = $this->db->prepare("SELECT * from templates where t_user_id=:t_user_id and t_name=:t_name");
            $template->execute(array('t_user_id' => $this->getUser('u_id'), 't_name' => $t_name));
            $getValue = $template->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            echo $e;
        }
        if (!empty($getValue)) {
            return ['t_name' => $t_name, 't_title' => $getValue['t_title'], 't_content' => $getValue['t_content']];
        }
        return ['t_name' => 'Hata!', 't_title' => 'Hata!', 't_content' => 'Hata!'];
    }

    public function setTemplate($values): array
    {
        try {
            $logger = new Logger($this->db, $this->username);
            if ($this->isValidTemplate($values)) {
                $template = $this->db->prepare("INSERT INTO templates set
               t_title=:t_title,
               t_content=:t_content,
                t_user_id=:t_user_id,
                 t_name=:t_name
            ");
                $save = $template->execute(array(
                    't_name' => $values['t_name'],
                    't_user_id' => $this->getUser('u_id'),
                    't_title' => $values['t_title'],
                    't_content' => $values['t_content']
                ));
                $logger->eventLogger("[$values[t_name]] adlı içerik taslağı oluşturuldu.");
            } else {
                $logger->eventLogger("[$values[t_name]] adlı içerik taslağı oluşturulamadı.");
                return ['status' => 'error', 'redirect' => 'templates'];
            }
        } catch (Exception) {
            return ['status' => 'server-error', 'redirect' => 'templates'];
        }

        if (!empty($save)) {
            return $save ? ['status' => 'success', 'redirect' => 'templates'] : ['status' => 'error', 'redirect' => 'templates'];
        }

        return ['status' => 'server-error', 'redirect' => 'templates'];
    }

    public function updateTemplate($values, $oldTemplateName): array
    {
        try {
            $logger = new Logger($this->db, $this->username);
            // Get Old Template Name
            $getTemplateId = $this->db->prepare("SELECT * from templates where t_user_id=:t_user_id and t_name=:t_name");
            $getTemplateId->execute(array('t_user_id' => $this->getUser('u_id'), 't_name' => $oldTemplateName));
            $getValue = $getTemplateId->fetch(PDO::FETCH_ASSOC);
            if ($this->isValidTemplate($values)) {
                // Update Template
                $template = $this->db->prepare("UPDATE templates set
               t_title=:t_title,
               t_content=:t_content,
               t_name=:t_name
               where t_user_id=:t_user_id and t_id=:t_id
            ");
                $update = $template->execute(array(
                    't_id' => $getValue['t_id'],
                    't_name' => $values['t_name'],
                    't_user_id' => $this->getUser('u_id'),
                    't_title' => $values['t_title'],
                    't_content' => $values['t_content']
                ));
                // Logging
                if ($values['t_name'] !== $oldTemplateName) {
                    $logger->eventLogger("[$oldTemplateName] adlı içerik taslağı güncellendi. İçerik Taslağının yeni adı => [$values[t_name]]");
                } else {
                    $logger->eventLogger("[$oldTemplateName] adlı içerik taslağı güncellendi.");
                }
            } else {
                $logger->eventLogger("[$oldTemplateName] adlı içerik taslağı güncellenemedi.");
                return ['status' => 'error', 'redirect' => 'templates'];
            }
        } catch (Exception) {
            return ['status' => 'server-error', 'redirect' => 'templates'];
        }

        if (!empty($update)) {
            return $update ? ['status' => 'success', 'redirect' => 'templates'] : ['status' => 'error', 'redirect' => 'templates'];
        }

        return ['status' => 'server-error', 'redirect' => 'templates'];
    }

    public function deleteTemplate($t_name): array
    {
        try {
            $template = $this->db->prepare("DELETE FROM templates where t_user_id=:t_user_id and t_name=:t_name
            ");
            $update = $template->execute(array(
                't_name' => $t_name,
                't_user_id' => $this->getUser('u_id')
            ));
            $logger = new Logger($this->db, $this->username);
            $logger->eventLogger("[$t_name] adlı içerik taslağı silindi.");
        } catch (Exception) {
            return ['status' => 'server-error', 'redirect' => 'templates'];
        }

        if (!empty($update)) {
            return $update ? ['status' => 'success', 'redirect' => 'templates'] : ['status' => 'error', 'redirect' => 'templates'];
        }

        return ['status' => 'server-error', 'redirect' => 'templates'];
    }

    public function setShortLinkApi($values): array
    {
        try {
            $template = $this->db->prepare("UPDATE users set
              u_short_api_key=:u_short_api_key,
              u_short_api_id=:u_short_api_id
              where u_id=:u_id
            ");
            $update = $template->execute(array(
                'u_id' => $this->getUser('u_id'),
                'u_short_api_key' => $values['u_short_api_key'],
                'u_short_api_id' => $values['u_short_api_id']
            ));
            $logger = new Logger($this->db, $this->username);
            $logger->eventLogger("Kısa Link API Ayarlarınız güncellendi.");
        } catch (Exception) {
            return ['status' => 'server-error', 'redirect' => 'dashboard'];
        }

        if (!empty($update)) {
            return $update ? ['status' => 'success', 'redirect' => 'short-link-api'] : ['status' => 'error', 'redirect' => 'short-link-api'];
        }

        return ['status' => 'server-error', 'redirect' => 'short-link-api'];
    }

    public function isValidTemplate($array)
    {
        $templateTitle = isset(explode('{title}', $array['t_title'])[1]);
        $templateContent = isset(explode('{content}', $array['t_content'])[1]);

        if ($templateTitle && $templateContent !== false) {
            return true;
        } else {
            return false;
        }

    }


}