$(document).ready(function () {

});
window.addEventListener("keyup", myEventHandler);

function myEventHandler(event){
    console.log(event);
    $('#log').html(event.keyCode);
}