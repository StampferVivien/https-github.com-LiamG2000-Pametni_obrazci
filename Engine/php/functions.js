function odpriFile(id){
    console.log(id + " id was clicked");
    id = id * 1;
    window.location.href = "../php/vprasanja.php?id=" + id + "";
}

function test(){
    console.log("test");
    let poljeString = document.getElementById("poljeString").value;
    let besedilo = document.getElementById("besedilo").value;
    let vprasanja = document.getElementById("vprasanja").value;
    let odgovori = document.getElementById("odgovori").value;
    let vprasanja1 = JSON.parse(vprasanja);
    let odgovori1 = JSON.parse(odgovori);

    console.log(atob(poljeString));
    console.log(atob(besedilo));
    console.log(vprasanja1);
    console.log(odgovori1);
   
}
