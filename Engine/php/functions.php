<?php
function pridobiDokumente($con, $docId){
	$query = "select * from dokument";
	$result = mysqli_query($con, $query);

	echo "<table class='table table-hover' >";
	echo 
	'<thead class="thead-dark">
		<tr>
			<th scope="col">Naziv</th>
			<th scope="col">Cena</th>
		</tr>
	</thead>'; 

	echo '<tbody>';

	while($row = mysqli_fetch_array($result)){
		if(str_contains($row["naziv"], strtolower($docId)) || $row["stevilkaDokumenta"] == $docId){   
	echo '<tr onclick="odpriFile('. $row["id"] .')">
	<td>'. $row["naziv"] .'</td>
	<td>'. $row["cena"] .'</td>
	</tr>';  
	}
}	
	echo '</tbody>';
	echo "</table>"; 
}

function pridobiDokument($con, $docId){
	$query = "select * from dokument where id='$docId'";
	$result = mysqli_query($con, $query);

	if($result && mysqli_num_rows($result) > 0){
		$dokument = mysqli_fetch_assoc($result);
		return $dokument;
	}else{
		echo "Napaka pri pridobivanju dokumenta";
	}
}





