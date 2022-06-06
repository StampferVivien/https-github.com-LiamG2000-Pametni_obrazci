<?php

function pridobiDokument($con, $docId){
	$query = "select * from dokument where stevilkaDokumenta='$docId'";
	$result = mysqli_query($con, $query);

	if($result && mysqli_num_rows($result) > 0){
		$dokument = mysqli_fetch_assoc($result);
		return $dokument;
	}else{
		echo "Dokument s to številko ne obstaja";
	}
}





