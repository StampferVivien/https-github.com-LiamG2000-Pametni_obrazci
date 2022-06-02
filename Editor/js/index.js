var inputValue = "123";
const replaced = "";  
tinymce.init({
  selector: '#text_editor',
    height: 500,
    setup:function(ed) {
    ed.on('change', function(e) {
  
    });
  }
    
});
var content_html = null;
function get_editor_content() {
  
  // Get the HTML contents of the currently active editor
  console.debug(tinyMCE.activeEditor.getContent());
  content_html = tinyMCE.get('text_editor').getContent();
  console.log(content_html);
}
function set_editor_content(){
  content_html.replaceAll('input', 'aa');
  const content_html_edit = content_html.replaceAll('<input style="border-radius: 8px; border: 2px solid black;" readonly="readonly" type="text" value="', '');
  console.log(content_html_edit);
  tinymce.get('text_editor').setContent(`${content_html_edit}`);


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

