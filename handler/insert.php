<?php
    require "../dbBroker.php";
    require "../modeli/trening.php";

    if(isset($_POST['naziv']) && isset($_POST['kategorija_id']) && isset($_POST['sala']) && isset($_POST['datum']) && isset($_POST['vreme'])){
        
        $status = Trening::insert($_POST['naziv'],$_POST['kategorija_id'],$_POST['sala'],$_POST['datum'],$_POST['vreme'],$conn);

        if($status){
            echo 'Success';
        }else{
            echo $status;
            echo 'Failed';
        }
    }
?>