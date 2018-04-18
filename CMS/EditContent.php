<?php
require_once('../Includes/Security.php');
require_once('../Includes/Connection.php');

/* Kijk of er op de upload imageToPutContent is gedrukt, upload de image en zet deze in ckeditor.  */
if (isset($_POST['imageToPutContent'])) {

    $ID = $_POST['id'];
    $PostFilePath = $_POST['filepathform'];
    $PostImagePath = $_POST['imagepathform'];
    $dbText = $_POST['editor1'];
    $dbCategory = $_POST['category'];
    $dbTitle = $_POST['title'];
    $dbPreview_Image_Path = $_POST['imagepathform'];
    $dbFilePath = $_POST['filepathform'];

    $target_dir = "../Uploads/contentImages/";
    $putpath = "Uploads/contentImages/" . basename($_FILES["imageToPut"]["name"]);
    $target_file = $target_dir . basename($_FILES["imageToPut"]["name"]);
    $uploadOk = 1;
    $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
    // Check if image file is a actual image or fake image
    if (isset($_POST["submit"])) {
        $check = getimagesize($_FILES["imageToPut"]["tmp_name"]);
        if ($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
    }

    // Check if file already exists
    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }

    // Check file size
    if ($_FILES["imageToPut"]["size"] > 200000000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Allow certain file formats
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" && $imageFileType != "JPG" && $imageFileType != "PNG"
        && $imageFileType != "JPEG" && $imageFileType != "GIF"
    ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["imageToPut"]["tmp_name"], $target_file)) {
            echo "The file " . basename($_FILES["imageToPut"]["name"]) . " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }

    $text = $_POST['editor1'] . "<img width=250px; src= ../$putpath>";

    $UpdateContent = $conn->prepare("UPDATE content SET Title = :Title, Category = :Category, Text = :Text, FilePath = :FilePath, Preview_Image_Path = :ImagePath WHERE id=".$ID);
    $UpdateContent->bindParam(":Title", $_POST['title']);
    $UpdateContent->bindParam(":Category", $_POST['category']);
    $UpdateContent->bindParam(":Text", $text);
    $UpdateContent->bindParam(":FilePath", $PostFilePath);
    $UpdateContent->bindParam(":ImagePath", $PostImagePath);
    $UpdateContent->execute();
}

