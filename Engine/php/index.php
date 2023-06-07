<?php
session_start();
include ("config.php");
include ("functions.php");
$ErrRandom = "";
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
    <title>Pametni obrazci | Engine</title>
</head>
<body>
   
    <?php 
        include ("header.php"); 
        include ("navbar.php");
    ?>  

<div style="text-align: center;">
    <form name="myform" class="form-detail" method="POST" id="dodajUporabnikaForm">
	    <div class="form-group">
	        <label for="dokumentId">Identifikacijska številka dokumenta:</label>
	        <input type="text" name="dokumentId" id="dokumentId" class="form-control" placeholder="npr. 123456" pattern="[0-9]+" required>
	    </div>
        <div class="form-group">
		    <button type="submit" name="search" class="btn btn-primary" value="Išči">Išči</button>
			<span class="error"><?php echo $ErrRandom;?></span>
		</div>
	</form>
</div>

<div style="text-align: center;">
    <?php
        if($_SERVER['REQUEST_METHOD'] == "POST"){
            $docId = $_POST["dokumentId"];
        
            if(!empty($docId)){
                $dokumenti = pridobiDokumente($con, $docId);
            }
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
