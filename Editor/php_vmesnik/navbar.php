<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav">
                <li>
                    <a href="./index.php">Domov</a>
                </li>
                <?php 
                if(checkAdmin($con) == true){
                    echo '<li>';
                    echo '<a href="uporabniki.php">Uporabniki</a>';
                    echo '</li>';
                }
                if(checkVerify($con) == false){
                    echo '<li>';
                    echo '<a style="background-color: red; color: white;" href="./potrditevEmail.php">Potrdi email</a>';
                    echo "</li>";
                }
                ?>
                <li>
                    <a href="./datoteke.php">Moje datoteke</a>
                </li>
                <li>
                    <a href="../../Engine/php/index.php">Naloži pdf</a>
                </li>
            </ul>
            <div id="je_prijavljen" style="color: white; margin-left: 85%; font-family: 'Times New Roman', Times, serif; font-size: 20px;">
                Prijavljen/a: <?php echo($user_data['uporabnisko_ime'] . "!"); ?>
                <span id="ime_uporabnika"></span>
                <a onClick="window.location.href = './logout.php'" class="logout-btn">Odjava</a>
            </div>
        </div>
    </div>
</nav>
<style>
    .logout-btn {
        display: inline-block;
        padding: 10px 20px;
        background-color: #f44336;
        color: white;
        text-decoration: none;
        border-radius: 4px;
        border: none;
        cursor: pointer;
    }

    .logout-btn:hover {
        background-color: #d32f2f;
    }
</style>