function drawItems() {
    document.getElementById("simpleGUI").onclick = null;
    var items = document.getElementsByClassName("h_item");
    var evt = document.createEvent("MouseEvents");
    evt.initMouseEvent("click", true, true, window,
        0, 0, 0, 0, 0, false, false, false, false, 0, null);
    for (var i = 1; i < 17; i++) {
        items[i].dispatchEvent(evt);
    }
}

document.getElementById("simpleGUI").onclick = function(){
drawItems();
}