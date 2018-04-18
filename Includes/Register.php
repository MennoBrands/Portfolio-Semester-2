<?php

/* Register user functie */

require_once('Connection.php');

$username = $_POST['username'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

if (isset($_POST["username"], $_POST["password"])) {

    $UserInfo = $conn->prepare("INSERT INTO user (`Username`, `Password`) VALUES (:Username, :Password)");
    $UserInfo->bindParam(":Username", $username);
    $UserInfo->bindParam(":Password", $password);
    $UserInfo -> execute();

    echo '<script type="text/javascript">alert("Register Succeeded.");';
    echo 'window.location = "../CMS/LoginPage.html";';
    echo '</script>';

}
else {
    echo '<script type="text/javascript">alert("Please fill in all the fields.");';
    echo 'window.location = "../CMS/RegisterPage.html";';
    echo '</script>';
}
?>