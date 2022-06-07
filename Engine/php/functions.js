function odpriFile(id){
    console.log(id + " id was clicked");
    id = id * 1;
    window.location.href = "../php/vprasanja.php?id=" + id + "";
}

function test(){
    console.log("TESt");
    let poljeString = document.getElementById("poljeString").value;
    let besedilo = document.getElementById("besedilo").value;
    let vprasanja = document.getElementById("vprasanja").value;
    console.log(atob(poljeString));
    console.log(atob(besedilo));
    console.log(vprasanja);
   
}
