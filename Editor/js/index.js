var inputValue = "123";
const replaced = "";  
var i = 0;
var polje_string = ""; 
tinymce.init({
  selector: '#text_editor',
  init_instance_callback: function(editor) {
    editor.on('drop', function(e) {
      document.getElementById("gumb123").click();
    });
  }
    
});

var content_html = null;
function get_editor_content() {
  console.debug(tinyMCE.activeEditor.getContent());
  content_html = tinyMCE.get('text_editor').getContent();
  console.log(content_html);
}
function set_editor_content(){
  const polje = [];
  const str = $(`<div id="parent"> ${polje_string} </div>`);
  console.log(str);
  for(var i=1;i<10;i++){
    console.log(str.find(':nth-child(' + i + ')').attr('id'));
    polje[i-1] = str.find(':nth-child(' + i + ')').attr('id');
    console.log(polje);
    
  } 

  const content_html_edit = content_html.replace(`<input id="0" style="border-radius: 8px; border: 2px solid black;" readonly="readonly" type="text" value="EM&Scaron;O">`, '(EMŠO)');
  const content_html_edit2 = content_html_edit.replaceAll('<input style="border-radius: 8px; border: 2px solid black;" readonly="readonly" type="text" value="Ime">', '(Ime)');
  const content_html_edit3 = content_html_edit2.replaceAll('<input style="border-radius: 8px; border: 2px solid black;" readonly="readonly" type="text" value="Priimek">', '(Priimek)');
  const content_html_edit4 = content_html_edit3.replaceAll('<input style="border-radius: 8px; border: 2px solid black;" readonly="readonly" type="text" value="Datum">', '(Datum)');
  const content_html_edit5 = content_html_edit4.replaceAll('<input style="border-radius: 8px; border: 2px solid black;" readonly="readonly" type="text" value="Po&scaron;ta">', '(Pošta)');
  const content_html_edit6 = content_html_edit5.replaceAll('<input style="border-radius: 8px; border: 2px solid black;" readonly="readonly" type="text" value="Kraj">', '(Kraj)');
  const content_html_edit7 = content_html_edit6.replaceAll('<input style="border-radius: 8px; border: 2px solid black;" readonly="readonly" type="text" value="Država">', '(Država)');
  const content_html_edit8 = content_html_edit7.replaceAll('<input style="border-radius: 8px; border: 2px solid black;" readonly="readonly" type="text" value="Telefon">', '(Telefon)');
  const content_html_edit9 = content_html_edit8.replaceAll('<input style="border-radius: 8px; border: 2px solid black;" readonly="readonly" type="text" value="Ime">', '(Ime)');
  console.log(content_html_edit9);
  tinymce.get('text_editor').setContent(`${content_html_edit}`);
}

function delete_input(){
  content_html = tinyMCE.get('text_editor').getContent();
  const content_html_edit = content_html.replaceAll('<input style="border-radius: 8px; border: 2px solid black;" readonly="readonly" type="text" value="EM&Scaron;O">', '');
  const content_html_edit2 = content_html_edit.replaceAll('<input style="border-radius: 8px; border: 2px solid black;" readonly="readonly" type="text" value="Ime">', '');
  const content_html_edit3 = content_html_edit2.replaceAll('<input style="border-radius: 8px; border: 2px solid black;" readonly="readonly" type="text" value="Priimek">', '');
  const content_html_edit4 = content_html_edit3.replaceAll('<input style="border-radius: 8px; border: 2px solid black;" readonly="readonly" type="text" value="Datum">', '');
  const content_html_edit5 = content_html_edit4.replaceAll('<input style="border-radius: 8px; border: 2px solid black;" readonly="readonly" type="text" value="Po&scaron;ta">', '');
  const content_html_edit6 = content_html_edit5.replaceAll('<input style="border-radius: 8px; border: 2px solid black;" readonly="readonly" type="text" value="Kraj">', '');
  const content_html_edit7 = content_html_edit6.replaceAll('<input style="border-radius: 8px; border: 2px solid black;" readonly="readonly" type="text" value="Država">', '');
  const content_html_edit8 = content_html_edit7.replaceAll('<input style="border-radius: 8px; border: 2px solid black;" readonly="readonly" type="text" value="Telefon">', '');
  const content_html_edit9 = content_html_edit8.replaceAll('<input style="border-radius: 8px; border: 2px solid black;" readonly="readonly" type="text" value="Ime">', '');
  console.log(content_html_edit9);
tinymce.get('text_editor').setContent(`${content_html_edit9}`);
console.log("123"+polje_string);
}

