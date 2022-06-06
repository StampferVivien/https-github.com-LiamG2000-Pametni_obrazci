<?php
session_start();
    include ("config.php");
    include ("functions.php");
    $user_data = check_login($con);
    $id = $_GET["id"];
    $uporabnik = pridobiUporabnika($con, $id);
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

    <?php
        echo "<b>Uporabnisko ime: </b>" . $uporabnik["uporabnisko_ime"];
        echo "<br>";
        echo "<b>Email: </b>" . $uporabnik["email"];
        echo "<br>";
        if($uporabnik["admin"] == 0){
            echo "<b>Administrator: </b>" . "False";
        }else{
            echo "<b>Administrator: </b>" . "True";
        }
        echo "<br>";
        if($uporabnik["potrjen"] == 0){
            echo "<b>Potrjen email: </b>" . "False";
        }else{
            echo "<b>Potrjen email: </b>" . "True";
        }
        echo '<form action="" method="post">';
        echo "<button class='btn btn-danger' type='submit' name='deleteItem' value='".$uporabnik['id']."' />Delete</button></td>";
        echo '</form>';
        
        if(isset($_POST['deleteItem']) and is_numeric($_POST['deleteItem']))
        {
            $query = "delete from uporabnik where id='$id'";
            $results = mysqli_query($con, $query);
            header("Location: uporabniki.php");
        }
    ?>

<?php
include ("footer.php");
?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js " integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0 " crossorigin="anonymous "></script>
    
</body>

</html>
