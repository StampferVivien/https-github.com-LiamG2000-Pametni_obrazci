var inputValue = "";
const replaced = "";  
var i = 0;
var polje_string = ""; 
var polje_inputov_id = [];
var polje_inputov_value = [];
var polje_vprasanj = [];
var content_html_edit;
var content_html_edit9;
var json_file;
var nekaj = false;
var input_pomeri = false;
var vprasanje_pomeri = false;
var event_value = "";
var placeholder;
var content_html = null;
let besedilo = document.getElementById("besedilo");
let besediloEncoded = document.getElementById("besediloIzBaze").value;
let vprasanjaEncoded = document.getElementById("vprasanjaIzBaze").value;
let StringInputov = document.getElementById("StringInputov").value
var i;

tinymce.init({
  selector: '#text_editor',
  menubar:false,
  statusbar: false,
  plugins: 'autoresize',
  height : "600",
  init_instance_callback : "myCustomInitInstance",
  init_instance_callback: function(editor) {

    console.log("StringInputov" + atob(StringInputov));
    if(besediloEncoded != ""){
      var arrayVprasanj = vprasanjaEncoded.slice(1, -1).split(",").map(function(item) {
        return item.trim().slice(1, -1);
      });
      const regex = /id='(\d+)'/g;
      let maxId = -Infinity;
      let match;

      while ((match = regex.exec(atob(StringInputov))) !== null) {
      const id = parseInt(match[1]);
      if (!isNaN(id) && id > maxId) {
      maxId = id;
      }
      }

      i = maxId +1;
      polje_vprasanj = [...arrayVprasanj];
      polje_string = atob(StringInputov);
      // Create a new DOMParser instance
      var parser = new DOMParser();

      // Parse the HTML code into a document
      var doc = parser.parseFromString(atob(besediloEncoded), 'text/html');

      // Convert the input elements back into HTML elements
      var inputElements = doc.querySelectorAll('input');
      inputElements.forEach(function(element) {
      var newElement = document.createElement('input');
      newElement.setAttribute('id', element.id);
      newElement.setAttribute('style', element.getAttribute('style'));
      newElement.setAttribute('readonly', 'readonly');
      newElement.setAttribute('type', element.getAttribute('type'));
      newElement.setAttribute('value', element.getAttribute('value'));
      element.parentNode.replaceChild(newElement, element);
      });

      // Get the modified HTML code
      var modifiedHtmlCode = doc.documentElement.innerHTML;
      
      // Set the modified HTML code as the content of TinyMCE
      tinymce.get('text_editor').setContent(modifiedHtmlCode)
      
     }
    editor.on('drop', function(e) {
    if(nekaj == true){
      if(input_pomeri == true){
        input_pomeri = false;
        document.getElementById("gumb1234").click();
        
      }else{
        document.getElementById("gumb123").click();
      }
       nekaj=false;
    }
    });
    editor.on('change', function(e) {
      content_html = tinyMCE.get('text_editor').getContent();
      besedilo.setAttribute("value", content_html);
      console.log("content_html " +content_html);
      console.log("besediloEncoded " + besediloEncoded);
      });
      editor.addCommand('myInsideFunction', function () {
        content_html = tinyMCE.get('text_editor').getContent();
        besedilo.setAttribute("value", content_html);
        console.log("content_html " +content_html);
      });
  },
  plugins: 'image paste',
  images_file_types: '',
  onchange_callback : "myCustomOnChangeHandler"
});
function myCustomOnChangeHandler(inst) {
  alert("Some one modified something");
  alert("The HTML is now:" + inst.getBody().innerHTML);
}

function get_editor_content() {
  console.debug(tinyMCE.activeEditor.getContent());
  content_html = tinyMCE.get('text_editor').getContent();
}