function add_id_to_input(){
  content_html = tinyMCE.get('text_editor').getContent();
  const content_html_edit = content_html.replaceAll('<input style="border-radius: 8px; border: 2px solid black;" readonly="readonly" type="text" value="EM&Scaron;O">', `<input style="border-radius: 8px; border: 2px solid black;" readonly="readonly" type="text" value="EM&Scaron;O" id='${i}'>`);
  const content_html_edit2 = content_html_edit.replaceAll('<input style="border-radius: 8px; border: 2px solid black;" readonly="readonly" type="text" value="Ime">', `<input style="border-radius: 8px; border: 2px solid black;" readonly="readonly" type="text" value="Ime" id='${i}'>`);
  const content_html_edit3 = content_html_edit2.replaceAll('<input style="border-radius: 8px; border: 2px solid black;" readonly="readonly" type="text" value="Priimek">', `<input style="border-radius: 8px; border: 2px solid black;" readonly="readonly" type="text" value="Priimek" id='${i}'>`);
  const content_html_edit4 = content_html_edit3.replaceAll('<input style="border-radius: 8px; border: 2px solid black;" readonly="readonly" type="text" value="Datum">', `<input style="border-radius: 8px; border: 2px solid black;" readonly="readonly" type="text" value="Datum" id='${i}'>`);
  const content_html_edit5 = content_html_edit4.replaceAll('<input style="border-radius: 8px; border: 2px solid black;" readonly="readonly" type="text" value="Po&scaron;ta">', `<input style="border-radius: 8px; border: 2px solid black;" readonly="readonly" type="text" value="Po&scaron;ta" id='${i}'>`);
  const content_html_edit6 = content_html_edit5.replaceAll('<input style="border-radius: 8px; border: 2px solid black;" readonly="readonly" type="text" value="Kraj">', `<input style="border-radius: 8px; border: 2px solid black;" readonly="readonly" type="text" value="Kraj" id='${i}'>`);
  const content_html_edit7 = content_html_edit6.replaceAll('<input style="border-radius: 8px; border: 2px solid black;" readonly="readonly" type="text" value="Država">', `<input style="border-radius: 8px; border: 2px solid black;" readonly="readonly" type="text" value="Država" id='${i}'>`);
  const content_html_edit8 = content_html_edit7.replaceAll('<input style="border-radius: 8px; border: 2px solid black;" readonly="readonly" type="text" value="Telefon">', `<input style="border-radius: 8px; border: 2px solid black;" readonly="readonly" type="text" value="Telefon" id='${i}'>`);
  const content_html_edit9 = content_html_edit8.replaceAll('<input style="border-radius: 8px; border: 2px solid black;" readonly="readonly" type="text" value="Ime">', `<input style="border-radius: 8px; border: 2px solid black;" readonly="readonly" type="text" value="Ime" id='${i}'>`);
  console.log(content_html_edit9);
tinymce.get('text_editor').setContent(`${content_html_edit9}`);
  polje_string += `<input value='${inputValue}' style='border-radius: 8px; border: 2px solid black;' readonly>`;
  const content_input_1 = polje_string.replaceAll("<input value='EMŠO' style='border-radius: 8px; border: 2px solid black;' readonly>", `<input value='EMŠO' style="border-radius: 8px; border: 2px solid black;" readonly="readonly" type="text"  id='${i}'>`);
  const content_input_2  = content_input_1.replaceAll("<input value='Ime' style='border-radius: 8px; border: 2px solid black;' readonly>", `<input value='Ime' style="border-radius: 8px; border: 2px solid black;" readonly="readonly" type="text" id='${i}'>`);
  const content_input_3  = content_input_2.replaceAll("<input value='Priimek' style='border-radius: 8px; border: 2px solid black;' readonly>", `<input value='Priimek' style="border-radius: 8px; border: 2px solid black;" readonly="readonly" type="text" id='${i}'>`);
  const content_input_4  = content_input_3.replaceAll("<input value='Datum' style='border-radius: 8px; border: 2px solid black;' readonly>", `<input value='Datum' style="border-radius: 8px; border: 2px solid black;" readonly="readonly" type="text"  id='${i}'>`);
  const content_input_5  = content_input_4.replaceAll("<input value='Pošta' style='border-radius: 8px; border: 2px solid black;' readonly>", `<input value='Pošta' style="border-radius: 8px; border: 2px solid black;" readonly="readonly" type="text" id='${i}'>`);
  const content_input_6  = content_input_5.replaceAll("<input value='Kraj' style='border-radius: 8px; border: 2px solid black;' readonly>", `<input value='Kraj' style="border-radius: 8px; border: 2px solid black;" readonly="readonly" type="text" id='${i}'>`);
  const content_input_7  = content_input_6.replaceAll("<input value='Država' style='border-radius: 8px; border: 2px solid black;' readonly>", `<input value='Država' style="border-radius: 8px; border: 2px solid black;" readonly="readonly" type="text" id='${i}'>`);
  const content_input_8  = content_input_7.replaceAll("<input value='Telefon' style='border-radius: 8px; border: 2px solid black;' readonly>", `<input value='Telefon' style="border-radius: 8px; border: 2px solid black;" readonly="readonly" type="text" id='${i}'>`);
  console.log(content_input_8);
  polje_string = content_input_8;
i++;
}

var shouldHandleKeyDown = true;
function dragStart(event) {
  event.dataTransfer.setData("text/html", event.currentTarget.id);
  console.log(event.currentTarget.id);
  inputValue = event.currentTarget.id;
}

var text_editor = document.getElementById('text_editor');

document.addEventListener('dragstart', function (event) {
  
  event.dataTransfer.setData("text/html", `<input value='${inputValue}' style='border-radius: 8px; border: 2px solid black;' readonly>`);
  
 
  
});
