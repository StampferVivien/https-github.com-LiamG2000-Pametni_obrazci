<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        <title>Začetna Stran</title>
        <style>
            .naslov{
                color: black;
                opacity: 100%;
            }
            .middleDiv{
                opacity: 50%;
            }
            .middleDiv:hover{
                opacity: 100%;
            }

            .mainDiv{

            }
            
            body {
  font-family: Arial;
  color: white;
}

.split {
  height: 100%;
  width: 50%;
  position: fixed;
  z-index: 1;
  top: 0;
  overflow-x: hidden;
  padding-top: 20px;
}

.left {
  left: 0;
  background-color: #38a8db;
}

.right {
  right: 0;
  background-color: #DDE1DF;
}

.centered {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  text-align: center;
}

.centered img {
  width: 150px;
  border-radius: 40%;
}
a:link {
  color: black;
}
/* mouse over link */
a:hover {
  color: blue;
}
  </style>
    </head>
    <body>

    <div style="width: 100%; height: 500px; text-align:center;" class="mainDiv">
        <div style="width: 50%; height: 100%; float: left; background: gray;" class="middleDiv" onclick="preusmeri1()"> 
            <h1 class="naslov"><a href="./Editor/php_vmesnik/index.php" id="p1">Urejevalnik</a></h1> 
        </div>
        <div style="margin-left: 50%; height: 100%; background: lightblue;" class="middleDiv" onclick="preusmeri2()"> 
            <h1 class="naslov"><a href="./Engine/php/index.php" id="p2">Vprašalnik</a></h1>
        </div>
    </div>
    
    <div class="split left">
  <div class="centered">
  <a href="./Editor/php_vmesnik/index.php" id="p1"><img src="./slike/img_editor.png" alt="Avatar woman"></a>
    <h2><h1 class="naslov"><a href="./Editor/php_vmesnik/index.php" id="p1">Urejevalnik</a></h1> </h2>
    <p>Uredite lasten obrazec</p>
  </div>
</div>

<div class="split right">
  <div class="centered">
  <a href="./Engine/php/index.php" id="p2"><img src="./slike/img_vprasalnik.jpg" alt="Avatar man"></a>
    <h2><h1 class="naslov"><a href="./Engine/php/index.php" id="p2">Vprašalnik</a></h1></h2>
    <p style="color: black;">Pridobite lasten obrazec ali od nekoga drugega.</p>
  </div>
</div>

    <script>
        function preusmeri1(){
            console.log("Preusmerjam v urejevalnik besedila");
            document.getElementById("p1").click();

        }
        function preusmeri2(){
            console.log("Preusmerjam v vprašalnik");
            document.getElementById("p2").click();

        }
    </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js " integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0 " crossorigin="anonymous "></script>
    </body>
</html>