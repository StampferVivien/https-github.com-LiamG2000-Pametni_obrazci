<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require './PHPMailer/src/Exception.php';
require './PHPMailer/src/PHPMailer.php';
require './PHPMailer/src/SMTP.php';
//<<<<< KODA UPORABLJENA PRI REGISTRACIJA.PHP >>>>>

//Nastavljanej vrednosti
$Erruser_name = $Erremail = $Erremailzaseden = $Errpassword = $ErrRandom = "";
$user_name = $email = $password = "";
$verificationCode = rand(10000, 99999);

//Pritisk gumba "Potrdi"
if($_SERVER['REQUEST_METHOD'] == "POST"){
  //Preverjanje uporabniskega imena
  if(empty($_POST["username"])){
    $Erruser_name = "Uporabniško ime je obvezno";
  }else{
    $user_name = $_POST["username"];
  }
  //preverjanje emaila
  if(empty($_POST["email"])){
    $Erremail = "Email je obvezen";
  }else{
    if(preveriMail($con, $_POST["email"]) == true){
      $email = $_POST["email"];
	  $mail = new PHPMailer(true);
	  $mail->isSMTP();
	  $mail->Host = 'smtp.gmail.com';
	  $mail->SMTPAuth = true;
	  $mail->Username = 'pametni.obrazci@gmail.com';
	  $mail->Password ='dxtqzjxjifzhmeik';
	  $mail->Port=465;
	  $mail->SMTPSecure = 'ssl';
	  $mail->isHTML(true);
	  $mail->AddAddress($email);
	  $mail->Subject = 'Potrditvena koda';
	  $mail->setFrom('pametni.obrazci@gmail.com');
	  $mail->Body    = '<b>Vaša potrditvena koda za spletno stran PAMETNI OBRAZCI je tukaj!</b>'.$verificationCode;
  
  
	  $mail->send();


    }else{
      $Erremail = "Email je že v uporabi";
    }
  }
  //preverjanje gesla
  if(empty($_POST["password"])){
    $Errpassword  = "Geslo je obvezno";
  }else{
    $password = password_hash($_POST["password"], PASSWORD_BCRYPT, array('cost' => 9));;
  }
  //Ce je vse vneseno se zacne vnos v bazo
  if(!empty($user_name) && !empty($password) && !empty($email)){
   //
    $user_id = novUserId($con);
    $stmt = $con -> prepare("insert into uporabnik (uporabnisko_ime, email, geslo, user_id, verificationCode) values (?,?,?,?,?)");
    $stmt -> bind_param("sssii", $user_name, $email, $password, $user_id, $verificationCode);
    if($stmt -> execute() == true){
      header("Location: login.php");
      if(posliMail($con, $verificationCode) == false){
        $ErrRandom = "Napaka pri pošiljanju mail-a prosim kontaktirajte administratorja";
      }
      die;
    }else{
      $ErrRandom = "Prislo je do napake, prosim poskusite ponovno!";
    }
  }
}

//Preveri ali je mail ki ga uporabnik vnese že v uporabi
function preveriMail($con, $mail){
	$query = "select * from uporabnik where email='$mail'";
	$result = mysqli_query($con, $query);

	if($result && mysqli_num_rows($result) == 0){
		return true;
	}
	else{
		return false;
	}
}

//Generira nov user_id ter pregleda, da identicen ze ne obstaja
function novUserId($con){
	$userId = rand(10000, 99999);
	$query = "select * from uporabnik where user_id='$userId'";
	$result = mysqli_query($con, $query);

	if(mysqli_num_rows($result) > 0){
		novUserId();
	}else{
		return $userId;
	}
}

//Poslje mail s narejeno verifikacijsko kodo
//function posliMail($email,$veritificationcode ){
	//ini_set("SMTP","ssl:smtp.office365.com" );
	//ini_set("smtp_port","587");
	//ini_set('sendmail_from', 'pametni.obrazci@outlook.com');

	//$to = $email;
	//$subject = "Test mail";
	//$message = "Hello! This is a simple email message. ".$veritificationcode;
	//$from = "pametni.obrazci@outlook.com";
	//$headers = "From:" . $from;
	//$retval = mail($to,$subject,$message,$headers);

	//if( $retval == true ){
	//  	return true;
	//}else{
		//return false;
	//}
