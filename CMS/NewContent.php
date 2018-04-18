<?php
require_once('../Includes/Security.php');
require_once('../Includes/Connection.php');

/* Kijk of er op de knop save is gedrukt en maak nieuwe content aan */
if (isset($_POST['save'])) {

    $target_dir = "../Uploads/Images/";
    $imgpath = "Uploads/Images/" . basename($_FILES["previewImageToUpload"]["name"]);
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
    if ($_FILES["previewImageToUpload"]["size"] > 20000000000000000000000000) {
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
        if (move_uploaded_file($_FILES["previewImageToUpload"]["tmp_name"], $target_file)) {
            echo "The file " . basename($_FILES["previewImageToUpload"]["name"]) . " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }

    $target_dir = "../Uploads/Files/";
    $filepath = "Uploads/Files/" . basename($_FILES["filePath"]["name"]);
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
    if ($_FILES["filePath"]["size"] > 20000000000000000000000000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Allow certain file formats
    if ($imageFileType != "pdf"
    ) {
        echo "Sorry, only PDF files are allowed.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["filePath"]["tmp_name"], $target_file)) {
            echo "The file " . basename($_FILES["filePath"]["name"]) . " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }

    $InsertContent = $conn->prepare("INSERT INTO content(Title ,Category ,Text, FilePath, Preview_Image_Path) VALUES (:Title, :Category, :Text, :FilePath, :Preview_Image_Path)");
    $InsertContent->bindParam(":Title", $_POST['title']);
    $InsertContent->bindParam(":Category", $_POST['category']);
    $InsertContent->bindParam(":Text", $_POST['editor1']);
    $InsertContent->bindParam(":FilePath", $filepath);
    $InsertContent->bindParam(":Preview_Image_Path", $imgpath);
    $InsertContent->execute();

    header('Location:ContentList.php');
}

else if (isset($_POST['cancel'])) {
        header('Location:ContentList.php');
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
<section id="NewContent">
    <h1> New Content </h1> <br/> <br/>
    <form action="NewContent.php" method="POST" autocomplete="off" enctype="multipart/form-data">
         Title: <input type="text" name="title" value=""><p>
        <br/>
        Category:
        <select name="category">
            <option value="ded">ded</option>
            <option value="sco">sco</option>
            <option value="uxu">uxu</option>
            <option value="pt">pt</option>
            <option value="ppo">ppo</option>
        </select> <p> <br/>

        <textarea name="editor1" id="editor1" rows="10" cols="80">
        </textarea>
        <script type="text/javascript">
            // Replace the <textarea id="editor1"> with a CKEditor
            // instance, using default configuration.
            CKEDITOR.replace( "editor1" );
        </script>
        Preview Image: <input type="file" name="previewImageToUpload" id="previewImageToUpload"><p> <br/>
        PDF File: <input type="file" name="filePath" id="filePath"><p>
        <input type="hidden" name="id" value=""> <br/>
        <input type="submit" name= "save" value="Save">
        <input type="submit" name = "cancel" value="Cancel">
    </form>
</section>
</body>
</html>