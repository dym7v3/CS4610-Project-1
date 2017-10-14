function orderingUp() {
    document.getElementByName("UpDown").values(155);
}
function orderingDown()
{
    document.getElementByName("UpDown").value=0;
}

function empty() {
    var x;
    x = document.getElementById("QuestionContent").value;
    if (x === "") {
        alert("You tried to submit an empty question. Enter a question then click submit.");
        return false;
    };
}