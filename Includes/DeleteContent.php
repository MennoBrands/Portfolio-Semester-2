<?php

/* Delete functie voor content list */

require_once('Security.php');
require_once('Connection.php');

    $UpdateContent = $conn->prepare("DELETE FROM content WHERE id=".$_GET['id']);
    $UpdateContent->execute();

    header('Location:../CMS/ContentList.php');
?>