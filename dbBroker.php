<?php
    $host = "localhost";
    $db = "kocovic";
    $user = "root";
    $pass = "";
    $conn = new mysqli($host,$user,$pass,$db);

    if ($conn->connect_errno){
        exit("Konekcija neuspesna: ".$conn->connect_errno);
    }

?>