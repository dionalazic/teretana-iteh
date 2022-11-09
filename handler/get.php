<?php
    require "../dbBroker.php";
    require "../modeli/trening.php";

    if(isset($_POST['id'])){
        $obj = Trening::getById($_POST['id'], $conn);
        echo json_encode($obj);
    }



?>