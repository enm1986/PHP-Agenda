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
        session_start(['cookie_lifetime' => 600,]);
        
        //$_SESSION = array();
        //session_destroy();

        // Inicializamos la agenda
        if (!isset($_SESSION["agenda"])) {
            $_SESSION["agenda"] = array();
        }

        // comprobamos los datos recibidos
        if (isset($_POST["submit"])) {
            $nuevo_nom = filter_input(INPUT_POST, "nom");
            $nuevo_tel = filter_input(INPUT_POST, "tel");
            $nuevo_nom = $_POST["nom"];
            $nuevo_tel = $_POST["tel"];
            // si el nombre está vacío muestra una alerta
            if (empty($nuevo_nom)) {
                echo"<script>alert('Debe introducir un nombre')</script>";

                // si el teléfono está vacío, borra la entrada en la agenda
            } else if (empty($nuevo_tel)) {
                unset($_SESSION["agenda"][$nuevo_nom]);

                // añade a la agenda o actualiza
            } else {
                $_SESSION["agenda"][$nuevo_nom] = $nuevo_tel;
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

        <?php
        //Mostrar agenda
        echo '<br>Lista de contactos:<br>';

        // agenda vacía
        if (count($_SESSION["agenda"]) == 0) {
            echo '<p>No hay contactos en la agenda</p>';

            // agenda con datos
        } else {
            echo '<ul>';
            // recorremos la agenda e imprimimos las entradas
            foreach ($_SESSION["agenda"] as $nom => $tel) {
                echo '<li>' . $nom . ': ' . $tel . '</li>';
            }
            echo '</ul>';
        }
        
        //$_SESSION = array();
        //session_destroy();
        ?>
    </body>
</html>
