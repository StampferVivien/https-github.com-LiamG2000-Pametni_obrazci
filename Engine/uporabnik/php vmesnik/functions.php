<?php

function check_login($con)
{

	if(isset($_SESSION['user_id']))
	{

		$id = $_SESSION['user_id'];
		$query = "select * from uporabnik where user_id = '$id' limit 1";

		$result = mysqli_query($con,$query);
		if($result && mysqli_num_rows($result) > 0)
		{
			$user_data = mysqli_fetch_assoc($result);
			return $user_data;
		}
	}
	header("Location: login.php");
	die;

}

function checkAdmin($con){

	if(isset($_SESSION['user_id']))
	{
		$id = $_SESSION['user_id'];
		$query = "select * from uporabnik where user_id = '$id' limit 1";

		$result = mysqli_query($con,$query);
		if($result && mysqli_num_rows($result) > 0)
		{

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

function random_num($length)
{
	$text = "";
	if($length < 5)
	{
		$length = 5;
	}

	$len = rand(4,$length);

	for ($i=0; $i < $len; $i++) { 
		
		$text .= rand(0,9);
	}
	return $text;
}

function pridobiUporabnika($con, $id){

    $query = "select * from uporabnik where id='$id'";
	$result = mysqli_query($con, $query);

    if($result && mysqli_num_rows($result) > 0){
		$uporabnik = mysqli_fetch_assoc($result);
		return $uporabnik;
	}


	
}

function preveriMail($con, $mail){
	$query = "select * from uporabnik where email='$mail'";
	$result = mysqli_query($con, $query);

	if($result && mysqli_num_rows($result) == 0){
		return true;
	}
}



function pridobiUporabnike($con){
	$query = "select * from uporabnik";
	$result = mysqli_query($con, $query);



	echo "<table class='table table-hover'>";
	echo 
	'<thead class="thead-dark">
		<tr>
			<th scope="col">ID</th>
			<th scope="col">Uporabnisko ime</th>
			<th scope="col">email</th>
			<th scope="col">admin</th>
		</tr>
	</thead>'; 

	echo '<tbody>';

	while($row = mysqli_fetch_array($result)){   
	echo "<tr><td>" . '<a href="uporabnik.php?id=' . $row["id"] . '">Uredi</a>' . "</td><td>" . $row['uporabnisko_ime'] . "</td><td>" . $row['email'] . "</td><td>" . $row['admin'] . "</td></tr>";  
	}	

	echo '</tbody>';
	echo "</table>"; 

	mysqli_close($con);
}





