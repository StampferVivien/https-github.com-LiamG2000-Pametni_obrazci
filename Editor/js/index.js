/*
document.addEventListener('dragstart', function (event) {
    //event.dataTransfer.setData('Text', event.target.innerHTML);
    event.dataTransfer.setData('Text', "")
    //event.dataTransfer.setData('Text/plain', event.target.innerHTML);

});

document.addEventListener('drop', function (event) {
    //prompt("!23");
    prozi();

});
*/

dragStart = (event) => {
    console.log("Started dragging");
    event.dataTransfer.setData("text", event.target.className);
    console.log("Started dragging the element with id: " + event.dataTransfer.getData("Text"));
    dropEvent();
}

dropEvent = (event) => {
    let id = event.dataTransfer.getData("Text");
    console.log("id elementa: " + id)
}

function allowDrop(event) {
    event.preventDefault();
  }
  
  


function myFunction() {
    setEndOfContenteditable(text_editor);
}

function setEndOfContenteditable(contentEditableElement) {
    var range, selection;
    if (document.createRange)//Firefox, Chrome, Opera, Safari, IE 9+
    {
        range = document.createRange();//Create a range (a range is a like the selection but invisible)
        range.selectNodeContents(contentEditableElement);//Select the entire contents of the element with the range
        range.collapse(false);//collapse the range to the end point. false means collapse to end rather than the start
        selection = window.getSelection();//get the selection object (allows you to change selection)
        selection.removeAllRanges();//remove any selections already made
        selection.addRange(range);//make the range you have just created the visible selection
    }
    else if (document.selection)//IE 8 and lower
    {
        range = document.body.createTextRange();//Create a range (a range is a like the selection but invisible)
        range.moveToElementText(contentEditableElement);//Select the entire contents of the element with the range
        range.collapse(false);//collapse the range to the end point. false means collapse to end rather than the start
        range.select();//Select the range (make it the visible selection
    }
}


function prozi() {
    let nekaj = document.getElementById("text_editor");
    var input = document.createElement("input");
    input.type = "text";
    input.className = "css-class-name"; // set the CSS class
    input.setAttribute("placeholder", placeholder()); //set placeholder text 
    nekaj.appendChild(input); // put it into the DOM
}


placeholder = () => {
    let customText = prompt("Vnesi poljubno vprašanje");
    return customText;
}