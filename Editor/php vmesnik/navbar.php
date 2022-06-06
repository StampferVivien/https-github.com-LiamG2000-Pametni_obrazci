<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navbar</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
<nav class="navbar navbar-inverse">
        <div class="container-fluid">
            <div class="collapse navbar-collapse" id="myNavbar">
                <ul class="nav navbar-nav">
                    <li><a href="index.php">Domov</a></li>
                    <?php 
                    if(checkAdmin($con) == true){
                        echo '<li><a href="uporabniki.php">Uporabniki</a></li>';
                    }
                    if(checkVerify($con) == false){
                        echo '<li><a style="background-color: red; color: white;" href="potrditevEmail.php">Potrdi email</a></li>';
                    }
                    ?>
                    <li><a href="datoteke.php">Moje datoteke</a></li>
                </ul>
                <div id="je_prijavljen"
                        style=" color: white; margin-left: 85%; font-family: 'Times New Roman', Times, serif ;font-size: 20px;">
                        Prijavljen/a: <?php 
                        echo ($user_data['uporabnisko_ime'] . "!");
                        ?>
                        <span id="ime_uporabnika"></span>
                        <button class="btn btn-sm btn-primary btn-block" style=" width: 88%; border-width: 2px;"
                            onClick="window.location.href = 'logout.php'">Odjava</button>
                    </div>
                    <br />
            </div>
        </div>
    </nav>
    
</body>
</html>