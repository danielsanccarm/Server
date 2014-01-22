<!DOCTYPE html>
<html>
    <head>
        <title></title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>

    </head>
    <body>
        <?php
        include_once 'db_functions.php';
        $db = new DB_Functions();
        $autobus_pos = $db->MostrarBus();
        if ($autobus_pos != false)
            $no_of_users = mysql_num_rows($autobus_pos);
        else
            $no_of_users = 0;
        ?>
        <div class="container">
            <h1>Localizacion: <?php echo $no_of_users; ?></h1>
            <hr/>
            <ul class="devices">
                <?php
                if ($no_of_users > 0) {
                    ?>
                    <?php
                    while ($row = mysql_fetch_array($autobus_pos)) {
                        ?>
                        <li>
                            <form id="<?php echo $row["id_Unidad"] ?>" name="">
                                <label>Latitud: </label> <span><?php echo $row["Latitud"] ?></span>
                                <div class="clear"></div>
                                <label>Longitud:</label> <span><?php echo $row["Longitud"] ?></span>
                                <div class="clear"></div>

                            </form>
                        </li>
                    <?php }
                } else { ?>
                    <li>
                        No hay Localizaciones!
                    </li>
                <?php } ?>
            </ul>

        </div>

    </body>
</html>
