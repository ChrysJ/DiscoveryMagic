<?php

require_once __DIR__ . '/../helpers/database/Connexion.php';

class Users
{
    // --------------------------------------------------------------------------------------------------
    // ----------------------------------ATTRIBUTS------------------------------------------------
    // --------------------------------------------------------------------------------------------------
    private int $_id;
    private string $_username;
    private string $_mail;
    private string $_password;
    private int $_ref_avatar;
    private string $_role;
    private string $_created_at;
    private PDO $pdo;

    // --------------------------------------------------------------------------------------------------
    // ----------------------------------CONSTRUCT------------------------------------------------
    // --------------------------------------------------------------------------------------------------
    public function __construct(string $username, string $mail, string $password, string $ref_avatar, string $role)
    {
        $this->_username = $username;
        $this->_mail = $mail;
        $this->_password = $password;
        $this->_ref_avatar = $ref_avatar;
        $this->_role = $role;
        $this->pdo = Connexion::getInstance();
    }

    // -------------------------------------------------------------------------------------------------
    // --------------------------------------OTHER METHOD-------------------------------------
    // -------------------------------------------------------------------------------------------------
    // ----------------------------------------
    // -------------------ELEMENT EXIST
    // ----------------------------------------
    public static function elementExist(int $id = null, string $mail = null): bool
    {
        $pdo = Connexion::getInstance();
        if ($id != null) {
            $sql = 'SELECT `id` FROM `users` WHERE `id` = :id ;';
        }
        if ($mail != null) {
            $sql = 'SELECT `mail` FROM `users` WHERE `mail` = :mail ;';
        }
        $sth = $pdo->prepare($sql);
        if ($id != null) {
            $sth->bindValue(':id', $id, PDO::PARAM_INT);
        }
        if ($mail != null) {
            $sth->bindValue(':mail', $mail);
        }
        $isExist = $sth->execute();
        if ($isExist) {
            return (empty($sth->fetch())) ? false : true;
        }
    }

    // ----------------------------------------
    // -------------------GET BY MAIL
    // ----------------------------------------
    public static function getByMail(string $mail): object|bool
    {
        $pdo = Connexion::getInstance();
        $sql = 'SELECT * FROM `users` WHERE `mail` = :mail;';
        $sth = $pdo->prepare($sql);
        $sth->bindValue(':mail', $mail);
        if ($sth->execute()) {
            $result = $sth->fetch();
            if ($result) {
                return $result;
            }
        }
        return false;
    }



    // -------------------------------------------------------------------------------------------------
    // ------------------------------------------CRUD-----------------------------------------------
    // -------------------------------------------------------------------------------------------------
    // ---------------------------------------
    // -------------------CREATE
    // ---------------------------------------
    public function create(): bool
    {
        $sql = 'INSERT INTO `users` (`username`,`mail`,`password`,`ref_avatar`,`role`)
        VALUES (:username, :mail, :password, :ref_avatar, :role);';
        $sth = $this->pdo->prepare($sql);
        $sth->bindValue(':username', $this->getUsername());
        $sth->bindValue(':mail', $this->getMail());
        $sth->bindValue(':password', $this->getPassword());
        $sth->bindValue(':ref_avatar', $this->getRef_avatar(), PDO::PARAM_INT);
        $sth->bindValue(':role', $this->getRole(), PDO::PARAM_INT);
        if ($sth->execute()) {
            return ($sth->rowCount() == 1) ? true : false;
        }
    }

    // ------------------------------------------
    // -------------------READ ALL
    // ------------------------------------------
    public static function readAll()
    {
        $pdo = Connexion::getInstance();
    }

    // ------------------------------------------
    // -------------------READ A MODIFIER
    // ------------------------------------------

    public static function read()
    {
        $pdo = Connexion::getInstance();
        $sql = 'SELECT `id` FROM `users`WHERE `username` = "sleazy" ;';
        $sth = $pdo->query($sql);
        return $sth->fetch();
    }

    // ------------------------------------------
    // -------------------UPDATE
    // ------------------------------------------
    public function update()
    {
    }

    // ------------------------------------------
    // -------------------DELETE
    // ------------------------------------------
    public static function delete()
    {
        try {
            $pdo = Connexion::getInstance();
        } catch (PDOException $ex) {
            var_dump($ex->getMessage());
        }
    }

    // -------------------------------------------------------------------------------------------------

    // ---------------------------------------
    // -------------------Getter / Setter
    // ---------------------------------------
    // --------Id
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
    public function setid(int $id): void
    {
        $this->_id = $id;
    }

    // --------username
    /** get
     * @return string
     */
    public function getUsername(): string
    {
        return $this->_username;
    }

    /** set
     * @param string $username
     * 
     * @return void
     */
    public function setUsername(string $username): void
    {
        $this->_username = $username;
    }

    // --------Mail
    /** get
     * @return string
     */
    public function getMail(): string
    {
        return $this->_mail;
    }

    /** set
     * @param string $mail
     * 
     * @return void
     */
    public function setMail(string $mail): void
    {
        $this->_mail = $mail;
    }

    // --------Password
    /** get
     * @return string
     */
    public function getPassword(): string
    {
        return $this->_password;
    }

    /** set
     * @param string $password
     * 
     * @return [type]
     */
    public function setPassword(string $password)
    {
        $this->_password = $password;
    }

    // --------ref_avatar
    /** get
     * @return int
     */
    public function getRef_avatar(): int
    {
        return $this->_ref_avatar;
    }

    /** set
     * @param int $ref_avatar
     * 
     * @return void
     */
    public function setRef_avatar(int $ref_avatar): void
    {
        $this->_ref_avatar = $ref_avatar;
    }

    // --------role
    /** get
     * @return int
     */
    public function getRole(): int
    {
        return $this->_role;
    }

    /** set
     * @param int $role
     * 
     * @return void
     */
    public function setRole(int $role): void
    {
        $this->_role = $role;
    }


    // --------created_at
    /** get
     * @return string
     */
    public function getCreated_at(): string
    {
        return $this->_created_at;
    }

    /** set
     * @param mixed $creationDate
     * 
     * @return void
     */
    public function setCreated_at(string $created_at): void
    {
        $this->created_at = $created_at;
    }
}
