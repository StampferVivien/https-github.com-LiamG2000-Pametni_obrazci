<?php
session_start();
    include ("config.php");
    include ("functions.php");
    $user_data = check_login($con);
?>


<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/Style.css" />
    <link rel="icon" href="./Slike/logo.jpg">
    <title>Pametni obrazci</title>
</head>

<body>
   
    <?php
        include ("header.php");
        include ("navBar.php");
    ?> 

    <form action="" method="post">
        <label for="verCode">Vnesite kodo, ki ste jo prejeli na elektronski naslov "<?php  echo $user_data["email"]; ?>".</label> <br>
        <input type="number" name="verCode" id="">
        <br>
        <input type="submit" value="Potrdi" name="potrdi">
    </form>

    <?php 
        if(isset($_POST["potrdi"])){
            $inputCode = $_POST["verCode"];
            $userId = $user_data["id"]; 
            $query = "select * from uporabnik where id = '$userId' limit 1";
            $result = mysqli_query($con, $query);
            if($result && mysqli_num_rows($result) > 0){
			    $user_data = mysqli_fetch_assoc($result);
			    if($user_data["verificationCode"] == $inputCode){
                    $sql = "update uporabnik set potrjen='1' where id='$userId'";
                    mysqli_query($con, $sql);
			    	echo "Koda se ujema, racun je potrjen";
                    header("Location: index.php");
                    die;
			    }
			    else{
			    	echo "Vnešena koda je neveljavna prosim poskusite znova!";
			    }
		}
        }
    ?>


<?php
include ("footer.php");
?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js " integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0 " crossorigin="anonymous "></script>
    
</body>

</html>
