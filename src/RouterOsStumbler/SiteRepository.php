<?php namespace RouterOsStumbler;

use Aura\Marshal\Manager as Marshal;
use PDO;

class SiteRepository
{
    /**
     * @var PDO
     */
    private $pdo;

    /**
     * @var Manager
     */
    private $marshal;

    /**
     * @param PDO $pdo
     * @param Marshal $marshal
     */
    public function __construct(PDO $pdo, Marshal $marshal)
    {
        $this->pdo = $pdo;
        $this->marshal = $marshal;
    }

    /**
     * @return array
     */
    public function getAll()
    {
        $query = "SELECT * FROM sites";

        $statement = $this->pdo->prepare($query);
        $statement->execute();
        $result = $statement->fetchAll();

        $siteIds = $this->marshal->sites->load($result);

        return $this->marshal->sites->getCollection($siteIds);

    }

    /**
     * @param $id
     * @return Site
     */
    public function getById($id)
    {
        $query = "SELECT * FROM sites WHERE id :id";

        $statement = $this->pdo->prepare($query);
        $statement->bindParam('id', $id);
        $statement->execute();
        $result = $statement->fetchAll();

        $siteIds = $this->marshal->sites->load($result);

        return array_pop($this->marshal->sites->getCollection($siteIds));
    }

    /**
     * @param Site $site
     * @return bool
     */
    public function save(Site $site)
    {
        $siteName = $site->getName();

        $query = "INSERT INTO sites (name) VALUES (:name)";

        $statement = $this->pdo->prepare($query);
        $statement->bindParam('name', $siteName);

        return $statement->execute();
    }

    /**
     * @param Site $site
     * @return bool
     */
    public function delete(Site $site)
    {
        $query = "DELETE FROM sites WHERE id = :id";

        $statement = $this->pdo->prepare($query);
        $statement->bindParam('id', $site->getId());

        return $statement->execute();
    }
}