<?php

require_once __DIR__ . '/../helpers/database/Connexion.php';

class Opinion
{
    // --------------------------------------------------------------------------------------------------
    // ----------------------------------ATTRIBUTS------------------------------------------------
    // --------------------------------------------------------------------------------------------------
    private int $_id;
    private string $_title;
    private int $_rate;
    private string $_opinion;
    private string $_created_at;
    private string $_validated_at;
    private int $_idParks;
    private int $_idUsers;
    private $pdo;

    // --------------------------------------------------------------------------------------------------
    // ----------------------------------CONSTRUCT------------------------------------------------
    // --------------------------------------------------------------------------------------------------
    public function __construct(string $title, string $rate, string $opinion, int $idParks, int $idUsers)
    {
        $this->_title = $title;
        $this->_rate = $rate;
        $this->_opinion = $opinion;
        $this->_idParks = $idParks;
        $this->_idUsers = $idUsers;
        $this->pdo = Connexion::getInstance();
    }


    // -------------------------------------------------------------------------------------------------
    // --------------------------------------OTHER METHOD-------------------------------------
    // -------------------------------------------------------------------------------------------------
    // ---------------------------------------
    // -------------------OPINION EXIST
    // ---------------------------------------
    // public static opinionExist(){}


    // -------------------------------------------------------------------------------------------------
    // ------------------------------------------CRUD-----------------------------------------------
    // -------------------------------------------------------------------------------------------------

    // ---------------------------------------
    // -------------------CREATE
    // ---------------------------------------
    public function create()
    {
    }

    // ------------------------------------------
    // -------------------READ All Validate
    // ------------------------------------------
    public static function readAllValidate()
    {
        $pdo = Connexion::getInstance();
    }

    // ----------------------------------------
    // -------------------READ Validate
    // ----------------------------------------
    public static function readValidate()
    {
        $pdo = Connexion::getInstance();
    }

    // ---------------------------------------------
    // -------------------READ ALL no Validate
    // ---------------------------------------------
    public static function readAll()
    {
        $pdo = Connexion::getInstance();
    }

    // ---------------------------------------------
    // -------------------READ no Validate
    // ---------------------------------------------
    public static function read()
    {
        $pdo = Connexion::getInstance();
    }

    // ---------------------------------------------
    // -------------------UPDATE
    // ---------------------------------------------
    public function update()
    {
    }

    // ---------------------------------------------
    // -------------------DELETE
    // ---------------------------------------------
    public static function delete()
    {
        $pdo = Connexion::getInstance();
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
    public function setId(int $id): void
    {
        $this->_id = $id;
    }

    // --------Title
    /** get
     * @return string
     */
    public function getTitle(): string
    {
        return $this->_title;
    }

    /** set
     * @param mixed $title
     * 
     * @return void
     */
    public function setTitle(string $title): void
    {
        $this->_title = $title;
    }

    // --------Rate
    /** get
     * @return int
     */
    public function getRate(): int
    {
        return $this->_rate;
    }

    /** set
     * @param mixed $rate
     * @return void
     */
    public function setRate(int $rate): void
    {
        $this->_rate = $rate;
    }

    // --------Opinion
    /** get
     * @return string
     */
    public function getOpinion(): string
    {
        return $this->_opinion;
    }

    /** set
     * @param mixed $opinion
     * 
     * @return void
     */
    public function setOpinion(string $opinion): void
    {
        $this->_opinion = $opinion;
    }


    // --------created at
    /** get
     * @return string
     */
    public function getCreated_at(): string
    {
        return $this->_created_at;
    }

    /** set
     * @param mixed $created_at
     * 
     * @return void
     */
    public function setCreated_at(string $created_at): void
    {
        $this->created_at = $created_at;
    }


    // --------validated_at
    /** get
     * @return bool
     */
    public function getValidated_at(): bool
    {
        return $this->_validated_at;
    }

    /** set
     * @param mixed $validate
     * 
     * @return void
     */
    public function setValidated_at(bool $validated_at): void
    {
        $this->validated_at = $validated_at;
    }


    // --------idParks
    /**
     * @return int
     */
    public function getIdParks(): int
    {
        return $this->_idParks;
    }

    /**
     * @param int $idParks
     * 
     * @return void
     */
    public function setIdParks(int $idParks): void
    {
        $this->_idParks = $idParks;
    }


    // --------idUsers
    /** get
     * @return int
     */
    public function getIdUsers(): int
    {
        return $this->_idUsers;
    }

    /** set
     * @param mixed $idUsers
     * 
     * @return void
     */
    public function setIdUsers(int $idUsers): void
    {
        $this->_idUsers = $idUsers;
    }
}
