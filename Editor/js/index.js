var inputValue = "123";
const replaced = "";  
var i = 0;
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
  const content_html_edit = content_html.replaceAll('<input style="border-radius: 8px; border: 2px solid black;" readonly="readonly" type="text" value="EM&Scaron;O">', '(EMŠO)');
  const content_html_edit2 = content_html_edit.replaceAll('<input style="border-radius: 8px; border: 2px solid black;" readonly="readonly" type="text" value="Ime">', '(Ime)');
  const content_html_edit3 = content_html_edit2.replaceAll('<input style="border-radius: 8px; border: 2px solid black;" readonly="readonly" type="text" value="Priimek">', '(Priimek)');
  const content_html_edit4 = content_html_edit3.replaceAll('<input style="border-radius: 8px; border: 2px solid black;" readonly="readonly" type="text" value="Datum">', '(Datum)');
  const content_html_edit5 = content_html_edit4.replaceAll('<input style="border-radius: 8px; border: 2px solid black;" readonly="readonly" type="text" value="Po&scaron;ta">', '(Pošta)');
  const content_html_edit6 = content_html_edit5.replaceAll('<input style="border-radius: 8px; border: 2px solid black;" readonly="readonly" type="text" value="Kraj">', '(Kraj)');
  const content_html_edit7 = content_html_edit6.replaceAll('<input style="border-radius: 8px; border: 2px solid black;" readonly="readonly" type="text" value="Država">', '(Država)');
  const content_html_edit8 = content_html_edit7.replaceAll('<input style="border-radius: 8px; border: 2px solid black;" readonly="readonly" type="text" value="Telefon">', '(Telefon)');
  const content_html_edit9 = content_html_edit8.replaceAll('<input style="border-radius: 8px; border: 2px solid black;" readonly="readonly" type="text" value="Ime">', '(Ime)');
  console.log(content_html_edit9);
  tinymce.get('text_editor').setContent(`${content_html_edit9}`);
}

function delete_input(){
content_html = tinyMCE.get('text_editor').getContent();
content_html_edit = content_html.replaceAll('<input style="border-radius: 8px; border: 2px solid black;" readonly="readonly" type="text" value="EM&Scaron;O">', "");
console.log(content_html_edit);
tinymce.get('text_editor').setContent(`${content_html_edit}`);
}

function add_id_to_input(){
content_html = tinyMCE.get('text_editor').getContent();
content_html_edit = content_html.replaceAll('<input style="border-radius: 8px; border: 2px solid black;" readonly="readonly" type="text" value="EM&Scaron;O">', `<input style="border-radius: 8px; border: 2px solid black;" readonly="readonly" type="text" value="EM&Scaron;O" id='${i}'>`);
console.log(content_html_edit);
tinymce.get('text_editor').setContent(`${content_html_edit}`);
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