//}

//<<<<< KODA UPORABLJENA PRI REGISTRACIJA.PHP >>>>> 



/*if(isset($_POST['register'])){
	
	
	//$name = $_POST['name'];
	//$email = htmlentities($_POST['email']);
	//$email = $_POST['email'];
	$email = "pametni.obrazci@gmail.com";
	echo "<script>console.log($email);</script>";

	$mail = new PHPMailer(true);
	$mail->isSMTP();
	$mail->Host = 'smtp.gmail.com';
	$mail->SMTPAuth = true;
	$mail->Username = 'pametni.obrazci@gmail.com';
	$mail->Password ='dxtqzjxjifzhmeik';
	$mail->Port=465;
	$mail->SMTPSecure = 'ssl';
	$mail->isHTML(true);
	$mail->AddAddress($email);
	$mail->Subject = 'Test Mail';
	$mail->setFrom('pametni.obrazci@gmail.com');
	$mail->Body    = 'This is the HTML message body <b>in bold!</b>';


	$mail->send();
    echo "<script>console.log('msg send');</script>";
}*/
  




//<<<<< KODA UPORABLJENA PRI LOGIN.PHP >>>>>

//Nastavitev spremenljivk
$Erremail = $Errpassword = $Errrandom = "";
$email = $password = "";

//Pritisk na gumb "Prijava"
if($_SERVER['REQUEST_METHOD'] == "POST"){
	
	//Preveri ce je vnesen email
	if(empty($_POST["email"])){
		$Erremail = "Email je obvezen";
	}else{
		$email = $_POST["email"];
	}

	//Preveri ce je vneseno geslo
	if(empty($_POST["password"])){
		$Errpassword = "Geslo je obvezno";
	}else{
		$password = $_POST["password"];
	}

	//Preveri in pregleda ce se email ter geslo ujema s tem kaj je v bazi
	if(!empty($email) && !empty($password)){
		$query = "select * from uporabnik where email='$email'";
		$result = mysqli_query($con, $query);
		if(mysqli_num_rows($result) > 0){
			$user_data = mysqli_fetch_assoc($result);
			if(password_verify($password, $user_data["geslo"])){
				$_SESSION["user_id"] = $user_data["user_id"];
				header("Location: index.php");
				die;
			}else{
				$Errrandom = "Email ali geslo se ne ujema";
			}
		}else{
			$Errrandom = "Email ali geslo se ne ujema";;
		}
	}
}

//<<<<< KODA UPORABLJENA PRI LOGIN.PHP >>>>>





//<<<<< KODA UPORABLJENA PRI NAVBAR.PHP >>>>>

//Preveri ce je uporabink prijavljen, drugace ga vrne na stran za pri prijavo
function check_login($con){

	if(isset($_SESSION['user_id'])){
		$id = $_SESSION['user_id'];
		$query = "select * from uporabnik where user_id = '$id' limit 1";
		$result = mysqli_query($con,$query);

		if($result && mysqli_num_rows($result) > 0){
			$user_data = mysqli_fetch_assoc($result);
			return $user_data;
		}
	}
	header("Location: login.php");
	die;

}

//Preveri ce je uporabnik administrator
function checkAdmin($con){

	if(isset($_SESSION['user_id'])){
		$id = $_SESSION['user_id'];
		$query = "select * from uporabnik where user_id = '$id' limit 1";
		$result = mysqli_query($con,$query);

		if($result && mysqli_num_rows($result) > 0){
			$user_data = mysqli_fetch_assoc($result);
			if($user_data["admin"] == 1){
				return true;	
			}
			else{
				return false;
			}
		}
	}
	header("Location: login.php");
	die;
}

//Preveri ali je uporabnik ze potrdil svoj email naslov, ce ne vidi dodatno okno v navigaciji kjer lahko to stori
function checkVerify($con){

	if(isset($_SESSION['user_id'])){
		$id = $_SESSION['user_id'];
		$query = "select * from uporabnik where user_id = '$id' limit 1";
		$result = mysqli_query($con,$query);

		if($result && mysqli_num_rows($result) > 0){
			$user_data = mysqli_fetch_assoc($result);
			if($user_data["potrjen"] == 0){
				return false;	
			}
			else{
				return true;
			}
		}
	}
	die;
}

