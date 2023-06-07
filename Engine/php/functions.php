<?php
function pridobiDokumente($con, $docId){
	$query = "select * from dokumenti where dokument_Id='$docId'";
	$result = mysqli_query($con, $query);

	if($result && mysqli_num_rows($result) > 0){
		
			header("Location: ../php/vprasanja.php?id=". urldecode($docId));
		}else{
			echo "Datoteka z vnešeno identifikacijsko številko ne obstaja!";

		}
}

function pridobiDokument($con, $docId){
	$query = "select * from dokumenti where dokument_Id='$docId'";
	$result = mysqli_query($con, $query);

	if($result && mysqli_num_rows($result) > 0){
		$dokument = mysqli_fetch_assoc($result);
		return $dokument;
	}else{
		echo "Napaka pri pridobivanju dokumenta";
	}
}


function emso_verify($emso) {

	$number = $emso;
	$digitArray = str_split((string)$number);
	$control_digit = array_pop($digitArray);
	$emso_factor_map = '(' . implode(',', $digitArray) . ')';

    for ($i = 0; $i < 12; $i++) {
        $control_digit += intval($emso[$i]) * $emso_factor_map[$i];
    }
    $control_digit = $control_digit % 11;
    $control_digit = ($control_digit == 0) ? 0 : 11 - $control_digit;
    return $control_digit == intval($emso[12]);
}

class Dokument {
    public $naziv;
    public $cena;
    public $vprasanja;
    public $besedilo;

    public function __construct($naziv, $cena, $vprasanja, $besedilo) {
        $this->naziv = $naziv;
        $this->cena = $cena;
        $this->vprasanja = $vprasanja;
        $this->besedilo = $besedilo;
    }
}





