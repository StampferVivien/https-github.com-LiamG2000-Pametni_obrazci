<?php 
ini_set( 'display_errors', 1 );
error_reporting( E_ALL );
session_start();
include ("config.php");
include ("functions.php");


?>

<!DOCTYPE html>
<html>
  <head>
    <title>Registracija</title>
    <link rel="shortcut icon" type="image/jpg" href="https://raw.githubusercontent.com/LiamG2000/Pametni_obrazci/master/slike/logo3.png"/>
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
    </body>
</html>

    <?php




  
    
    
    
    
   


?>
    <?php include ("footer.php")?>