//<<<<< KODA UPORABLJENA PRI NAVBAR.PHP >>>>>





//<<<<< KODA UPORABLJENA PRI DATOTEKE.PHP >>>>>

function getUserDoc($con, $userId){
	$query = "select * from dokument where tk_uporabnik='$userId'";
	$result = mysqli_query($con, $query);
	
	echo '<form action="" method="post">';
	echo "<table class='table table-hover'>";
	echo 
	'<thead class="thead-dark">
		<tr>
			<th scope="col">Naziv</th>
			<th scope="col">Številka dokumenta</th>
			<th scope="col">Cena</th>
			<th scope="col">Izbriši</th>
		</tr>
	</thead>'; 

	echo '<tbody>';

	while($row = mysqli_fetch_array($result)){   
	echo "<tr>";
		echo "<td>";
			echo $row["naziv"];
		echo "</td>";
		echo "<td>";
			echo $row["stevilkaDokumenta"];
		echo "</td>";
		echo "<td>";
			echo $row["cena"] . " $";
		echo "</td>";
		echo "<td>";
			echo "<button name='delBtn' value='".$row["id"]."' style='color:red;'>Izbriši</button>";
		echo "</td>";
	echo "</tr>";
	}
	echo '</tbody>';
	echo "</table>"; 
	echo "</form>";
}

if(isset($_POST["delBtn"])){
	$documentId = $_POST["delBtn"];
	$query = "delete from dokument where id='$documentId'";
    $results = mysqli_query($con, $query);
    header("Location: datoteke.php");
}

//<<<<< KODA UPORABLJENA PRI DATOTEKE.PHP >>>>>





//<<<<< KODA UPORABLJENA PRI UPORABNIKI.PHP >>>>>

function pridobiUporabnike($con){
	$query = "select * from uporabnik";
	$result = mysqli_query($con, $query);

	echo "<table class='table table-hover'>";
	echo 
	'<thead class="thead-dark">
		<tr>
			<th scope="col">ID</th>
			<th scope="col">Uporabniško ime</th>
			<th scope="col">Email</th>
			<th scope="col">Administrator</th>
			<th scope="col">Potrjen</th>
		</tr>
	</thead>'; 

	echo '<tbody>';
	while($row = mysqli_fetch_array($result)){   
		echo "<tr>";
			echo "<td>";
				echo '<a href="uporabnik.php?id=' . $row["id"] . '">Uredi</a>';
			echo "</td>";
			echo "<td>";
				echo $row['uporabnisko_ime'];
			echo "</td>";
			echo "<td>";
				echo $row['email'];
			echo "</td>";
			echo "<td>";
				if($row['admin'] == 1){echo "Da";}else{echo "Ne";}
			echo "</td>";
			echo "<td>";
				if($row['potrjen'] == 1){echo "Da";}else{echo "Ne";}
			echo "</td>";
		echo "</tr>";
	}
	echo '</tbody>';
	echo "</table>"; 
	mysqli_close($con);
}

//<<<<< KODA UPORABLJENA PRI UPORABNIKI.PHP >>>>>





//<<<<< KODA UPORABLJENA PRI UPORABNIK.PHP >>>>>

function pridobiUporabnika($con, $id){
    $query = "select * from uporabnik where id='$id'";
	$result = mysqli_query($con, $query);
    if($result && mysqli_num_rows($result) > 0){
		$uporabnik = mysqli_fetch_assoc($result);
		return $uporabnik;
	}
}

//<<<<< KODA UPORABLJENA PRI UPORABNIK.PHP >>>>>




function genNewDocId($con){

	$docId = rand(10000, 99999);
	$query = "select * from dokument where stevilkaDokumenta='$docId'";
	$result = mysqli_query($con, $query);

	if(mysqli_num_rows($result) > 0){
		genNewDocId();
	}else{
		return $docId;
	}
}



  