<?php
require_once('Connection.php');

/* selecteer alle gepaste informatie */

$ContentInfo = $conn->prepare("SELECT ID, Title, Preview_Image_Path FROM content WHERE Category = :Page");
$ContentInfo->bindParam(":Page", $page);
$ContentInfo -> execute();

$ContentInfo->bindColumn(1, $dbID);
$ContentInfo->bindColumn(2, $dbTitle);
$ContentInfo->bindColumn(3, $dbImagePath);

$i=1;

?>

<section id="Container">

<?php

$id = 0;

while ($ContentInfo->fetch()) {
    $ID = $dbID;
    $Title = $dbTitle;
    $ImagePath = $dbImagePath;

    /* Een switch voor de verschillende section blokken 1 t/m 5 */

    switch ($i) {
        case 1:
            ?>

            <section id="block1">
                <div class="blocktitle">
                    <a href="CMS/assignment.php?id=<?php echo $ID?>">
                        <h1><?php echo $Title ?></h1>
                    </a>
                </div>
                <div class="blockbackgroundsmall" id="<?php echo $id; ?>">
                </div>
            </section>

            <?php
            break;
        case 2:
            ?>

            <section id="block2">
                <div class="blocktitle">
                    <a href="CMS/assignment.php?id=<?php echo $ID?>">
                        <h1><?php echo $Title ?></h1>
                    </a>
                </div>
                <div class="blockbackgroundbig" id="<?php echo $id; ?>">
                </div>
            </section>

            <?php
            break;
        case 3:
            ?>

            <section id="block5">
                <div class="blocktitle">
                    <a href="CMS/assignment.php?id=<?php echo $ID?>">
                        <h1><?php echo $Title ?></h1>
                    </a>
                </div>
                <div class="blockbackgroundrealybig" id="<?php echo $id; ?>">
                </div>
            </section>

            <?php
            break;
        case 4:
            ?>

            <section id="block3">
                <div class="blocktitle">
                    <a href="CMS/assignment.php?id=<?php echo $ID?>">
                        <h1><?php echo $Title ?></h1>
                    </a>
                </div>
                <div class="blockbackgroundbig" id="<?php echo $id; ?>">
                </div>
            </section>

            <?php
            break;
        case 5:
            ?>

            <section id="block4">
                <div class="blocktitle">
                    <a href="CMS/assignment.php?id=<?php echo $ID?>">
                        <h1><?php echo $Title ?></h1>
                    </a>
                </div>
                <div class="blockbackgroundsmall" id="<?php echo $id; ?>">
                </div>
            </section>

            <?php
            break;
        default:
            break;
    }

    ?>

    <!-- achtergrond veranderen op ID -->

    <script>
        document.getElementById("<?php echo $id; ?>").style.backgroundImage = "url('<?php echo $ImagePath ?>')";
        document.getElementById("<?php echo $id; ?>").style.backgroundSize = "100% 100%";
    </script>


    <?php

    /* counter update */

    if ($i == 5) {
        $i = 1;
        $id++;
    } else {
        $i++;

        $id++;
    }
}

?>

</section>
