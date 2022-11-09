<?php

    require "dbBroker.php";
    require "modeli/trening.php";

    session_start();

    if(!isset($_SESSION['user_id'])){
        header('Location: index.php');
        exit();
    }
    
    $podaci = Trening::getAll($conn);

    if(!$podaci){
        echo "Greska.";
        die();
    }
    if($podaci->num_rows == 0){
        echo "Nema treninga danas.";
        die();
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="img/favicon.png">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/pocetna.css">
    <title>Kočović teretana</title>
</head>

<body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<div class="jumbotron" style="color:black;"><h1>FITNESS & GYM KOČOVIĆ</h1></div>

<div class="row" style = "background-color:blur;">
        <div class="col-md-4">
            <button id="btn" class="btn btn-block" style="font-size:26px;"> Raspored treninga</button>
        </div>
        <div class="col-md-4">
            <button id="btn-dodaj" type="button" class="btn btn-block" style="font-size:26px;" data-toggle="modal" data-target="#myModal"> Zakaži trening</button>

        </div>
        <div class="col-md-4">
            <button id="btn-pretraga" class="btn btn-block" style="font-size:26px;"> Pretraga treninga</button>
            <input type="text" id="myInput" onkeyup="pretrazi()" placeholder="Pretraži treninge po nazivu" style="font-size: 25px; width: 550px; height: 40px;" hidden>
        </div>
    </div>

    <div id="pregled" class="panel panel-success" style="margin-top: 3%;">

        <div class="panel-body">
            <table id="myTable" class="table table-hover table-condensed" style="color: black; background-color:rgb(224, 237, 255);">
                <thead class="thead">
                    <tr>
                        <th scope="col" style = "text-align:center;">ID</th>
                        <th scope="col" style="text-align: center;">TRENING</th>
                        <th scope="col" style="text-align: center;">KATEGORIJA</th>
                        <th scope="col" style="text-align: center;">SALA</th>
                        <th scope="col" style="text-align: center;">DATUM</th>
                        <th scope="col" style="text-align: center;">VREME</th>
                    </tr>
                </thead>
                <tbody style="font-size:18px; height: 70px;">
                     <?php
                         while ($red = $podaci->fetch_array()){
                     ?>
                         <tr id="tr-<?php echo $red["id"] ?>">
                            <td><?php echo $red["id"] ?></td>
                            <td><?php echo $red["naziv"] ?></td>
                            <td><?php echo $red["kategorija_id"] ?></td>
                            <td><?php echo $red["sala"] ?></td>
                            <td><?php echo $red["datum"] ?></td>
                            <td><?php echo $red["vreme"] ?></td>
                            <td>
                                <label class="custom-radio-btn">
                                    <input type="radio" name="checked-donut" value=<?php echo $red["id"] ?>>
                                    <span class="checkmark"></span>
                                </label>
                            </td>
                            
                         </tr>
                <?php
                }
            
                ?>
                </tbody>

            </table>
            <div class="row" style="position:relative; text-align: center;">
                    <button id="btn-obrisi" formmethod="post" class="btn" style="font-size: 25px; margin: 5px 10px 15px;">Obriši</button>
                    <button id="btn-sortiraj" class="btn " onclick="sortTable()" style="font-size: 25px;margin:5px 10px 15px;">Sortiraj</button>
            </div>
        </div>
    </div>

    <a href="odjava.php" class="label" style="background-image: radial-gradient(100% 100% at 100% 0, #9fccdb 0, #4264c4 100%);font-size:21px; position: fixed; top:0; right:0; float:right; margin:20px; height:35px;">Odjavi se</a>

    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog">
            
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="container prijava-form">
                        <form action="#" method="post" id="dodajForm">
                            <h3 style="color: black; text-align: center">Zakaži trening</h3>
                            <div class="row">
                                <div class="col-md-11 ">
                                    <div class="form-group">
                                        <label for="">Trening</label>
                                        <input type="text" style="border: 1px solid black" name="naziv" class="form-control" />
                                    </div>
                                    <div class="form-group">
                                        <label for="">Kategorija</label>
                                        <input type="text" style="border: 1px solid black" name="kategorija_id" class="form-control" />
                                    </div>
                                    <div class="form-group">
                                        <label for="sala">Sala</label>
                                        <input type="sala" style="border: 1px solid black" name="sala" class="form-control" />
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">Datum</label>
                                            <input type="date" style="border: 1px solid black" name="datum" class="form-control" />
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">Vreme</label>
                                            <input type="text" style="border: 1px solid black" name="vreme" class="form-control" />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <button id="btnDodaj" type="submit" class="btn btn-block" style="color: white; border: 1px solid white">Zakaži</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="js/home.js"></script>

    <script>
        function sortTable() {
            var table, rows, switching, i, x, y, shouldSwitch;
            table = document.getElementById("myTable");
            switching = true;
            while (switching) {
                switching = false;
                rows = table.rows;
                for (i = 1; i < (rows.length - 1); i++) {
                    shouldSwitch = false;
                    x = rows[i].getElementsByTagName("TD")[1];
                    y = rows[i + 1].getElementsByTagName("TD")[1];
                    if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                        shouldSwitch = true;
                        break;
                    }
                }
                if (shouldSwitch) {
                    rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
                    switching = true;
                }
            }
        }

        
        function pretrazi() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("myInput");
            filter = input.value.toUpperCase();
            table = document.getElementById("myTable");
            tr = table.getElementsByTagName("tr");
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[1];
                if (td) {
                    txtValue = td.textContent || td.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        }
    </script>
</body>
</html>