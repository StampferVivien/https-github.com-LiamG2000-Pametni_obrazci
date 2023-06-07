<?php
session_start();
include ("config.php");
include ("functions.php");
$user_data = check_login($con);
$userID = $user_data["id"];

if(isset($_GET["idDokumenta"])){
    $idDokumenta = $_GET["idDokumenta"];
    $query = "select * from dokumenti where dokument_Id='$idDokumenta'";
    $results = mysqli_query($con, $query);

    $results = mysqli_fetch_assoc($results);
   
    $dokumentDecoded = base64_decode($results["datoteka"]);
    $dokumentNeseria = unserialize($dokumentDecoded);
	$jsonString = json_encode($dokumentNeseria);
    $array = json_decode($jsonString, true);
    
    $staraVprasanja = [];

    foreach($array["vprasanja"] as $vprasanje){
        $staraVprasanja[] = $vprasanje["vprasanje"];
    }

    $staraVprasanja = json_encode($staraVprasanja);

    $paramValue = $array["besedilo"];
    $paramVprasanja = $staraVprasanja;
    $inputiEncoded = ($results["poljeString"]);
    $paramInputov = $inputiEncoded;

}else{
    $idDokumenta = "";
    $paramValue = "";
    $paramVprasanja = "";
    $paramInputov =  "";
}



/*
if(isset($_GET["param2"])){
    $paramValue = $_GET["param2"];
    $paramVprasanja = $_GET["param1"];
    $paramInputov = $_GET["param3"];
}else{
    $paramValue = "";
    $paramVprasanja = "";
    $paramInputov =  "";
}

*/
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
    <script src="../css/index.css"></script>
    <link href="../dist/output.css" rel="stylesheet">
    <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.tiny.cloud/1/lf6b19popibawemzk9qpt3cf2eqexglq9mnzakqkvi9kh17x/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    <title>Pametni obrazci</title>
</head>

