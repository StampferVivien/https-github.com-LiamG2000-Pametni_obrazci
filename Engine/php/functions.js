function odpriFile(id){
  id = id * 1;
  window.location.href = "../php/vprasanja.php?id=" + id + "";
}

var polje_inputov_id = [];
var polje_inputov_value = [];
var content_html_edit;

function test(){

  let odgovori = document.getElementById("odgovori").value;
  
  let poljeString = document.getElementById("poljeString").value;
  let besedilo = document.getElementById("besedilo").value;
  let vprasanja = document.getElementById("vprasanja").value;
  
  let besediloDecoded = atob(besedilo);
  let vprasanja1 = JSON.parse(vprasanja);
  let odgovori1 = JSON.parse(odgovori);
  let polje_string = atob(poljeString)
  content_html = atob(besedilo) 

  console.log("vprasanja1 " + vprasanja1);
  console.log("odgovori1 " +odgovori1);
  console.log("polje_string " +polje_string);
  console.log("content_html " +content_html);
  var content_html_KoDela = content_html.replace(/Ä/g, "č").replace(/Å¾/g, "ž").replace(/Å½/g, "Ž").replace(/Å½/g, "Ž").replace(/Å¡/g, "š").replace(/Å /g, "Š").replace(/&scaron;/g, "š").replace(/&Scaron;/g, "Š");
  var polje_string_KoDela = polje_string.replace(/Ä/g, "č").replace(/Å¾/g, "ž").replace(/Å½/g, "Ž").replace(/Å½/g, "Ž").replace(/Å¡/g, "š").replace(/Å /g, "Š").replace(/&scaron;/g, "š").replace(/&Scaron;/g, "Š");
  console.log("content_html_KoDela " +content_html_KoDela);
  console.log("polje_string_KoDel " +polje_string_KoDela);
  const str = $(`<div id="parent"> ${polje_string_KoDela} </div>`);
  for(var i=1;i<vprasanja1.length + 1;i++){
    polje_inputov_id[i-1] = str.find(':nth-child(' + i + ')').attr('id');
    if(str.find(':nth-child(' + i + ')').attr('value') == "emso"){
      polje_inputov_value[i-1] = "emso";
    }else if (str.find(':nth-child(' + i + ')').attr('value') == "Posta"){
      polje_inputov_value[i-1] = "Posta";
    }else{
      polje_inputov_value[i-1] = str.find(':nth-child(' + i + ')').attr('value')
    }
  } 
  for(var j=0;j<vprasanja1.length;j++){
  var n = content_html_edit;
  if(j==0){
    content_html_edit = content_html_KoDela.replace(`<input id="${polje_inputov_id[j]}" style="border-radius: 8px; border: 2px solid black;" readonly="readonly" type="text" value="${polje_inputov_value[j]}">`, `${odgovori1[j]}`);
  }
  else{
    content_html_edit = n.replace(`<input id="${polje_inputov_id[j]}" style="border-radius: 8px; border: 2px solid black;" readonly="readonly" type="text" value="${polje_inputov_value[j]}">`, `${odgovori1[j]}`);
  }
  }
  document.getElementById("div_pdf").innerHTML =  content_html_edit;
}

function demoFromHTML(){

    var element = document.getElementById('div_pdf');
    var clonedElement = element.cloneNode(true);
    $(clonedElement).css("display", "block");

    var opt = {
        margin:       0.5,
        filename:     'dokument.pdf',
        image:        { type: 'jpeg', quality: 0.98 },
        html2canvas:  { scale: 2 },
        jsPDF:        { unit: 'in', format: 'letter', orientation: 'portrait' }
    };
    html2pdf().set(opt).from(clonedElement).save();
    console.log("clonedElement " + clonedElement);
}

function test1(){
  let poljeString = document.getElementById("poljeString").value;

  if(poljeString != null){
    console.log("Lahko delam");
    test();
    demoFromHTML();
  }
}

function preusmeri(){
alert("Pripravljamo Vaš dokument");
setTimeout(() => {
document.getElementById("backBtn").click()}, 1000);
}