function set_editor_content(){
  const str = $(`<div id="parent"> ${polje_string} </div>`);
  for(i=1;i<10;i++){
    polje_inputov_id[i-1] = str.find(':nth-child(' + i + ')').attr('id');
    if(str.find(':nth-child(' + i + ')').attr('value') == "emso"){
      polje_inputov_value[i-1] = "emso";
    }else if (str.find(':nth-child(' + i + ')').attr('value') == "Posta"){
      polje_inputov_value[i-1] = "Posta";
    }else{
      polje_inputov_value[i-1] = str.find(':nth-child(' + i + ')').attr('value')
    }
    
  } 
  for(var j=0;j<10;j++){
  var n = content_html_edit;
  if(j==0){
    content_html_edit = content_html.replace(`<input id="${polje_inputov_id[j]}" style="border-radius: 8px; border: 2px solid black;" readonly="readonly" type="text" value="${polje_inputov_value[j]}">`, `${polje_vprasanj[j]}`);
  }else{
    content_html_edit = n.replace(`<input id="${polje_inputov_id[j]}" style="border-radius: 8px; border: 2px solid black;" readonly="readonly" type="text" value="${polje_inputov_value[j]}">`, `${polje_vprasanj[j]}`);
  }
 
  console.log(content_html_edit9);
  
  }
  console.log("AAAAAAAAAAAA" + content_html_edit);
  tinymce.get('text_editor').setContent(`${content_html_edit}`);
}

function delete_input(){
  content_html = tinyMCE.get('text_editor').getContent();
  const content_html_edit = content_html.replaceAll('<input style="border-radius: 8px; border: 2px solid black;" readonly="readonly" type="text" value="emso">', '');
  const content_html_edit2 = content_html_edit.replaceAll('<input style="border-radius: 8px; border: 2px solid black;" readonly="readonly" type="text" value="Ime">', '');
  const content_html_edit3 = content_html_edit2.replaceAll('<input style="border-radius: 8px; border: 2px solid black;" readonly="readonly" type="text" value="Priimek">', '');
  const content_html_edit4 = content_html_edit3.replaceAll('<input style="border-radius: 8px; border: 2px solid black;" readonly="readonly" type="text" value="Datum">', '');
  const content_html_edit5 = content_html_edit4.replaceAll('<input style="border-radius: 8px; border: 2px solid black;" readonly="readonly" type="text" value="Posta">', '');
  const content_html_edit6 = content_html_edit5.replaceAll('<input style="border-radius: 8px; border: 2px solid black;" readonly="readonly" type="text" value="Kraj">', '');
  const content_html_edit7 = content_html_edit6.replaceAll('<input style="border-radius: 8px; border: 2px solid black;" readonly="readonly" type="text" value="Drzava">', '');
  const content_html_edit8 = content_html_edit7.replaceAll('<input style="border-radius: 8px; border: 2px solid black;" readonly="readonly" type="text" value="Telefon">', '');
  content_html_edit9 = content_html_edit8.replaceAll(`<input style="border-radius: 8px; border: 2px solid black;" readonly="readonly" type="text" value="${event_value}">`, '');
 
tinymce.get('text_editor').setContent(`${content_html_edit9}`);

}

