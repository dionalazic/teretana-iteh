<?php
  require "dbBroker.php";
  require "modeli/user.php";

  session_start();
  if(isset($_POST['username']) && isset($_POST['password'])){
    $uname = $_POST['username'];
    $upass = $_POST['password'];

    $korisnik = new User(1, $uname, $upass);

    $odg = User::logInUser($korisnik,$conn);

    if($odg->num_rows == 1){
      echo `
      <script>
      console.log("Uspešno ste se prijavili!");
      </script>
      `;
      $_SESSION['user_id'] = $korisnik->id;
      header('Location: home.php');
      exit();
    } else {
      echo `
      <script>
      console.log( "Neuspešna prijava!");
      </script>
      `;
     }
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="css/login.css">
    <title>Prijava Kocovic</title>

</head>
<body>
<div id="bg"></div>

<div class = "login-form">
  <div class = "main-div">
      <form method="POST" action="#">
            <label class="logo1">FITNESS & GYM</label>
            <br></br>
            <label class="logo2">KOČOVIĆ</label>
            <br></br><br></br>
          
            <div class="username">
              <input type="username" class ="form-control" name="username" placeholder="Korisničko ime" required/>
            </div>
            <br></br>
            <div class="password">
              <input type="password" class ="form-control" name="password" placeholder="Lozinka" required/>                         
            </div>
            <br></br>
            <div class="form-field">
              <button class="btn" type="submit" name="submit">Prijavi se</button>
            </div>
      </form>
  </div>
</div>

</body>
</html>