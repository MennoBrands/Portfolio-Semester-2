<?php
    require_once('../Includes/Connection.php');

    /* selecteer alle informatie die bij deze opdracht hoort */

    $Title = "";
    $Text = "";
    $Category = "";

    $assignmentinfo = $conn->prepare("SELECT Title, Category, Text, FilePath FROM content WHERE id=".$_GET['id']);
    $assignmentinfo -> execute();

    $assignmentinfo->bindColumn(1, $dbTitle);
    $assignmentinfo->bindColumn(2, $dbCategory);
    $assignmentinfo->bindColumn(3, $dbText);
    $assignmentinfo->bindColumn(4, $dbFile);


while ($assignmentinfo->fetch()) {
    $Title = $dbTitle;
    $Category = $dbCategory;
    $Text = $dbText;
    $FilePath = $dbFile;
}

$FullPath = "../" . $FilePath;

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Portfolio</title>
    <meta name="description" content="Portfolio Menno Brands">
    <meta name="author" content="Menno Brands">
    <link rel="shortcut icon" type="image/png" href=""/>
    <link rel="stylesheet" type="text/css" href="../CSS/Main.css">
</head>
<nav>

    <!-- Navigatie heb ik in dit bestand gezet omdat anders alle inmage padden niet meer klopten -->
    <?php
    $page=$Category;
    ?>

    <section class="Navlogo" id="front">
        <section class="Navlogon">
            <a href="../Index.html">
                <img src="../Images/nav/navMennoBrandsBlack.png" alt="UXU button">
            </a>
        </section>
    </section>

    <section class="Navlogo" id="back">
        <section class="Navlogon">
            <a href="../Index.html">
                <img src="../Images/nav/navMennoBrands.png" alt="UXU button">
            </a>
        </section>
    </section>

    <section class="Navlogin" id="front">
        <section class="Navlogon">
            <a href="../CMS/LoginPage.html">
                <img src="../Images/nav/Login.png" alt="Login button">
            </a>
        </section>
    </section>

    <section class="Navlogin" id="back">
        <section class="Navlogon">
            <a href="../CMS/LoginPage.html">
                <img src="../Images/nav/Loginblack.png" alt="Login button">
            </a>
        </section>
    </section>

    <section class="Navbuttons" id="front">
        <section class="Navbutton">
            <a href="../ded.php">
                <?php if($page == "ded") {
                    ?>
                    <img src="../Images/nav/navdedblack.png" alt="DED button">
                    <?php
                }
                else {

                    ?>
                    <img src="../Images/nav/navded.png" alt="DED button">
                <?php } ?>
            </a>
        </section>

        <section class="Navbutton">
            <a href="../sco.php">
                <?php if($page == "sco") {
                    ?>
                    <img src="../Images/nav/navscoblack.png" alt="SCO button">
                    <?php
                }
                else {

                    ?>
                    <img src="../Images/nav/navsco.png" alt="SCO button">
                <?php } ?>
            </a>
        </section>

        <section class="Navbutton">
            <a href="../uxu.php">
                <?php if($page == "uxu") {
                    ?>
                    <img src="../Images/nav/navuxublack.png" alt="UXU button">
                    <?php
                }
                else {

                    ?>
                    <img src="../Images/nav/navuxu.png" alt="UXU button">
                <?php } ?>
            </a>
        </section>

        <section class="Navbutton">
            <a href="../pt.php">
                <?php if($page == "pt") {
                    ?>
                    <img src="../Images/nav/navptblack.png" alt="PT button">
                    <?php
                }
                else {

                    ?>
                    <img src="../Images/nav/navpt.png" alt="PT button">
                <?php } ?>
            </a>
        </section>

        <section class="Navbutton">
            <a href="../ppo.php">
                <?php if($page == "ppo") {
                    ?>
                    <img src="../Images/nav/navppoblack.png" alt="PPO button">
                    <?php
                }
                else {

                    ?>
                    <img src="../Images/nav/navppo.png" alt="PPO button">
                <?php } ?>
            </a>
        </section>
    </section>

    <section class="Navbuttons" id="back">
        <section>
            <a href="../ded.php">
                <img src="../Images/nav/navdedblack.png" alt="DED button">
            </a>
        </section>

        <section>
            <a href="../sco.php">
                <img src="../Images/nav/navscoblack.png" alt="SCO button">
            </a>
        </section>

        <section>
            <a href="../uxu.php">
                <img src="../Images/nav/navuxublack.png" alt="UXU button">
            </a>
        </section>

        <section>
            <a href="../pt.php">
                <img src="../Images/nav/navptblack.png" alt="PT button">
            </a>
        </section>

        <section>
            <a href="../ppo.php">
                <img src="../Images/nav/navppoblack.png" alt="PPO button">
            </a>
        </section>
    </section>
</nav>
<body>
    <main>

        <!-- content aanroepen -->


        <section class="PDFButtons" id="front">
            <section class="PDFButton">
                <a target="_blank" href=<?php echo $FullPath;?>>
                    <img src="../Images/pdfgray.png" alt="PDF button">
                </a>
            </section>
        </section>

        <section class="PDFButtons" id="back">
            <section class="PDFButton">
                <a target="_blank" href=<?php echo $FullPath;?>>
                    <img src="../Images/pdfblack.png" alt="PDF button">
                </a>
            </section>
        </section>

        <section id="AssignmentContainerTitle">
            <div id="AssignmentTitle">
                <?php

                echo "<h1>" . $Title . "</h1>";

                ?>
            </div>
        </section>

        <section id="AssignmentContainer">
            <div id="AssignmentText">
                <?php

                    echo  $Text;

                ?>
            </div>
        </section>
    </main>
</body>
</html>