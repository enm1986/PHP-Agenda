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
        require_once 'class/Database.php';
        require_once 'class/AgendaDB.php';

        // instanciar database y agenda
        $database = new Database();
        $db = $database->getConnection();

        $agenda = new Agenda($db);


        // comprobamos los datos recibidos
        if (isset($_POST["submit"])) {
            $nuevo_nom = filter_input(INPUT_POST, "nom");
            $nuevo_tel = filter_input(INPUT_POST, "tel");
            // si el nombre está vacío muestra una alerta
            if (empty($nuevo_nom)) {
                echo"<script>alert('Debe introducir un nombre')</script>";

                // si el teléfono está vacío, borra la entrada en la agenda
            } elseif (empty($nuevo_tel)) {
                $agenda->delete($nuevo_nom);

                // si el nombre existe actualiza
            } elseif ($agenda->contactExist($nuevo_nom)) {
                $agenda->update($nuevo_nom, $nuevo_tel);
                // en cualquier otro caso inserta nuevo contacto
            } else {
                $agenda->insert($nuevo_nom, $nuevo_tel);
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
        $stmt = $agenda->readAll();
        $num = $stmt->rowCount();

        if ($num == 0) {
            echo "No hay contactos en la agenda";
        } else {
            echo "<table>";
            echo "<tr>";
            echo "<th>Nombre</th>";
            echo "<th>Telefono</th>";
            echo "</tr>";
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                extract($row);
                echo "<tr>";
                echo "<td>{$nombre}</td>";
                echo "<td>{$telefono}</td>";
                echo "</tr>";
            }
            echo "</table>";
        }
        ?>
    </body>
</html>
