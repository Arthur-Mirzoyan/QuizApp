function isValidChange(x) {
    let checkboxes = document.getElementsByClassName("checkboxes");
    let boxes = document.getElementsByClassName("box");
    let pair = x - 1;
    let box = Math.floor(x / 2);

    if (x % 2 == 0) pair = x + 1;
    
    if (checkboxes[x].checked) {
        checkboxes[pair].checked = false;
        checkboxes[pair].required = false;
        checkboxes[x].required = true;
        
        if (checkboxes[x].checked || checkboxes[pair].checked) boxes[box].style.backgroundColor = "#9eb6f7";
    }
}