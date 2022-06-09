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

<body onload="nastavi()">
   
    <?php
        include ("header.php");
        include ("navBar.php");
    ?>  

    <?php
        echo "<b>Uporabniško ime: </b>";
        echo "<p onclick='test(this)' id='uporabniskoIme'>". $uporabnik["uporabnisko_ime"] ."</p>" ;
        echo "<br>";
        echo "<b>Email: </b>";
        echo "<p onclick='test(this)' id='email'>" . $uporabnik["email"] . "</p>";
        echo "<br>";
        if($uporabnik["admin"] == 0){
            echo "<b>Administrator: </b>";
            echo "<p onclick='test(this)' id='administrator'>False</p>";
        }else{
            echo "<b>Administrator: </b>";
            echo "<p onclick='test(this)' id='administrator'>True</p>";
        } 
        echo "<br>";
        if($uporabnik["potrjen"] == 0){
            echo "<b>Potrjen email: </b>";
            echo "<p onclick='test(this)' id='potrjen'>False</p>";
        }else{
            echo "<b>Potrjen email: </b>";
            echo "<p onclick='test(this)' id='potrjen'>True</p>";
        }

        echo '<form action="" method="post">';
        echo '<input type="hidden" name="uporabniskoIme" id="f1" value="">';
        echo '<input type="hidden" name="email" id="f2" value="">';
        echo '<input type="hidden" name="administrator" id="f3" value="">';
        echo '<input type="hidden" name="potrjen" id="f4" value="">';
        echo "<button class='btn' type='submit' name='upDate' value='".$uporabnik['id']."' />Posodobi</button></td>";
        echo "<button class='btn btn-danger' type='submit' name='deleteItem' value='".$uporabnik['id']."' />Izbriši</button></td>";
        echo '</form>';
        
        if(isset($_POST['deleteItem']) and is_numeric($_POST['deleteItem'])){
            $query = "delete from uporabnik where id='$id'";
            $results = mysqli_query($con, $query);
            header("Location: uporabniki.php");
        }

        if(isset($_POST["upDate"])){
            $uporabniskoIme = $_POST["uporabniskoIme"];
            $email = $_POST["email"];
            $administrator = $_POST["administrator"];
            $potrjen = $_POST["potrjen"];

            $query = "update uporabnik set uporabnisko_ime='$uporabniskoIme', email='$email', admin='$administrator', potrjen='$potrjen' where id='$id'";
            mysqli_query($con, $query);
            header("Location: uporabniki.php");
        }
    ?>

    
    <script type="text/javascript">
        function nastavi(){
            console.log("Nastavlam polja");
            let uIme = document.getElementById("uporabniskoIme").innerHTML;
            let uEmail = document.getElementById("email").innerHTML;
            let uAdmin = document.getElementById("administrator").innerHTML;
            if(uAdmin == "True"){
                uAdmin = 1;
            }else{
                uAdmin = 0;
            }
            let uPotrjen = document.getElementById("potrjen").innerHTML;
            if(uPotrjen == "True"){
                uPotrjen = 1;
            }else{
                uPotrjen = 0;
            }

            let f1 = document.getElementById("f1");
            let f2 = document.getElementById("f2");
            let f3 = document.getElementById("f3");
            let f4 = document.getElementById("f4");

            f1.setAttribute("value", uIme);
            f2.setAttribute("value", uEmail);
            f3.setAttribute("value", uAdmin);
            f4.setAttribute("value", uPotrjen);
        }

        function test(me){
            console.log("Its me " + me.innerHTML);
            if(me.innerHTML == "True"){
                me.innerHTML = "False";
            }else if(me.innerHTML == "False"){
                me.innerHTML = "True";
            }else{
                let newVal = prompt("Vnesi novo vrednost");
                me.innerHTML = newVal;  
            }
            nastavi();
        }
    </script>

<?php
include ("footer.php");
?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js " integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0 " crossorigin="anonymous "></script>
    
</body>

</html>
