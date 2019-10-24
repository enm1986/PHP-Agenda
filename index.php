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
        // Inicializar array "agenda" (será un array asociativo [indice => valor])
        if (isset($_GET["agenda"])) {
            $agenda = $_GET["agenda"];
        } else {
            $agenda = [];
            //$agenda=["aaa"=>"1111", "bbb"=>"2222", "ccc"=>"3333"];
        }
        if (isset($_GET["submit"])) {
            if (empty($_GET["nom"])) {
                echo"<script>alert('Debe introducir un nombre')</script>";
            } elseif (empty($_GET["tel"])) {
                unset($agenda[$_GET["nom"]]);
            } else { // añade a la agenda o actualiza
                $nuevo_nom = $_GET["nom"];
                $nuevo_tel = $_GET["tel"];
                $agenda[$nuevo_nom] = $nuevo_tel;
            }
        }
        ?>

        <h2>Agenda</h2>
        <form method="get" action="">

            <?php
            // Añadir agenda al html de forma oculta
            foreach ($agenda as $nom => $tel) {
                echo '<input type=hidden name="agenda[' . $nom . ']" value=' . $tel . '>';
            }
            ?>

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
        if (count($agenda) == 0) {
            echo '<p>No hay contactos en la agenda</p>';
        } else {
            echo '<ul>';
            foreach ($agenda as $nom => $tel) {
                echo '<li>' . $nom . ': ' . $tel . '</li>';
            }
            echo '</ul>';
        }
        ?>
    </body>
</html>
