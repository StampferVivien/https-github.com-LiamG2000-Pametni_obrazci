document.addEventListener('dragstart', function (event) {
    event.dataTransfer.setData('Text', event.target.innerHTML);
    //event.dataTransfer.setData('Text', prozi());
    //prozi();
    
  });


 function prozi(){
    let nekaj = document.getElementById("text");
    var input = document.createElement("input");
    input.type = "text";
    input.className = "css-class-name"; // set the CSS class
    input.setAttribute("placeholder", "Vnosno polje")
    nekaj.appendChild(input); // put it into the DOM
 }