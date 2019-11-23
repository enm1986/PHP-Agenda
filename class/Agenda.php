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

    private $contactos;

    public function __construct() {
        $this->contactos = array();
    }

    /**
     * Añade un contacto a la agenda
     * @param String $nombre Nombre del contacto
     * @param String $telefono Teléfono del contacto
     */
    public function add($nombre, $telefono) {
        $this->contactos[$nombre] = $telefono;
    }

    /**
     * Elimina un contacto de la agenda
     * @param String $nombre Nombre del contacto a eliminar
     */
    public function delete($nombre) {
        unset($this->contactos[$nombre]);
    }

    /**
     * Devuelve la cantidad de contactos de la agenda
     * @return int Cantidad de contactos
     */
    public function getNumContactos() {
        return count($this->contactos);
    }

    /**
     * Muestra los contactos de la agenda
     */
    public function listar() {
        if (count($this->contactos) == 0) {
            echo '<p>No hay contactos en la agenda</p>';
        } else {
            echo '<ul>';
            // recorremos la agenda e imprimimos las entradas
            foreach ($this->contactos as $nombre => $telefono) {
                echo '<li>' . $nombre . ': ' . $telefono . '</li>';
            }
            echo '</ul>';
        }
    }

}
