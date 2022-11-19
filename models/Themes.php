<?php

require_once __DIR__ . '/../helpers/database/Connexion.php';


class Themes
{
    // --------------------------------------------------------------------------------------------------
    // ----------------------------------ATTRIBUTS------------------------------------------------
    // --------------------------------------------------------------------------------------------------
    private int $_id;
    private string $_theme;

    // ------------------------------------------------
    // -------------------ID exist
    // ------------------------------------------------
    public static function idExist($id): bool
    {
        $pdo = Connexion::getInstance();
        $sql = 'SELECT `id` FROM `themes` WHERE `id` = :id;';
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
        $sql = 'SELECT `id`, `theme` FROM `themes`;';
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
    // --------Theme
    // ----------------------------
    /** get
     * @return string
     */
    public function getTheme(): string
    {
        return $this->_theme;
    }

    /** set
     * @param mixed $theme
     * 
     * @return void
     */
    public function setTheme(string $theme): void
    {
        $this->_theme = $theme;
    }
}
