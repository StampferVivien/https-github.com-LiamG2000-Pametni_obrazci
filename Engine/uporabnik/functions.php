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

function random_num($length)
{

	$text = "";
	if($length < 5)
	{
		$length = 5;
	}
	
	$len = rand(4,$length);

	for ($i=0; $i < $len; $i++) { 
		# code...

		$text .= rand(0,9);
	}

	return $text;
}

function pridobiPodjetja($con){
    $query = "select * from podjetje";

    $result = mysqli_query($con, $query);
    
    if($result && mysqli_num_rows($result) > 0){
        $podjetja = mysqli_fetch_all($result);
        return $podjetja;
    }

}


function enoPodjetje($con, $id){

    $query = "select * from podjetje where id='$id'";
    $result = mysqli_query($con, $query);

    if($result && mysqli_num_rows($result) > 0){
        $podjetje = mysqli_fetch_all($result);
        return $podjetje;
	}
	else{
		echo "Trenutno ni nobenih podjetij";
	}
}


function uporabnikovProfil($con, $id){

    $query = "select * from uporabnik where user_id='$id'";
    $result = mysqli_query($con, $query);

    if($result && mysqli_num_rows($result) > 0){
        $uporabnik = mysqli_fetch_all($result);
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