/* Kijk of er op de knop update is gedrukt en update alle info naar de database */
if (isset($_POST['update'])) {

    $ID = $_POST['id'];
    $PostFilePath = $_POST['filepathform'];
    $PostImagePath = $_POST['imagepathform'];
    $dbText = $_POST['editor1'];
    $dbCategory = $_POST['category'];
    $dbTitle = $_POST['title'];
    $dbPreview_Image_Path = $_POST['imagepathform'];
    $dbFilePath = $_POST['filepathform'];

    $target_dir = "../Uploads/Images/";
    $target_file = $target_dir . basename($_FILES["previewImageToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
    // Check if image file is a actual image or fake image
    if (isset($_POST["submit"])) {
        $check = getimagesize($_FILES["previewImageToUpload"]["tmp_name"]);
        if ($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
    }

    // Check if file already exists
    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }

    // Check file size
    if ($_FILES["previewImageToUpload"]["size"] > 200000000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Allow certain file formats
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" && $imageFileType != "JPG" && $imageFileType != "PNG"
        && $imageFileType != "JPEG" && $imageFileType != "GIF"
    ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    if (basename($_FILES["previewImageToUpload"]["name"]) != "") {
        unlink('../' . $PostImagePath);

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
            // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["previewImageToUpload"]["tmp_name"], $target_file)) {
                echo "test";
                print_r($_FILES);
                echo "The file " . basename($_FILES["previewImageToUpload"]["name"]) . " has been uploaded.";
                $PostImagePath = "Uploads/Images/" . basename($_FILES["previewImageToUpload"]["name"]);
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    }

    $target_dir = "../Uploads/Files/";
    $target_file = $target_dir . basename($_FILES["filePath"]["name"]);
    $uploadOk = 1;
    $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
    // Check if image file is a actual image or fake image
    if (isset($_POST["submit"])) {
        $check = getimagesize($_FILES["filePath"]["tmp_name"]);
        if ($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
    }

    // Check if file already exists
    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }

    // Check file size
    if ($_FILES["filePath"]["size"] > 200000000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Allow certain file formats
    if ($imageFileType != "pdf"
    ) {
        echo "Sorry, only PDF files are allowed.";
        $uploadOk = 0;
    }

    if (basename($_FILES["filePath"]["name"]) != "") {
        unlink('../' . $PostFilePath);

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
            // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["filePath"]["tmp_name"], $target_file)) {
                echo "The file " . basename($_FILES["filePath"]["name"]) . " has been uploaded.";
                $PostFilePath = "Uploads/Files/" . basename($_FILES["filePath"]["name"]);
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }

    }

    $UpdateContent = $conn->prepare("UPDATE content SET Title = :Title, Category = :Category, Text = :Text, FilePath = :FilePath, Preview_Image_Path = :ImagePath WHERE id=".$ID);
    $UpdateContent->bindParam(":Title", $_POST['title']);
    $UpdateContent->bindParam(":Category", $_POST['category']);
    $UpdateContent->bindParam(":Text", $_POST['editor1']);
    $UpdateContent->bindParam(":FilePath", $PostFilePath);
    $UpdateContent->bindParam(":ImagePath", $PostImagePath);
    $UpdateContent->execute();

}
else if (isset($_POST['cancel'])) {
    header('Location:ContentList.php');
}

If (isset($_GET['id'])) {

    $ContentInfo = $conn->prepare("SELECT Title, Category, Text, FilePath, Preview_Image_Path FROM content WHERE id=".$_GET['id']);
    $ContentInfo->execute();

    $ContentInfo->bindColumn(1, $Title);
    $ContentInfo->bindColumn(2, $Category);
    $ContentInfo->bindColumn(3, $Text);
    $ContentInfo->bindColumn(4, $FilePath);
    $ContentInfo->bindColumn(5, $Preview_Image_Path);

    while ($ContentInfo->fetch()) {
        $dbTitle = $Title;
        $dbCategory = $Category;
        $dbText = $Text;
        $dbFilePath = $FilePath;
        $dbPreview_Image_Path = $Preview_Image_Path;
    }
}
else {

}
?>

<html>
<head>
    <meta charset="utf-8">
    <title>Portfolio</title>
    <meta name="description" content="Portfolio Menno Brands">
    <meta name="author" content="Menno Brands">
    <link rel="shortcut icon" type="image/png" href=""/>
    <link rel="stylesheet" type="text/css" href="../CSS/Main.css">
    <script src="../Plugins/ckeditor/ckeditor.js"></script>
</head>
<nav>
    <section class="Navlogo" id="front">
        <section class="Navlogon">
            <a href="../Index.html">
                <img src="../Images/nav/navMennoBrandsBlack.png" alt="logo button">
            </a>
        </section>
    </section>
    <section class="Navlogo" id="back">
        <section class="Navlogon">
            <a href="../Index.html">
                <img src="../Images/nav/navMennoBrands.png" alt="logo button">
            </a>
        </section>
    </section>
</nav>
<body>

<section id="ContentEdit">
<h1> Content Edit </h1> <br/>
    <form action="#" method="POST" autocomplete="off" enctype="multipart/form-data">
        Title: <input type="text" name="title" value="<?php echo $dbTitle; ?>"><p> <br/>
            Category:
            <?php
            switch ($dbCategory) {
                default:
                    break;
                case "ded";
                    ?>
                    <select name="category">
                        <option value="ded" selected>ded</option>
                        <option value="sco">sco</option>
                        <option value="uxu">uxu</option>
                        <option value="pt">pt</option>
                        <option value="ppo">ppo</option>
                    </select> <p>
                    <?php
                    break;
                case "sco";
                    ?>
                    <select name="category">
                        <option value="ded">ded</option>
                        <option value="sco" selected>sco</option>
                        <option value="uxu">uxu</option>
                        <option value="pt">pt</option>
                        <option value="ppo">ppo</option>
                    </select> <p>
                    <?php
                    break;
                case "uxu";
                    ?>
                    <select name="category">
                        <option value="ded">ded</option>
                        <option value="sco">sco</option>
                        <option value="uxu" selected>uxu</option>
                        <option value="pt">pt</option>
                        <option value="ppo">ppo</option>
                    </select> <p>
                    <?php
                    break;
                case "pt";
                    ?>
                    <select name="category">
                        <option value="ded">ded</option>
                        <option value="sco">sco</option>
                        <option value="uxu">uxu</option>
                        <option value="pt" selected>pt</option>
                        <option value="ppo">ppo</option>
                    </select> <p>
                    <?php
                    break;
                case "ppo";
                     ?>
                    <select name="category">
                        <option value="ded">ded</option>
                        <option value="sco">sco</option>
                        <option value="uxu">uxu</option>
                        <option value="pt">pt</option>
                        <option value="ppo" selected>ppo</option>
                    </select> <p>
                    <?php
                    break;
            }
            ?> <br/>
            <textarea name="editor1" id="editor1">
                <?php echo $dbText; ?>
            </textarea>
            <script type="text/javascript">
                // Replace the <textarea id="editor1"> with a CKEditor
                // instance, using default configuration.
                CKEDITOR.replace( "editor1" );
            </script>
            Put image in editor: <input type="file" name="imageToPut" id="imageToPut"><p> <br/>
            <input type="submit" name= "imageToPutContent" value="Insert image">
            <img src="../<?php echo $dbPreview_Image_Path; ?>" height="20%" width="20%"> <p> <br/>
            Preview Image: <input type="file" name="previewImageToUpload" id="previewImageToUpload"<p> <br/> <br/>
            <a href="../<?php echo $dbFilePath; ?>">Current File: <?php echo $dbFilePath; ?></a> <p>
            PDF File: <input type="file" name="filePath" id="filePath" value=""><p></p> <br/>
            <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
            <input type="hidden" name="filepathform" value="<?php echo $dbFilePath; ?>">
            <input type="hidden" name="imagepathform" value="<?php echo $dbPreview_Image_Path; ?>">
            <input type="submit" name= "update" value="Update">
            <input type="submit" name = "cancel" value="Cancel"> <br/><br/><br/><br/>
    </form>
</section>
</body>
</html>













