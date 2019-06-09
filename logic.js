
//this function gets triggered when the user clicks on a cell
let handleClick = function(event) {
    switch(event.button) {
        case 0:
            console.log("left clicked cell: ", event.target.id);
            retrieveData("left", event.target.id);
            break;
        case 2:
            console.log("right clicked cell: ", event.target.id);
            retrieveData("right", event.target.id);
            break;
        default:
            break;
    }
};

//this function gets triggered when a call to logic.php needs to be made
let retrieveData = function (buttonClicked, cellClicked) {
    let postBody = {};
    postBody.button = buttonClicked;
    postBody.cell = cellClicked;

    fetch("logic.php", {
        method: 'POST',
        mode: 'cors',
        cache: 'no-cache',
        credentials: 'same-origin',
        headers: {
            'Content-Type': 'application/json',
        },
        redirect: 'follow',
        referrer: 'no-referrer',
        body: JSON.stringify(postBody),
    })
        .then(response => response.json())
        .then(response => logicCallback(response))
        .catch(error => console.log(error));
};

//this function gets triggered when the ajax request returns from logic.php
let logicCallback = function (data) {
    console.log("received response: ", data);
};

//bind click events
let cells = document.querySelectorAll('td');
cells.forEach(function(cell) {
    cell.addEventListener("mouseup", handleClick);
});


