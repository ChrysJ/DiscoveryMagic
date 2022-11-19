<?php

require_once __DIR__ . '/../helpers/database/Connexion.php';


class Regions
{
    // --------------------------------------------------------------------------------------------------
    // ----------------------------------ATTRIBUTS------------------------------------------------
    // --------------------------------------------------------------------------------------------------
    private int $_id;
    private string $_region;


    // ------------------------------------------------
    // -------------------ID exist
    // ------------------------------------------------
    public static function idExist($id): bool
    {
        $pdo = Connexion::getInstance();
        $sql = 'SELECT `id` FROM `regions` WHERE `id` = :id;';
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

    // ------------------------------------------------
    // -------------------READ ALL
    // ------------------------------------------------
    public static function readAll(): array
    {
        $pdo = Connexion::getInstance();
        $sql = 'SELECT `id`, `region` FROM `regions`;';
        $sth = $pdo->query($sql);
        return $sth->fetchAll();
    }
    
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
    // --------Regions
    // ----------------------------
    /** get
     * @return string
     */
    public function getRegion(): string
    {
        return $this->_region;
    }

    /** set
     * @param mixed $region
     * 
     * @return void
     */
    public function setRegion(string $region): void
    {
        $this->_regions = $region;
    }
}
