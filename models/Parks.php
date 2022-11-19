<?php

require_once __DIR__ . '/../helpers/database/Connexion.php';

class Parks
{
    // --------------------------------------------------------------------------------------------------
    // ----------------------------------ATTRIBUTS------------------------------------------------
    // --------------------------------------------------------------------------------------------------
    private int $_id;
    private string $_name;
    private string $_slug;
    private string $_description;
    private string $_url;
    private string $_latitude;
    private string $_longitude;
    private string $_created_at;
    private string $_validated_at;
    private int $_idRegion;
    private int $_idTheme;
    private int $_idUsers;
    private PDO $pdo;

    // --------------------------------------------------------------------------------------------------
    // ----------------------------------CONSTRUCT-----------------------------------------------
    // --------------------------------------------------------------------------------------------------
    public function __construct(string $name, string $slug, string $description, string $url, string $latitude, string $longitude, int $idRegion, int $idTheme, int $idUsers)
    {
        $this->_name = $name;
        $this->_slug = $slug;
        $this->_description = $description;
        $this->_url = $url;
        $this->_latitude = $latitude;
        $this->_longitude = $longitude;
        $this->_idRegion = $idRegion;
        $this->_idTheme = $idTheme;
        $this->_idUsers = $idUsers;
        $this->pdo = Connexion::getInstance();
    }

    // -------------------------------------------------------------------------------------------------
    // --------------------------------------OTHER METHOD-------------------------------------
    // -------------------------------------------------------------------------------------------------
    // ---------------------------------------
    // -------------------ELEMENT EXIST
    // ---------------------------------------
    public static function elementExist(int $id = null, string $slug = null, string $url = null): bool
    {
        $pdo = Connexion::getInstance();
        if ($id != null) {
            $sql = 'SELECT `id` FROM `parks` WHERE `id` = :id ;';
        }
        if ($slug != null) {
            $sql = 'SELECT `slug` FROM `parks` WHERE `slug` = :slug ;';
        }
        if ($url != null) {
            $sql = 'SELECT `url` FROM `parks` WHERE `url` = :url ;';
        }
        $sth = $pdo->prepare($sql);
        if ($id != null) {
            $sth->bindValue(':id', $id, PDO::PARAM_INT);
        }
        if ($slug != null) {
            $sth->bindValue(':slug', $slug);
        }
        if ($url != null) {
            $sth->bindValue(':url', $url);
        }
        $isExist = $sth->execute();
        if ($isExist) {
            return (empty($sth->fetch())) ? false : true;
        }
    }

    // ---------------------------------------
    // -------------------READ ELEMENT
    // ---------------------------------------
    public static function readElement(int $id = null, string $slug = null): bool|object
    {
        $pdo = Connexion::getInstance();
        if ($id != null) {
            $sql = 'SELECT `url`, `validated_at` FROM `parks` WHERE `id` = :id ;';
        }
        if ($slug != null) {
            $sql = 'SELECT `latitude`, `longitude`, `id` FROM `parks` WHERE `slug` = :slug;';
        }
        $sth = $pdo->prepare($sql);
        if ($id != null) {
            $sth->bindValue(':id', $id, PDO::PARAM_INT);
        }
        if ($slug != null) {
            $sth->bindValue(':slug', $slug);
        }
        $sth->execute();
        return $sth->fetch();
    }

