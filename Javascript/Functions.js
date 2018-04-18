/* Check of je het echt wil deleten */
function check(id) {
    var answer = confirm("Are you sure?")
    if (answer) {
        window.location.replace('../Includes/DeleteContent.php?id=' + id );
    }
    else {
        window.location.replace('ContentList.php');
    }
}