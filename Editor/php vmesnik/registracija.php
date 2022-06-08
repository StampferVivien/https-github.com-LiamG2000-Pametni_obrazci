<?php 
ini_set( 'display_errors', 1 );
error_reporting( E_ALL );
session_start();
include ("config.php");
include ("functions.php");

//Nastavljanej vrednosti
$Erruser_name = $Erremail = $Erremailzaseden = $Errpassword = $ErrRandom = "";
$user_name = $email = $password = "";

//Pritisk gumba "Potrdi"
if($_SERVER['REQUEST_METHOD'] == "POST"){
  //Preverjanje uporabniskega imena
  if(empty($_POST["username"])){
    $Erruser_name = "Uporabniško ime je obvezno";
  }else{
    $user_name = $_POST["username"];
  }
  //preverjanje emaila
  if(empty($_POST["email"])){
    $Erremail = "Email je obvezen";
  }else{
    if(preveriMail($con, $_POST["email"]) == true){
      $email = $_POST["email"];
    }else{
      $Erremail = "Email je že v uporabi";
    }
  }
  //preverjanje gesla
  if(empty($_POST["password"])){
    $Errpassword  = "Geslo je obvezno";
  }else{
    $password = password_hash($_POST["password"], PASSWORD_BCRYPT, array('cost' => 9));;
  }
  //Ce je vse vneseno se zacne vnos v bazo
  if(!empty($user_name) && !empty($password) && !empty($email)){
    $verificationCode = rand(10000, 99999);
    $user_id = novUserId($con);
    $stmt = $con -> prepare("insert into uporabnik (uporabnisko_ime, email, geslo, user_id, verificationCode) values (?,?,?,?,?)");
    $stmt -> bind_param("sssii", $user_name, $email, $password, $user_id, $verificationCode);
    if($stmt -> execute() == true){
      header("Location: login.php");
      if(posliMail($con, $verificationCode) == false){
        $ErrRandom = "Napaka pri pošiljanju mail-a prosim kontaktirajte administratorja";
      }
      die;
    }else{
      $ErrRandom = "Prislo je do napake, prosim poskusite ponovno!";
    }
  }
}
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Registracija</title>
    <link rel="shortcut icon" type="image/jpg" href="https://github.com/LiamG2000/Pametni_obrazci/blob/master/slike/logo3.png"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <style>
      .error {color: #FF0000;}
    </style>
  </head>
  <body>
    <?php include ("header.php"); ?>
    <div class="modal-body">
      <form name="myform" class="form-detail" method="POST" id="dodajUporabnikaForm" enctype="multipart/form-data">
        <h2>Registracija</h2>
        <div class="form-group">
          <label for="username">Uporabniško Ime:</label>
          <span class="error">* <?php echo $Erruser_name;?></span>
          <input type="text" name="username" id="name" class="form-control" placeholder="Uporabniško ime">
        </div>
        <div class="form-group">
          <label for="email">Email:</label>
          <span class="error">* <?php echo $Erremail;?></span>
          <input type="text" name="email" id="email" class="form-control" placeholder="Vaš eMail" pattern="[^@]+@[^@]+.[a-zA-Z]{2,6}">
        </div>
        <div class="form-group">
          <label for="password">Geslo:</label>
          <span class="error">* <?php echo $Errpassword;?></span>
          <input type="password" name="password" id="geslo" class="form-control" placeholder="Geslo">
        </div>
        <div class="form-group">
          <button type="submit" name="register" class="btn btn-primary" value="Registriraj Me">Potrdi</button>
          <span class="error"><?php echo $ErrRandom;?></span>
        </div>
      </form>
      <a href="login.php">Prijava</a><br><br>
    </div>
    <?php include ("footer.php")?>
  </body>
</html>