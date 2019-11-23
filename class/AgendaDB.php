<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Agenda
 *
 * @author eugenio
 */
class Agenda {

    private $conn;

    private const TABLE_NAME = "contactos";

    public function __construct($db) {
        $this->conn = $db;
    }

    /**
     * Añadir contacto
     * @param String $nombre
     * @param String $telefono
     * @return boolean
     */
    public function insert($nombre, $telefono) {
        $query = "INSERT INTO " . self::TABLE_NAME . " (nombre, telefono) VALUES (:nom, :tel)";

        $stmt = $this->conn->prepare($query);

        // bind values 
        $stmt->bindParam(":nom", htmlspecialchars(strip_tags($nombre)));
        $stmt->bindParam(":tel", htmlspecialchars(strip_tags($telefono)));

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Eliminar contacto
     * @param String $nombre
     * @return boolean
     */
    public function delete($nombre) {
        $query = "DELETE FROM " . self::TABLE_NAME .
                " WHERE nombre = :nom";

        $stmt = $this->conn->prepare($query);

        // bind values 
        $stmt->bindParam(":nom", htmlspecialchars(strip_tags($nombre)));

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Actualizar contacto
     * @param String $nombre
     * @param String $telefono
     * @return boolean
     */
    public function update($nombre, $telefono) {
        $query = "UPDATE " . self::TABLE_NAME . " SET
                telefono = :tel
            WHERE nombre = :nom";

        $stmt = $this->conn->prepare($query);

        // bind values 
        $stmt->bindParam(":nom", htmlspecialchars(strip_tags($nombre)));
        $stmt->bindParam(":tel", htmlspecialchars(strip_tags($telefono)));

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function contactExist($nombre) {
        $query = "SELECT nombre FROM " . self::TABLE_NAME .
                " WHERE nombre=:nom LIMIT 1 OFFSET 0";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":nom", htmlspecialchars(strip_tags($nombre)));
        $stmt->execute();
        $num = $stmt->rowCount();

        if ($num == 1) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * 
     * @return 
     */
    public function readAll() {
        $query = "SELECT * FROM " . self::TABLE_NAME;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

}
