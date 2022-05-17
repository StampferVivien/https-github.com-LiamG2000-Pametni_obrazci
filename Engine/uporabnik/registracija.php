<?php 
session_start();

	include ("config.php");
	include ("functions.php");


	if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		//something was posted
    $user_name = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $slika = $_FILES['slika'];
    
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT, array('cost' => 9));
    

    if(preveriMail($con, $email) == true){

      echo '<div class="alert alert-primary" role="alert">
      Email je ze zavzet
    </div>';

    
		if(!empty($user_name) && !empty($hashedPassword) && !is_numeric($user_name) && !empty($email))
		{


			$user_id = random_num(20);
      $query = "insert into uporabnik (uporabnisko_ime, email, geslo,user_id) values ('$user_name','$email','$hashedPassword', '$user_id')";
      
    
			mysqli_query($con, $query);

			header("Location: login.php");
			die;
		}else
		{
			echo "Please enter some valid information!";
		}
  }
}
?>


<!DOCTYPE html>
<html>
<head>
	<title>Signup</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
<?php
    include ("header.php");
?>


                <div class="modal-body">
                    <form name="myform" class="form-detail" method="POST" id="dodajUporabnikaForm" enctype="multipart/form-data">
                        <h2>Registracija</h2>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Uporabniško Ime:</label>
                            <input type="text" name="username" id="name" class="form-control" placeholder="Uporabniško ime">
                          </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email:</label>
                            <input type="text" name="email" id="email" class="form-control" placeholder="Vaš eMail" pattern="[^@]+@[^@]+.[a-zA-Z]{2,6}">
                          </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Geslo:</label>
                            <input type="password" name="password" id="geslo" class="form-control" placeholder="Geslo">
                          </div>
                        <div class="form-group">
                            <button type="submit" name="register" class="btn btn-primary" value="Registriraj Me">Potrdi</button>
                        </div>
                        <a href="login.php">Prijava</a><br><br>
                    </form>
                </div>
                <?php include ("footer.php")?>
                </body>
</html>