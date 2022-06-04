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
  const content_html_edit = content_html.replaceAll('<input style="border-radius: 8px; border: 2px solid black;" readonly="readonly" type="text" value="EM&Scaron;O">', '');
  console.log(content_html_edit);
  tinymce.get('text_editor').setContent(`${content_html_edit}`);
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
