<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        require_once 'class/Agenda.php';
        session_start(['cookie_lifetime' => 600,]);


        // Inicializamos la agenda
        if (!isset($_SESSION["agenda"])) {
            $_SESSION["agenda"] = new Agenda();
        }

        // comprobamos los datos recibidos
        if (isset($_POST["submit"])) {
            $nuevo_nom = filter_input(INPUT_POST, "nom");
            $nuevo_tel = filter_input(INPUT_POST, "tel");
            // si el nombre está vacío muestra una alerta
            if (empty($nuevo_nom)) {
                echo"<script>alert('Debe introducir un nombre')</script>";

                // si el teléfono está vacío, borra la entrada en la agenda
            } elseif (empty($nuevo_tel)) {
                $_SESSION["agenda"]->delete($nuevo_nom);

                // añade a la agenda o actualiza
            } else {
                $_SESSION["agenda"]->add($nuevo_nom, $nuevo_tel);
            }
        }
        ?>

        <h2>Agenda</h2>
        <form method="post" action="">
            <p>Nombre del contacto</p>
            <input type="text" name="nom">
            <p>Número de teléfono</p>
            <input type="tel" name="tel">
            <br><br>
            <input type="submit" name="submit" value="Envia">
            <br>
        </form>

        <br>
        <p>Lista de contactos:</p>
        <br>


        <?php
        //Mostrar agenda
        if (isset($_SESSION["agenda"])) {
            // recorremos la agenda e imprimimos las entradas
            $_SESSION["agenda"]->listar();
        }
        ?>
    </body>
</html>