function add_id_to_input(){
  console.log(event_value);
  placeholder = document.getElementById("input_placeholder").value
  content_html = tinyMCE.get('text_editor').getContent();
  const content_html_edit = content_html.replaceAll('<input style="border-radius: 8px; border: 2px solid black;" readonly="readonly" type="text" value="emso">', `<input style="border-radius: 8px; border: 2px solid black;" readonly="readonly" type="text" value="emso" id='${i}'>`);
  const content_html_edit2 = content_html_edit.replaceAll('<input style="border-radius: 8px; border: 2px solid black;" readonly="readonly" type="text" value="Ime">', `<input style="border-radius: 8px; border: 2px solid black;" readonly="readonly" type="text" value="Ime" id='${i}'>`);
  const content_html_edit3 = content_html_edit2.replaceAll('<input style="border-radius: 8px; border: 2px solid black;" readonly="readonly" type="text" value="Priimek">', `<input style="border-radius: 8px; border: 2px solid black;" readonly="readonly" type="text" value="Priimek" id='${i}'>`);
  const content_html_edit4 = content_html_edit3.replaceAll('<input style="border-radius: 8px; border: 2px solid black;" readonly="readonly" type="text" value="Datum">', `<input style="border-radius: 8px; border: 2px solid black;" readonly="readonly" type="text" value="Datum" id='${i}'>`);
  const content_html_edit5 = content_html_edit4.replaceAll('<input style="border-radius: 8px; border: 2px solid black;" readonly="readonly" type="text" value="Posta">', `<input style="border-radius: 8px; border: 2px solid black;" readonly="readonly" type="text" value="Posta" id='${i}'>`);
  const content_html_edit6 = content_html_edit5.replaceAll('<input style="border-radius: 8px; border: 2px solid black;" readonly="readonly" type="text" value="Kraj">', `<input style="border-radius: 8px; border: 2px solid black;" readonly="readonly" type="text" value="Kraj" id='${i}'>`);
  const content_html_edit7 = content_html_edit6.replaceAll('<input style="border-radius: 8px; border: 2px solid black;" readonly="readonly" type="text" value="Drzava">', `<input style="border-radius: 8px; border: 2px solid black;" readonly="readonly" type="text" value="Drzava" id='${i}'>`);
  const content_html_edit8 = content_html_edit7.replaceAll('<input style="border-radius: 8px; border: 2px solid black;" readonly="readonly" type="text" value="Telefon">', `<input style="border-radius: 8px; border: 2px solid black;" readonly="readonly" type="text" value="Telefon" id='${i}'>`);
  content_html_edit9 = content_html_edit8.replaceAll(`<input style="border-radius: 8px; border: 2px solid black;" readonly="readonly" type="text" value="${event_value}">`, `<input style="border-radius: 8px; border: 2px solid black;" readonly="readonly" type="text" value="${placeholder}" id='${i}'>`);
  
tinymce.get('text_editor').setContent(`${content_html_edit9}`);
  if(event_value != ""){
    console.log("1");
    polje_string += `<input value='${placeholder}' style="border-radius: 8px; border: 2px solid black;" readonly>`;
  }else{
    console.log("2");
  	polje_string += `<input value='${inputValue}' style='border-radius: 8px; border: 2px solid black;' readonly>`;
  }
  
  const content_input_1 = polje_string.replaceAll("<input value='emso' style='border-radius: 8px; border: 2px solid black;' readonly>", `<input value='emso' style="border-radius: 8px; border: 2px solid black;" readonly="readonly" type="text"  id='${i}'>`);
  const content_input_2  = content_input_1.replaceAll("<input value='Ime' style='border-radius: 8px; border: 2px solid black;' readonly>", `<input value='Ime' style="border-radius: 8px; border: 2px solid black;" readonly="readonly" type="text" id='${i}'>`);
  const content_input_3  = content_input_2.replaceAll("<input value='Priimek' style='border-radius: 8px; border: 2px solid black;' readonly>", `<input value='Priimek' style="border-radius: 8px; border: 2px solid black;" readonly="readonly" type="text" id='${i}'>`);
  const content_input_4  = content_input_3.replaceAll("<input value='Datum' style='border-radius: 8px; border: 2px solid black;' readonly>", `<input value='Datum' style="border-radius: 8px; border: 2px solid black;" readonly="readonly" type="text"  id='${i}'>`);
  const content_input_5  = content_input_4.replaceAll("<input value='Posta' style='border-radius: 8px; border: 2px solid black;' readonly>", `<input value='Posta' style="border-radius: 8px; border: 2px solid black;" readonly="readonly" type="text" id='${i}'>`);
  const content_input_6  = content_input_5.replaceAll("<input value='Kraj' style='border-radius: 8px; border: 2px solid black;' readonly>", `<input value='Kraj' style="border-radius: 8px; border: 2px solid black;" readonly="readonly" type="text" id='${i}'>`);
  const content_input_7  = content_input_6.replaceAll("<input value='Drzava' style='border-radius: 8px; border: 2px solid black;' readonly>", `<input value='Drzava' style="border-radius: 8px; border: 2px solid black;" readonly="readonly" type="text" id='${i}'>`);
  const content_input_8  = content_input_7.replaceAll("<input value='Telefon' style='border-radius: 8px; border: 2px solid black;' readonly>", `<input value='Telefon' style="border-radius: 8px; border: 2px solid black;" readonly="readonly" type="text" id='${i}'>`);
  const content_input_9 = content_input_8.replaceAll(`<input value='${placeholder}' style="border-radius: 8px; border: 2px solid black;" readonly>`, `<input value='${placeholder}' style="border-radius: 8px; border: 2px solid black;" readonly="readonly" type="text" id='${i}'>`);
  polje_string = content_input_9;
  console.log("polje_string " + polje_string);
i++;
event_value = "";
}

