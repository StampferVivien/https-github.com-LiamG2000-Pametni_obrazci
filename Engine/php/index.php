<?php
session_start();
    include ("config.php");
    include ("functions.php");
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
    <title>Pametni obrazci | Engine</title>
</head>

<body>
   
    <?php
        include ("header.php");
    ?>  

<div style="text-align: center;">
    <form action="" method="post">
        <label for="imeDatoteke">Vnesi identifikacisko številko/naziv dokumenta: </label> <br>
        <input type="text" name="imeDatoteke" id="">
        <input type="submit" name="isci" value="Išči">
    </form>
</div>

<div style="text-align: center;">
    <?php
        if(isset($_POST["isci"])){
            $docId = $_POST["imeDatoteke"];
            $dokumenti = pridobiDokumente($con, $docId);
            
        }
    ?>
</div>
    



<?php
include ("footer.php");
?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js " integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0 " crossorigin="anonymous "></script>
    <script type="text/javascript" src="functions.js"></script>
</body>

</html>
