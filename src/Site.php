<?php


namespace Apkpanel;

use Exception;
use JetBrains\PhpStorm\Pure;
use PDO;
use WP_HTTP_IXR_Client;

class Site
{
    protected mixed $db = ""; // Database
    protected string $username = ""; // Username
    protected array $values = [];
    protected Account $account;


    #[Pure] public function __construct($db = null, $username = "", $values = []) // define variables
    {
        $this->db = $db;
        $this->username = strip_tags(trim($username));
        $this->values = $values;
        $this->account = new Account($db, $username);
    }


    public function getActiveSites(): int
    {
        try {
            $limit = $this->db->prepare("SELECT * from sites where s_user_id=:s_user_id and s_status=:s_status");
            $limit->execute(array(
                's_user_id' => $this->account->getUser('u_id'),
                's_status' => 1
            ));
        } catch (Exception) {
            return 999;
        }
        if (!empty($limit)) {
            return $limit->rowCount();
        }

        return 999;
    }

    public function getCategories(): array
    {
        try {
            $xmlrpc = $this->values['s_url'] . '/xmlrpc.php';
            $client = new WP_HTTP_IXR_Client($xmlrpc);
            $client->query('wp.getCategories', 0, $this->values['s_username'], $this->values['s_password']);
            $categories = $client->getResponse();
            foreach ($categories as $category) {
                $allCategories[] = ['status' => 'success', 'id' => $category['categoryId'], 'name' => $category['categoryName']];
            }
        } catch (Exception) {
            return ['status' => 'error'];
        }
        if (isset($allCategories)) {
            return $allCategories;
        }

        return ['status' => 'error'];
    }

    public function getSiteLimit(): int
    {
        return (int)$this->account->getUser("u_site_limit");
    }


    public function setSite(): array
    {
        try {
            $logger = new Logger($this->db, $this->username);

            if ($this->getActiveSites() != $this->getSiteLimit()) {
                $site = $this->db->prepare("INSERT INTO sites set
                s_user_id=:s_user_id,
                s_username=:s_username,
                s_password=:s_password,
                s_url=:s_url,
                s_theme=:s_theme,
                s_language=:s_language,
                s_shortlink_status=:s_shortlink_status
            ");
                $save = $site->execute(array(
                    's_user_id' => $this->account->getUser('u_id'),
                    's_username' => $this->values['s_username'],
                    's_password' => $this->values['s_password'],
                    's_url' => $this->values['s_url'],
                    's_theme' => $this->values['s_theme'],
                    's_language' => $this->values['s_language'],
                    's_shortlink_status' => $this->values['s_shortlink_status']
                ));
                $this->updateCategories($this->getCategories());
                $logger->eventLogger("[" . $this->values['s_url'] . "]" . ", sitelerinize eklendi.");
            } else {
                $logger->eventLogger("[" . $this->values['s_url'] . "]" . ", sitelerinize eklenemedi.");
                return ['status' => 'error', 'redirect' => 'sites'];
            }
        } catch (Exception) {
            return ['status' => 'error', 'redirect' => 'sites'];
        }

        if (!empty($save)) {
            return $save ? ['status' => 'success', 'redirect' => 'sites'] : ['status' => 'error', 'redirect' => 'sites'];
        }

        return ['status' => 'server-error', 'redirect' => 'sites'];
    }


    public function updateSite(): array
    {
        try {
            if ($this->getActiveSites() != $this->getSiteLimit()) {
                $site = $this->db->prepare("UPDATE sites set
                        s_user_id=:s_user_id,
                        s_username=:s_username,
                        s_password=:s_password,
                        s_url=:s_url,
                        s_theme=:s_theme,
                        s_language=:s_language,
                        s_shortlink_status=:s_shortlink_status
                    ");
                $update = $site->execute(array(
                    's_user_id' => $this->account->getUser('u_id'),
                    's_username' => $this->values['s_username'],
                    's_password' => $this->values['s_password'],
                    's_url' => $this->values['s_url'],
                    's_theme' => $this->values['s_theme'],
                    's_language' => $this->values['s_language'],
                    's_shortlink_status' => $this->values['s_shortlink_status']
                ));
            } else {
                return ['status' => 'error', 'redirect' => 'sites'];
            }
        } catch (Exception) {
            return ['status' => 'server-error', 'redirect' => 'sites'];
        }

        if (!empty($update)) {
            return $update ? ['status' => 'success', 'redirect' => 'sites'] : ['status' => 'error', 'redirect' => 'sites'];
        }

        return ['status' => 'server-error', 'redirect' => 'sites'];
    }

    public function getSite($key): string
    {
        try {
            $site = $this->db->prepare("SELECT * from sites where s_user_id=:s_user_id and s_url=:s_url");
            $site->execute(array(
                's_user_id' => $this->account->getUser('u_id'),
                's_url' => $this->values['s_url']
            ));
        } catch (Exception) {
            return "Hata!";
        }
        if (!empty($user)) {
            return $user->fetch(PDO::FETCH_ASSOC)[$key];
        }
        return "Hata!";
    }

    public function updateCategories($categories): bool
    {
        try {
            $categories = serialize($categories);
            $site = $this->db->prepare("UPDATE sites set
                   s_categories=:s_categories
                   where s_user_id=:s_user_id and s_url=:s_url
                ");
            $update = $site->execute(array(
                's_categories' => $categories,
                's_user_id' => $this->account->getUser('u_id'),
                's_url' => $this->values['s_url']
            ));
        } catch (Exception) {
            return false;
        }

        if (isset($update)) {
            return $update;
        }

        return false;
    }

    public function getUserSites(): array|string
    {
        try {
            $sites = $this->db->prepare("SELECT * from sites where s_user_id=:s_user_id");
            $sites->execute(array(
                's_user_id' => $this->account->getUser('u_id'),
            ));
            while ($getSite = $sites->fetch(PDO::FETCH_ASSOC)) {
                $userSites[] = $getSite;
            }
        } catch (Exception) {
            return "Hata!";
        }
        if (!empty($userSites)) {
            return $userSites;
        }
        return "Hata!";
    }
}