    // -------------------------------------------------------------------------------------------------
    // ------------------------------------------CRUD-----------------------------------------------
    // -------------------------------------------------------------------------------------------------
    // ---------------------------------------
    // -------------------SET
    // ---------------------------------------
    public function set(int $idUsers = NULL): bool
    {
        if (is_null($idUsers)) {
            $sql = 'INSERT INTO `parks`(`name`, `slug`,`description`,`url`,`latitude`,`longitude`, `idRegion`, `idTheme`, `idUsers`)
            VALUES (:name, :slug, :description, :url, :latitude, :longitude, :idRegion, :idTheme, :idUsers);';
        }
        if (!is_null($idUsers)) {
            $sql = 'UPDATE `parks` SET 
            `name` = :name, 
            `slug` =  :slug,
            `description` = :description, 
            `url` = :url, 
            `latitude` = :latitude,
            `longitude` = :longitude,
            `validated_at` = :validated_at,
            `idRegion` = :idRegion,
            `idTheme` = :idTheme
            WHERE `id` = :id ;';
        }
        $sth = $this->pdo->prepare($sql);
        $sth->bindValue(':name', $this->getName());
        $sth->bindValue(':slug', $this->getSlug());
        $sth->bindValue(':description', $this->getDescription());
        $sth->bindValue(':url', $this->getUrl());
        $sth->bindValue(':latitude', $this->getLatitude());
        $sth->bindValue(':longitude', $this->getLongitude());
        $sth->bindValue(':idRegion', $this->getIdRegion(), PDO::PARAM_INT);
        $sth->bindValue(':idTheme', $this->getIdTheme(), PDO::PARAM_INT);
        if (is_null($idUsers)) {
            $sth->bindValue(':idUsers', $this->getIdUsers(), PDO::PARAM_INT);
        }
        if (!is_null($idUsers)) {
            $sth->bindValue(':id', $idUsers, PDO::PARAM_INT);
            $sth->bindValue(':validated_at', $this->getValidated_at());
        }
        if ($sth->execute()) {
            return ($sth->rowCount() > 0) ? true : false;
        }
    }



    // ------------------------------------------
    // -------------------READ All
    // ------------------------------------------
    public static function readAll($validated_at): array
    {
        $pdo = Connexion::getInstance();
        $sql = 'SELECT `parks`.*, `themes`.`theme`, `regions`.`region`, `images`.`idParks` FROM `parks`
        -- INNER JOIN `opinions` on `parks`.`id` = `opinions`.`idParks`
        INNER JOIN `images` ON `parks`.`id` = `images`.`idParks`
        INNER JOIN `regions` ON `parks`.`idRegion` = `regions`.`id`
        INNER JOIN `themes` ON `parks`.`idTheme`= `themes`.`id`
        ';
        if ($validated_at == NULL) {
            $sql .= ' WHERE `parks`.`validated_at` IS NULL;';
        }
        if ($validated_at != NULL) {
            $sql .= ' WHERE `parks`.`validated_at` IS NOT NULL;';
        }
        $sth = $pdo->query($sql);
        return $sth->fetchAll();
    }


    // ----------------------------------------
    // -------------------READ
    // ----------------------------------------
    public static function read(int $id): object | bool
    {
        $pdo = Connexion::getInstance();
        $sql = 'SELECT `parks`.* , `themes`.`theme`,`regions`.`region`,`images`.`idParks` 
        FROM `parks`
        -- RIGHT JOIN `opinions` on `parks`.`id` = `opinions`.`idParks`
        RIGHT JOIN `images` ON `parks`.`id` = `images`.`idParks`
        RIGHT JOIN `regions` ON `parks`.`idRegion`= `regions`.`id`
        RIGHT JOIN `themes` ON `parks`.`idTheme` = `themes`.`id`
        WHERE `parks`. `id` = :id';
        $sth = $pdo->prepare($sql);
        $sth->bindValue(':id', $id, PDO::PARAM_INT);
        return ($sth->execute()) ? $sth->fetch() : false;
    }


    // ---------------------------------------------
    // -------------------DELETE
    // ---------------------------------------------
    /**
     * @param int $id
     * 
     * @return bool
     */
    public static function delete(int $id): bool
    {
        $pdo = Connexion::getInstance();
        $sql = 'DELETE FROM `parks` WHERE `id` = :id';
        $sth = $pdo->prepare($sql);
        $sth->bindValue(':id', $id, PDO::PARAM_INT);
        if ($sth->execute()) {
            return ($sth->rowCount() >= 1) ? true : false;
        }
        return false;
    }

    // -------------------------------------------------------------------------------------------------

