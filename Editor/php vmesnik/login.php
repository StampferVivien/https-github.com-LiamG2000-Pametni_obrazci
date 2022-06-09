<?php 
session_start();
include ("config.php");
include ("functions.php");
?>

<!DOCTYPE html>
<html>
	<head>
	    <title>Prijava</title>
	    <link rel="icon" type="image/png" href="https://github.com/LiamG2000/Pametni_obrazci/blob/master/slike/logo3.png"/>
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
		    <form name="myform" class="form-detail" method="POST" id="dodajUporabnikaForm">
		        <h2>Prijava</h2>
		        <div class="form-group">
		            <label for="exampleInputEmail1">Email:</label>
					<span class="error">* <?php echo $Erremail;?></span>
		            <input type="text" name="email" id="email" class="form-control" placeholder="Vaš eMail" pattern="[^@]+@[^@]+.[a-zA-Z]{2,6}">
		        </div>
		        <div class="form-group">
		            <label for="exampleInputEmail1">Geslo:</label>
					<span class="error">* <?php echo $Errpassword;?></span>
		            <input type="password" name="password" id="geslo" class="form-control" placeholder="Geslo">
		        </div>
		        <div class="form-group">
		            <button type="submit" name="register" class="btn btn-primary" value="Registriraj Me">Prijava</button>
					<span class="error"><?php echo $Errrandom;?></span>
		        </div>
		        <a href="registracija.php">Registracija</a><br><br>
		    </form>
		</div>
		<?php include ("footer.php")?>
	</body>
</html>
