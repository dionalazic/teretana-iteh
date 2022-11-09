<?php

require "../dbBroker.php";
require "../modeli/trening.php";

if(isset($_POST['id'])){
    $status = Trening::deleteById($_POST['id'],$conn);
    if ($status){
        echo 'Success';
    }else{
        echo 'Failed';
    }
}

?>