    // ------------------------------------------
    // -------------------GETTER / SETTER
    // ------------------------------------------
    // ----------------------------
    // --------Id
    // ----------------------------
    /** get
     * @return int
     */
    public function getId(): int
    {
        return $this->_id;
    }

    /** set
     * @param int $id
     * 
     * @return void
     */
    public function setId(int $id): void
    {
        $this->_id = $id;
    }

    // ----------------------------
    // -------name
    // ----------------------------
    /** get
     * @return string
     */
    public function getName(): string
    {
        return $this->_name;
    }

    /** set
     * @param mixed $Name
     * 
     * @return void
     */
    public function setName(string $name): void
    {
        $this->_name = $name;
    }

    // ----------------------------
    // -------slug
    // ----------------------------
    public function getSlug(): string

    {
        return $this->_slug;
    }

    public function setSlug(string $slug): void
    {
        $this->_slug = $slug;
    }


    // ----------------------------
    // -------description
    // ----------------------------
    /** get
     * @return string
     */
    public function getDescription(): string
    {
        return $this->_description;
    }

    /** set
     * @param mixed $description
     * 
     * @return void
     */
    public function setDescription(string $description): void
    {
        $this->_description = $description;
    }

    // ----------------------------
    // -------url
    // ----------------------------
    /** get
     * @return string
     */
    public function getUrl(): string
    {
        return $this->_url;
    }

    /** set
     * @param string $url
     * 
     * @return void
     */
    public function setUrl(string $url): void
    {
        $this->_url = $url;
    }

    // ----------------------------
    // -------latitude
    // ----------------------------
    /** get
     * @return float
     */
    public function getLatitude(): float
    {
        return $this->_latitude;
    }

    /** set
     * @param float $latitude
     * 
     * @return void
     */
    public function setLatitude(float $latitude): void
    {
        $this->_latitude = $latitude;
    }

    // ----------------------------
    // -------Longitude
    // ----------------------------
    /** get
     * @return float
     */
    public function getLongitude(): float
    {
        return $this->_longitude;
    }

    /** set
     * @param float $longitude
     * 
     * @return void
     */
    public function setLongitude(float $longitude): void
    {
        $this->_longitude = $longitude;
    }

    // ----------------------------
    // --------created at
    // ----------------------------
    /** get
     * @return string
     */
    public function getCreated_at(): string
    {
        return $this->_created_at;
    }

    /** set
     * @param string $created_at
     * 
     * @return void
     */
    public function setCreated_at(string $created_at): void
    {
        $this->_created_at = $created_at;
    }

    // ----------------------------
    // --------validate
    // ----------------------------
    /** get
     * @return bool
     */
    public function getValidated_at(): bool | string
    {
        return $this->_validated_at;
    }

    /** set
     * @param mixed $validate
     * 
     * @return void
     */
    public function setValidated_at($validated_at): void
    {
        $this->_validated_at = $validated_at;
    }

    // ----------------------------
    // --------idRegion
    // ----------------------------
    /**
     * @return int
     */
    public function getIdRegion(): int
    {
        return $this->_idRegion;
    }

    /**
     * @param int $idRegion
     * 
     * @return void
     */
    public function setIdRegion(int $idRegion): void
    {
        $this->_idRegion = $idRegion;
    }

    // ----------------------------
    // --------idTheme
    // ----------------------------
    /** get
     * @return int
     */
    public function getIdTheme(): int
    {
        return $this->_idTheme;
    }

    /** set
     * @param int $idTheme
     * 
     * @return void
     */
    public function setIdTheme(int $idTheme): void
    {
        $this->_idTheme = $idTheme;
    }

    // ----------------------------
    // --------idUsers
    // ----------------------------
    /** get
     * @return int
     */
    public function getIdUsers(): int
    {
        return $this->_idUsers;
    }

    /** set
     * @param int $idUsers
     * 
     * @return void
     */
    public function setIdUsers(int $idUsers): void
    {
        $this->_idUsers = $idUsers;
    }
}
