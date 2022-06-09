<?php
session_start();
include ("config.php");
include ("functions.php");
$user_data = check_login($con);
$userId = $user_data["id"];
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
        <link rel="icon" type="image/png" href="https://raw.githubusercontent.com/LiamG2000/Pametni_obrazci/master/slike/logo3.png">
        <title>Pametni obrazci</title>
        <style>
          .error {color: #FF0000;}
          .success {color: green;}
        </style>
    </head>
    <body>
        <?php
        include ("header.php");
        include ("navBar.php");
        $ErrEmpty = $Errrandom = $SucMsg = "";
        $inputCode = "";
        ?> 
    
        <?php
        if(isset($_POST["potrdi"])){
            if(empty($_POST["verCode"])){
                $Errrandom = "Potrebno je vnesti potrditveno kodo";
            }else{
                $inputCode = $_POST["verCode"];
            }
        
            if(!empty($inputCode) && is_numeric($inputCode)){
                if($user_data["verificationCode"] == $inputCode){
                    $query = "update uporabnik set potrjen='1' where id='$userId'";
                    mysqli_query($con, $query);
                    $SucMsg = "Vaš račun je bil uspešno potrjen";
                    header("Location: index.php");
                    die;
                }else{
                    $ErrEmpty = "Vnesli ste napačno kodo, prosim poskusite ponovno.";
                }
            }else{
                $Errrandom = "Potrditvena koda lahko vsebuje samo številke";
            }
        }
        ?>
        <form action="" method="post">
            <label for="verCode">Vnesite kodo, ki ste jo prejeli na elektronski naslov " <?php echo $user_data["email"]; ?>".</label>
            <br>
            <input type="text" name="verCode" id="">
            <br>
            <input type="submit" value="Potrdi" name="potrdi">
            <span class="error"><?php echo $ErrEmpty . $Errrandom;?></span>
            <span class="success"><?php echo $SucMsg;?></span>
    
        </form>
        <?php include ("footer.php"); ?>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js " integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0 " crossorigin="anonymous "></script>
    </body>
</html>
