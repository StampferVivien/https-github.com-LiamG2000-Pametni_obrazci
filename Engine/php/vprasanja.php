<?php
session_start();
    include ("config.php");
    include ("functions.php");
    $id = $_GET["id"];
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

<div style="text-align:center;">
    <?php

        $document = pridobiDokument($con, $id);
        $vprasanjaRaw = $document["vprasanja"];
        $vprasanja = json_decode($document["vprasanja"]);
        $poljeString = $document["poljeString"];
        $html = $document["besedilo"];

        if(!empty($document)){
            echo "Naziv dokumenta: " . $document["naziv"];
            echo "<br>";
            echo "Cena: " . $document["cena"] . " $.";
            echo "<br>";
           
            echo "<hr>";
            echo '<form action="" method="post">';
            foreach($vprasanja as $vprasanje){
                echo '<label for="odgovor">'. $vprasanje . '</label>';
                echo " ";
                echo '<input type="text" name="odgovor" id="">';
                echo "<br>";
            }
            echo "<hr>";
            echo '<button type="submit" name="shrani">Shrani pdf</button>';
            echo "</form>";
            echo '<input type="hidden" name="" id="poljeString" value="'. $poljeString .'">';
            echo '<input type="hidden" name="" id="besedilo" value="'. $html .'">';
            echo '<input type="hidden" name="" id="vprasanja" value="'. $vprasanjaRaw .'">';



        }

        if(isset($_POST["shrani"])){
            echo "delam"; 
        } 
    ?>
</div>


<a href="index.php">Nazaj</a>
<p onclick="test()">Test</p>

<?php
include ("footer.php");
?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js " integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0 " crossorigin="anonymous "></script>
    <script type="text/javascript" src="functions.js"></script>

</body>

</html>
