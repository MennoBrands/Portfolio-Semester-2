<?php

/* CMS beveiliging */

session_start();
$type = $_SESSION['Type'];

if ($type == "Admin") {

}
else {
//    echo '<script type="text/javascript">alert("This is a secured, you will be redirected back.");';
    echo '<script type="text/javascript">alert("This is a secured, you will be redirected back.");';
    echo 'window.location = "LoginPage.html";';
    echo '</script>';
}
?>

