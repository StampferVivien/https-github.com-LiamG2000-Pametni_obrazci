function odpriFile(id){
    console.log(id + " id was clicked");
    id = id * 1;
    window.location.href = "../php/vprasanja.php?id=" + id + "";
}