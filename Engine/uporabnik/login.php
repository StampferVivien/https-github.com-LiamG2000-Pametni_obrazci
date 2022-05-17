<?php 

session_start();

	include ("config.php");
	include ("functions.php");

	if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		//something was posted
		$email = $_POST['email'];
		$password = $_POST['password'];

		if(!empty($email) && !empty($password) && !is_numeric($email))
		{

			//read from database
			$query = "select * from uporabnik where email = '$email' limit 1";
			$result = mysqli_query($con, $query);

			if($result)
			{
				if($result && mysqli_num_rows($result) > 0)
				{

					$user_data = mysqli_fetch_assoc($result);
					
					if(password_verify($password, $user_data['geslo']))
					{
						$_SESSION['user_id'] = $user_data['user_id'];
						header("Location: index.php");
						die;
					}
				}
			}
			
			echo "wrong username or password!";
		}else
		{
			echo "wrong username or password!";
		}
	}

?>


<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
<?php
    include ("header.php");
?>


                <div class="modal-body">
                    <form name="myform" class="form-detail" method="POST" id="dodajUporabnikaForm">
                        <h2>Prijava</h2>
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
                        <a href="registracija.php">Registracija</a><br><br>
                    </form>
                </div>

                <?php include ("footer.php")?>
                </body>
</html>