<body>
<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    <?php
        include ("header.php");
        include ("navbar.php");
    ?>
    
    
    <br>
    <form method="POST">
        <div class="form-group">
          <label for="exampleInputEmail1">Naziv dokumenta</label>
          <input type="text" class="form-control" name="docName" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Vnesi naziv dokumenta" required="true">

          <br>
            <!---------------------------------------------------------------------------------------------------------------------------------------------------------->
        <div class="flex">
        <aside class="h-40 sticky">
            <div class="overflow-y-auto py-4 px-3 bg-gray-50 rounded dark:bg-gray-800">
                <ul class="space-y-2">
                   <li>
                      <a href="#" class="flex items-center p-2">
                        <ion-icon name="person-outline"></ion-icon>
                        <span class="flex-1 ml-3 whitespace-nowrap"><p draggable="true" id="input1"><div draggable="true" class=" hover:border-blue-500 w-44 h-7 border-2 border-gray-600 rounded-lg" id="Ime" ondragstart="dragStart(event)"> Ime</div></p></span>
                      </a>
                   </li>
                   <li>
                      <a href="#" class="flex items-center p-2">
                        <ion-icon name="person"></ion-icon>
                        <span class="flex-1 ml-3 whitespace-nowrap"><p draggable="true" id="input2"><div draggable="true" class=" hover:border-blue-500 w-44 h-7 border-2 border-gray-600 rounded-lg" id="Priimek"  ondragstart="dragStart(event)"> Priimek</div></p></span>
                      </a>
                   </li>
                   <li>
                      <a href="#" class="flex items-center p-2">
                        <ion-icon name="id-card-outline"></ion-icon>
                        <span class="flex-1 ml-3 whitespace-nowrap"><p draggable="true" id="input3"><div draggable="true" class=" hover:border-blue-500 w-44 h-7 border-2 border-gray-600 rounded-lg" id="emso"  ondragstart="dragStart(event)"> emso</div></p></span>
                      </a>
                   </li>
                   <li>
                      <a href="#" class="flex items-center p-2">
                        <ion-icon name="calendar-outline"></ion-icon>
                        <span class="flex-1 ml-3 whitespace-nowrap"><p draggable="true" id="input4"><div draggable="true" class=" hover:border-blue-500 w-44 h-7 border-2 border-gray-600 rounded-lg" id="Datum"  ondragstart="dragStart(event)"> Datum</div></p></span>
                      </a>
                   </li>
                   <li>
                      <a href="#" class="flex items-center p-2">
                        <ion-icon name="mail-outline"></ion-icon>
                        <span class="flex-1 ml-3 whitespace-nowrap"><p draggable="true" id="input5"><div draggable="true" class=" hover:border-blue-500 w-44 h-7 border-2 border-gray-600 rounded-lg" id="Posta"  ondragstart="dragStart(event)"> Posta</div></p></span>
                      </a>
                   </li>
                   <li>
                      <a href="#" class="flex items-center p-2">
                        <ion-icon name="home-outline"></ion-icon>
                         <span class="flex-1 ml-3 whitespace-nowrap"><p draggable="true" id="input6"><div draggable="true" class=" hover:border-blue-500 w-44 h-7 border-2 border-gray-600 rounded-lg" id="Kraj"  ondragstart="dragStart(event)"> Kraj</div></p></span>
                      </a>
                   </li>
                   <li>
                      <a href="#" class="flex items-center p-2">
                        <ion-icon name="earth-outline"></ion-icon>
                        <span class="flex-1 ml-3 whitespace-nowrap"><p draggable="true" id="input7"><div draggable="true" class=" hover:border-blue-500 w-44 h-7 border-2 border-gray-600 rounded-lg" id="Drzava"  ondragstart="dragStart(event)"> Drzava</div></p></span>
                      </a>
                   </li>
                   <li>
                     <a href="#" class="flex items-center p-2">
                        <ion-icon name="calendar-outline"></ion-icon>
                        <span class="flex-1 ml-3 whitespace-nowrap"><p draggable="true" id="input8"><div draggable="true" class=" hover:border-blue-500 w-44 h-7 border-2 border-gray-600 rounded-lg" id="Telefon"  ondragstart="dragStart(event)"> Telefon</div></p></span>
                     </a>
                  </li>
                  <li>
                     <a href="#" class="flex items-center p-2">
                        <ion-icon name="add-circle-outline"></ion-icon>
                        <span class="flex-1 ml-3 whitespace-nowrap"><p draggable="true" id="input8"><input draggable="true" class="hover:border-blue-500" value=" Vrednost po meri" id="input_8" ondragstart="dragStart(event)" disabled></p></span>
                     </a>
                  </li>
                 
                </ul>
                <button type="button" onclick="get_editor_content()" style="display: none;">Shrani tekst</button>
                <br>
                <button type="button" onclick="set_editor_content()" style="display: none;">Naloži tekst</button>
             </div>
        </aside>
        <main class="flex flex-col w-screen">
            <div contenteditable="true" id="text_editor"></div>
        </main>
    </div>
    <div class="form-group" id="placljivo">
          <label for="check">Plačljivo</label>
          <input type="checkbox"  value="check" name="check" onclick="prikaziCeno(this)">
          <input type="hidden"  name="vprasanja" id="vprasanja"/>
          <input type='hidden'  name='poljeString'  id='poljeString'/>
          <input type="hidden"  name="besedilo"  id="besedilo" >
          <?php echo "<input type='hidden' id='besediloIzBaze' value='". $paramValue ."'>"; 
                echo "<input type='hidden' id='vprasanjaIzBaze' value='". $paramVprasanja ."'>";
                echo "<input type='hidden' id='StringInputov' value='". $paramInputov ."'>";

                ?>
          <br>
        </div>  
        <?php
            if(checkVerify($con) == true){
                echo '<div><button type="submit" class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded" name="submitbtn">Shrani</button></div>';
            }else{
                echo "Za shranjevanje je potrebno potrditi račun. To lahko storite" . ' <a href="potrditevEmail.php">tukaj</a>' ;
                echo "<br>";
            }

        ?>
    </form>

  <!------------------------------------------------------------------------------------------------------------------------------------------- -->
        
      

    <script type="text/JavaScript">

        $('#vprasanje_input').keypress(function (e) {                                       
               if (e.which == 13) {
                    e.preventDefault();
                    //do something   
                    }
                });

        function prikaziCeno(me) {
            let input = document.createElement("input");
            input.setAttribute("type", "number");
            input.setAttribute("placeholder", "Vnesi ceno");
            input.setAttribute("name", "docPrice");
            input.setAttribute("required", "true");
            let box = me;
            let div = document.getElementById("placljivo");
            if(box.checked == true){
                div.appendChild(input);
            }else{
                div.removeChild(div.lastChild);
            }
        }

    </script>


    <?php

        if(isset($_POST["submitbtn"])){
            $docName = strtolower($_POST["docName"]);
            $docPrice = 0;
            $docId = genNewDocId($con);
            $vprasanja = $_POST["vprasanja"];
            $poljeString = $_POST["poljeString"];
            $coded = base64_encode($poljeString);
            $html = $_POST["besedilo"];
            #$html = "Tukaj pride besedilo tekstva";
            $besedilo = base64_encode($html);

            if(isset($_POST["docPrice"])){
                $docPrice = $_POST["docPrice"];
            }

            $samoVprasanja = [];
            $dataTypeVprasanja = [];

            $vprasanjaArray = json_decode($vprasanja);
            $vprasanjeId = 0;

            $pattern = "/<input.*?value='(.*?)'.*?>/i";
            preg_match_all($pattern, $poljeString, $matches);

            $inputValues = $matches[1];

            $type = $inputValues;

            foreach($vprasanjaArray as $vprasanje){
                $novoVprasanje = [
                    "vprasanjeId" => $vprasanjeId,
                    "vprasanje" => $vprasanje,
                    "dataType" => $type[$vprasanjeId],
                    "odgovor" => ""
                ];

            $vprasanjeId++;
            
            $samoVprasanja[] = $novoVprasanje;
            }

            $dokument1 = new Dokument($docName, $docPrice, $samoVprasanja, $besedilo);
            $dokument1String = serialize($dokument1);

            $wholeDok = base64_encode($dokument1String);

            $query = "insert into dokumenti (dokument_Id, datoteka, poljeString, tk_uporabnik) values ('$docId',  '$wholeDok', '$coded','$userID')";

            #$query = "insert into dokument (naziv, cena, stevilkaDokumenta, vprasanja, poljeString, besedilo, tk_uporabnik) values ('$docName', '$docPrice', '$docId', '$vprasanja', '$coded', '$besedilo', '$userID')";

            if(mysqli_query($con, $query) == true){
                echo "Datoteka uspešno shranjena. Za dostop do nje uporabite sledečo identifikacijsko številko: ";
                echo "<br>";
                echo $docId;
                echo "<br>";
            }else{
                echo mysqli_error($con);
            }
        }
        
    ?>
        <div class="m-1">
      <div x-data="{ showModal : false }">
         
          <button type="button" @click="showModal = !showModal" class="invisible" id="gumb123">Open Modal</button>
  
          <div x-show="showModal" class="fixed text-gray-500 flex items-center justify-center overflow-auto z-50 bg-indigo-600 bg-opacity-5 left-0 right-0 top-0 bottom-0" x-transition:enter="transition ease duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition ease duration-300" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
              
              <div x-show="showModal" class="bg-white rounded-xl shadow-2xl p-6 sm:w-3/12 mx-10" @click.away="showModal = false;delete_input()" x-transition:enter="transition ease duration-100 transform" x-transition:enter-start="opacity-0 scale-70 translate-y-1" x-transition:enter-end="opacity-80 scale-100 translate-y-0" x-transition:leave="transition ease duration-100 transform" x-transition:leave-start="opacity-70 scale-100 translate-y-0" x-transition:leave-end="opacity-0 scale-90 translate-y-1">
                 
                  <span class="font-bold block text-2xl mb-3">Vpišite vprašanje</span>
                  
                  <input type="text" id="vprasanje_input" class="bg-gray-50 border border-gray-300 text-gray-900 text-xl rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
  
                  
                  <div class="text-right space-x-5 mt-5">
                      <button type="button" @click="showModal = !showModal" class="px-4 py-2 text-sm bg-white rounded-xl border transition-colors duration-150 ease-linear border-gray-200 text-gray-500 focus:outline-none focus:ring-0 font-bold hover:bg-gray-50 focus:bg-indigo-50 focus:text-indigo" onclick="delete_input()">Cancel</button>
                      <button type="button" @click="showModal = !showModal" class="px-4 py-2 text-sm bg-white rounded-xl border transition-colors duration-150 ease-linear border-gray-200 text-gray-500 focus:outline-none focus:ring-0 font-bold hover:bg-gray-50 focus:bg-indigo-50 focus:text-indigo" onclick="add_id_to_input();vpis_vprasanja()">OK</button>
                  </div>
              </div>
          </div>
      </div>
  
     
  </div>

  <div class="m-1">
      <div x-data="{ showModal : false }">
         
          <button type="button" @click="showModal = !showModal" class="invisible" id="gumb1234">Open Modal</button>
  
          
          <div x-show="showModal" class="fixed text-gray-500 flex items-center justify-center overflow-auto z-50 bg-indigo-600 bg-opacity-5 left-0 right-0 top-0 bottom-0" x-transition:enter="transition ease duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition ease duration-300" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
              
              <div x-show="showModal" class="bg-white rounded-xl shadow-2xl p-6 sm:w-3/12 mx-10" @click.away="showModal = false;delete_input()" x-transition:enter="transition ease duration-100 transform" x-transition:enter-start="opacity-0 scale-70 translate-y-1" x-transition:enter-end="opacity-80 scale-100 translate-y-0" x-transition:leave="transition ease duration-100 transform" x-transition:leave-start="opacity-70 scale-100 translate-y-0" x-transition:leave-end="opacity-0 scale-90 translate-y-1">
                 
                  <span class="font-bold block text-2xl mb-3">Vpišite vprašanje</span>
                  
                  <input type="text" id="vprasanje_input2" class="bg-gray-50 border border-gray-300 text-gray-900 text-xl rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" >
                     <span class="font-bold block text-2xl mb-3">Vpišite vrednost po meri</span>
                     <input type="text" id="input_placeholder" class="bg-gray-50 border border-gray-300 text-gray-900 text-xl rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" >
  
                  
                  <div class="text-right space-x-5 mt-5">
                      <button type="button" @click="showModal = !showModal" class="px-4 py-2 text-sm bg-white rounded-xl border transition-colors duration-150 ease-linear border-gray-200 text-gray-500 focus:outline-none focus:ring-0 font-bold hover:bg-gray-50 focus:bg-indigo-50 focus:text-indigo" onclick="delete_input()">Cancel</button>
                      <button type="button" @click="showModal = !showModal" class="px-4 py-2 text-sm bg-white rounded-xl border transition-colors duration-150 ease-linear border-gray-200 text-gray-500 focus:outline-none focus:ring-0 font-bold hover:bg-gray-50 focus:bg-indigo-50 focus:text-indigo" onclick="add_id_to_input();vpis_vprasanja()">OK</button>
                  </div>
              </div>
          </div>
      </div>
    </div>


<?php
include ("footer.php");
?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js " integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0 " crossorigin="anonymous "></script>
    <script src="../js/premik_strani.js"></script>
    <script src="../js/index.js"></script>
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>  
</body>

</html>
