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

    <br>
    <form method="POST">
        <div class="form-group">
          <label for="exampleInputEmail1">Naziv dokumenta</label>
          <input type="text" class="form-control" name="docName" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Vnesi naziv dokumenta">
          
        </div>
        <div class="form-group" id="placljivo">
          <label for="check">Plačljivo</label>
          <input type="checkbox" class="form-control" value="check" name="check" onclick="myFunction(this)">
        </div>
        
        <?php
            if(checkVerify($con) == true){
                echo '<button type="submit" class="btn btn-primary" name="submitbtn">Shrani</button>';
            }else{
                echo "Za shranjevanje je potrebno potrditi račun. To lahko storite" . ' <a href="potrditevEmail.php">tukaj</a>' ;
            }
        ?>
    </form>

    <script type="text/JavaScript">

        function nekaj(){
            return 5
        }

        function myFunction(me) {
            let input = document.createElement("input");
            input.setAttribute("type", "number");
            input.setAttribute("placeholder", "Vnesi ceno");
            input.setAttribute("name", "docPrice");
            let box = me;
            let div = document.getElementById("placljivo");
            if(box.checked == true){
                div.appendChild(input);
            }else{
                div.removeChild(div.lastChild);
            }
        }
    </script>

    <?php
        if(isset($_POST["submitbtn"])){
            $docName = strtolower($_POST["docName"]);
            $docPrice = 0;
            $docId = genNewDocId($con);
            $vprasanja = $_COOKIE["vprasanja"];
            if(isset($_POST["docPrice"])){
                $docPrice = $_POST["docPrice"];
            }
            $query = "insert into dokument (naziv, cena, stevilkaDokumenta, vprasanja) values ('$docName', '$docPrice', '$docId', '$vprasanja')";
            if(mysqli_query($con, $query) == true){
                echo "Datoteka uspešno shranjena. Za dostop do nje uporabite sledečo identifikacijsko številko: ";
                echo "<br>";
                echo $docId;
            }
            
        }
    ?>
    


<?php
include ("footer.php");
?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js " integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0 " crossorigin="anonymous "></script>
    
</body>

</html>
