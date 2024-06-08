<?php
    session_start();
    if(!isset($_SESSION['userid']))
        header('Location: index.php');
    
    if(isset($_POST['title'])){
        require "module/uploadfile.php";
        require "../connectdb.php";
        mysqli_select_db($db, 'fleamarket') or die(mysqli_error($db));

        // file upload
        $target_dir = "../uploads/";
        $result = upload($target_dir, $_FILES['image']);

        // if no uploading error detected
        if($result !== "ERROR" && $result !== "NOTIMAGE" && $result !== "NOFILE"){    
            $userid = $_SESSION['userid'];
            $title = $_POST['title'];
            $category = $_POST['category'];
            $image = $result;
            $desc = $_POST['desc'];
            echo $userid.'<br>'.$title.'<br>'.$category.'<br>'.$image.'<br>'.$desc.'<br>';

            $query = "insert into articles".
            "(title, uploader, category, thumbnail, content, uploadDate)".
            "values('$title','$userid','$category','$image', '$desc', now())";
            mysqli_query($db, $query) or die(mysqli_error($db));
            header('Location: index.php');
        }
    }
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/main.css">
    <title>Flea Market</title>
</head>
<body>
    <header>
        <?php require "module/header.php";?>
    </header>
    <div class="main-wrap">
        <section class="upload post">
        <h2>Upload</h2>
            <form action="" method="post" enctype="multipart/form-data">
            <p>
                <label for="userid">Title</label>
                <input type="text" name="title" id="title" required>
            </p>
            <p>
                <label for="category">Category</label>
                <select name="category" id="category" required>
                    <option value="books">Books</option>
                    <option value="furnitures">Furnitures</option>
                    <option value="electronics">Electronics</option>
                    <option value="clothing">Clothing</option>
                    <option value="etc">Etc.</option>
                </select>
            </p>
            <p>
                <label for="image">Item Image</label>
                <input type="file" name="image" id="image" required>
            </p>
            <p>
                <label for="desc">Decription</label>
                <textarea name="desc" id="desc" cols="30" rows="7" required></textarea>
            </p>

            <?php if(isset($result)){
                if($result=="NOFILE") $result = "No file uploaded.";
                if($result=="NOTIMAGE") $result = "File is not an image.";
                if($result=="ERROR") $result = "There is an error uploading image.";
                echo "<p class='error'>$result</p>";
            } ?>

            <p class="ralign">
                <input type="submit" id="submit" value="Upload" class="btn">
            </p>
            </form>
        </section>
    </div>
</body>
</html>