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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.2/jspdf.debug.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.tiny.cloud/1/lf6b19popibawemzk9qpt3cf2eqexglq9mnzakqkvi9kh17x/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js" integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <title>Pametni obrazci | Engine</title>
</head>
<body onload="test1()">
    <?php include ("header.php"); ?>  

    <div style="display: none;" id="div_pdf">
    </div>

    <div style="text-align:center;">
        <?php
        $stVprasanj = 0;
        $odgovori = [];
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
            echo '<form action="" method="post">';
            foreach($vprasanja as $vprasanje){
                $stVprasanj += 1;
                echo '<label for="odgovor">'. $vprasanje . '</label>';
                echo " ";
                echo '<input type="text" name="odgovor'. $stVprasanj .'" id="">';
                echo "<br>";
            }
            echo '<button type="submit" name="shrani" id="shrani_pdf">Shrani pdf</button>';
            echo "</form>";
        }

        if(isset($_POST["shrani"])){
            for ($x = 1; $x <= $stVprasanj; $x++) {
                $odgovor = $_POST["odgovor".$x];
                array_push($odgovori, $odgovor);
              }
              $odgovoriDec = json_encode($odgovori);
            echo "<input type='hidden'  id='odgovori' value='". $odgovoriDec."'>";
            echo "<input type='hidden' id='poljeString' value='". $poljeString ."'>";
            echo "<input type='hidden' id='besedilo' value='". $html ."'>";
            echo "<input type='hidden' id='vprasanja' value='". $vprasanjaRaw ."'>";
        } 
    ?>
</div>
<a href="index.php" id="backBtn">Nazaj</a>
<?php
include ("footer.php");
?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js " integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0 " crossorigin="anonymous "></script>
<script type="text/javascript" src="functions.js"></script>

</body>
</html>
