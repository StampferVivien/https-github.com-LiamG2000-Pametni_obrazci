document.addEventListener('dragstart', function (event) {
    //event.dataTransfer.setData('Text', event.target.innerHTML);
    //event.dataTransfer.setData('Text', event.target.inneHTML);
    prozi();
    
  });


 function prozi(){
    let nekaj = document.getElementById("text");
    var input = document.createElement("input");
    input.type = "text";
    input.className = "css-class-name"; // set the CSS class
    nekaj.appendChild(input); // put it into the DOM
 }