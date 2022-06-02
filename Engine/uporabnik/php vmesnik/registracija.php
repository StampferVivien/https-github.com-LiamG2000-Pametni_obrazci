<?php 
ini_set( 'display_errors', 1 );
error_reporting( E_ALL );

session_start();

	include ("config.php");
	include ("functions.php");

  

	if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		//something was posted
    $user_name = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
  
    
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT, array('cost' => 9));
    

    if(preveriMail($con, $email) == true){

      echo '<div class="alert alert-primary" role="alert">
      Email je ze zavzet
    </div>';


    
		if(!empty($user_name) && !empty($hashedPassword) && !is_numeric($user_name) && !empty($email))
		{
      $veritificationcode = substr(number_format(time()* rand(),0,"",""), 0,6);

			$user_id = random_num(20);
      $query = "insert into uporabnik (uporabnisko_ime, email, geslo,user_id,veritificationcode) values ('$user_name','$email','$hashedPassword', '$user_id','$veritificationcode' )";
      
    
      mysqli_query($con, $query);
      
  

			header("Location: login.php");
       
    posliMail($email, $veritificationcode);
      die;
      
		}else
		{
			echo "Please enter some valid information!";
		}
  }
  
}

function posliMail($email,$veritificationcode ){

  ini_set("SMTP","ssl:smtp.office365.com" );
  ini_set("smtp_port","587");
  ini_set('sendmail_from', 'pametni.obrazci@outlook.com');          
  $to = $email;
  $subject = "Test mail";
  $message = "Hello! This is a simple email message. ".$veritificationcode;
  $from = "pametni.obrazci@outlook.com";
  $headers = "From:" . $from;
  $retval = mail($to,$subject,$message,$headers);
     if( $retval == true )  
     {
        echo "Message sent successfully...";
     }
     else
     {
        echo "Message could not be sent...";
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