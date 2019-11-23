<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Database
 *
 * @author eugenio
 */
class Database {

    // specify your own database credentials
    private const HOST = "localhost";
    private const DRIVER = "pgsql";
    private const DB_NAME = "php_agenda";
    private const USERNAME = "eugenio";
    private const PASSWORD = "eugenio";
    public $conn;

    // get the database connection
    public function getConnection() {

        $this->conn = null;

        try {
            $this->conn = new PDO(self::DRIVER . ":host=" . self::HOST . ";dbname=" . self::DB_NAME, self::USERNAME, self::PASSWORD);
        } catch (PDOException $exception) {
            echo "Connection error: " . $exception->getMessage();
        }

        return $this->conn;
    }
}
