<?php

require_once __DIR__ . '/../helpers/database/Connexion.php';

class Images
{
    // --------------------------------------------------------------------------------------------------
    // ----------------------------------ATTRIBUTS-------------------------------------------------
    // --------------------------------------------------------------------------------------------------
    private int $_id;
    private int $_idParks;
    private $pdo;

    // --------------------------------------------------------------------------------------------------
    // ----------------------------------CONSTRUCT-----------------------------------------------
    // --------------------------------------------------------------------------------------------------
    public function __construct(int $_idParks)
    {
        $this->_idParks = $_idParks;
        $this->pdo = Connexion::getInstance();
    }

    // ------------------------------------------------
    // -------------------Move With Rename
    // ------------------------------------------------
    public static function moveRenameImg($file, $imgName, $parkSlug, $idPark)
    {
        // $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
        $extension = 'jpg';
        $from = $file['tmp_name'];
        $fileName = $imgName . '_' . $parkSlug . '.' . $extension;
        $to = __DIR__ . '/../public/upload/imgpark/' . $idPark . '/' . $fileName;
        move_uploaded_file($from, $to);
    }

    // ------------------------------------------------
    // -------------------IdParks exist
    // ------------------------------------------------
    public static function idParksExist(int $id): bool
    {
        $pdo = Connexion::getInstance();
        $sql = 'SELECT `idParks` FROM `images` WHERE `id` = :id;';
        $sth = $pdo->prepare($sql);
        $sth->bindValue(':id', $id, PDO::PARAM_INT);
        $succes = $sth->execute();
        if ($succes) {
            if (empty($sth->fetch())) {
                return false;
            } else {
                return true;
            }
        }
    }

    // -------------------------------------------------------------------------------------------------
    // ------------------------------------------CRUD-----------------------------------------------
    // -------------------------------------------------------------------------------------------------
    // ------------------------------------------------
    // -------------------CREATE
    // ------------------------------------------------
    public function create(): bool
    {
        $sql = 'INSERT INTO `images` (`idParks`)
        VALUES (:idParks);';
        $sth = $this->pdo->prepare($sql);
        $sth->bindValue(':idParks', $this->getIdParks(), PDO::PARAM_INT);
        if ($sth->execute()) {
            return ($sth->rowCount() > 0) ? true : false;
        }
    }

    // ------------------------------------------------
    // -------------------READ ALL
    // ------------------------------------------------
    public static function readAll(string $folder): array
    {
        $imgFile = [];
        foreach (new DirectoryIterator($folder) as $fileInfo) {
            if ($fileInfo->isDot()) continue;
            array_push($imgFile, $fileInfo->getFileInfo());
        }
        return $imgFile;
    }


    // ------------------------------------------------
    // -------------------DELETE
    // ------------------------------------------------
    public static function delete($folder)
    {
        foreach (glob($folder . "/*") as $file) {
            if (is_dir($file)) {
                // On utilise la methode delete ( qui est récursive )
                self::delete($file);
                // Une fois le dossier vide, on le supprime
                rmdir($file);
            } else {
                // Sinon c'est un fichier on le supprime
                unlink($file);
            }
        }
        return rmdir($folder);
    }

    // -------------------------------------------------------------------------------------------------
    // ---------------------------------------
    // -------------------Getter / Setter
    // ---------------------------------------

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
    // --------IdParks
    // ----------------------------
    /** get
     * @return int
     */
    public function getIdParks(): int
    {
        return $this->_idParks;
    }

    /** set
     * @param int $idParks
     * 
     * @return void
     */
    public function setIdParks(int $idParks): void
    {
        $this->_idParks = $idParks;
    }
}