var shouldHandleKeyDown = true;
function dragStart(event) {
  event.dataTransfer.setData("text/html", event.currentTarget.id);
  inputValue = event.currentTarget.id;
  
}

var text_editor = document.getElementById('text_editor');
document.addEventListener('dragstart', function (event) {
  console.log(event.target.id)
  if(event.target.id == "input_8"){
    input_pomeri = true;
    event_value = event.target.value
    vprasanje_pomeri = true;
    event.dataTransfer.setData("text/html", `<input value='${event.target.value}' style='border-radius: 8px; border: 2px solid black;' readonly>`);
  }else{
    event.dataTransfer.setData("text/html", `<input value='${inputValue}' style='border-radius: 8px; border: 2px solid black;' readonly>`);
  }
  
  nekaj = true;
});

function vpis_vprasanja(){
  if(vprasanje_pomeri == true){
    vprasanje_pomeri = false;
    var vpranaje2 = document.getElementById("vprasanje_input2").value;
    polje_vprasanj[polje_vprasanj.length] = vpranaje2;
    tinymce.activeEditor.execCommand('myInsideFunction');
  }else{
    var vpranaje = document.getElementById("vprasanje_input").value;
    polje_vprasanj[polje_vprasanj.length] = vpranaje;
    tinymce.activeEditor.execCommand('myInsideFunction');
  }
  

  console.log("text_editor " + tinyMCE.get('text_editor').getContent()); //show all editor content as sting

  const container = document.createElement('div');//------
  container.innerHTML = tinyMCE.get('text_editor').getContent();
  const inputs = container.querySelectorAll("input[id]");
  const idArray = [];
  for (let i = 0; i < inputs.length; i++) {
    const input = inputs[i];
    const id = input.id;
    idArray.push(id);
  }
  console.log(idArray);//take every id from every input and save it in array

  const result = [];//primerja id vsakega inputa z vprašanji vsakega inputa, če je kakšen input bil odstranjen ta zanka zagotovi da je bilo odstranjeno tudi vprašanje.
  for (let i = 0; i < idArray.length; i++) {
    const index = parseInt(idArray[i]);
    const str = polje_vprasanj[index];
    result.push(str);
  }
  console.log("result " + result);
  //----
  var contentIds = [];
var parser = new DOMParser();
var doc = parser.parseFromString(content_html, "text/html");
var inputElements = doc.querySelectorAll("input");
inputElements.forEach(function(element) {
  var id = element.getAttribute("id");
  contentIds.push(id);
});

// Remove inputs in polje_string that do not have matching IDs
var output_string = polje_string;
var startIndex = 0;
var endIndex = 0;

while (startIndex !== -1 && endIndex !== -1) {
  startIndex = output_string.indexOf("<input", endIndex);
  if (startIndex !== -1) {
    endIndex = output_string.indexOf(">", startIndex);
    if (endIndex !== -1) {
      var inputElement = output_string.substring(startIndex, endIndex + 1);
      var inputId = inputElement.match(/id=['"]([^'"]+)['"]/);
      if (inputId && inputId[1] && contentIds.includes(inputId[1])) {
        continue;
      }
      output_string = output_string.replace(inputElement, "");
      endIndex = startIndex;
    }
  }
}


//-----
  json_file = JSON.stringify(result);
  console.log("idArray "+ idArray)
  console.log("polje vprašanj" + polje_vprasanj);
  console.log("json_file" + json_file);
  console.log("polje_string" + polje_string);
  console.log("content_html" + content_html);
  console.log("output_string" + output_string);

  let vprasanja = document.getElementById("vprasanja");
  vprasanja.setAttribute("value", json_file);
  let inputString = document.getElementById("poljeString");
  inputString.setAttribute("value", output_string);
  besedilo.setAttribute("value", content_html);
  
  
 
  
  }

  const button = document.getElementById("myButton123");
  button.addEventListener("click", vpis_vprasanja);


  window.onload = function() {
    var desiredPosition = 1000; // Adjust the desired scroll position
    
    window.scrollTo({
      top: desiredPosition,
      behavior: 'smooth' // Optional: Add smooth scrolling effect
    });


  }

