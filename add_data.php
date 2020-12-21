<?php
    // Connect to MySQL
    include("connect.php");

    // Prepare the SQL statement
      //*date_default_timezone_set('Europe/Athens');
     $dateS = date('Y-m-d h:i:s', time());
    //echo $dateS;
    $SQL = "insert into temperatura (fecha_hora,distorsion,voltaje,temperatura) values ('$dateS','".$_GET["temp"]."','".$_GET["hum"]."','".$_GET["pr"]."')";     

    // Execute SQL statement
    mysql_query($SQL);

    // Go to the review_data.php (optional)
    header("Location: index.php");
?>