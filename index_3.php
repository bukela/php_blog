<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>File upload</title>
</head>
<body>
    <form action="" method="post" enctype="multipart/form-data">
        <input type="file" name="file" id="">
        <button type="submit" name="submit">Upload</button>
    </form>

<?php
    if (isset($_POST['submit'])) {
        $file = $_FILES['file'];

        $fileName = $file['name'];
        $fileTmpName = $file['tmp_name'];
        $fileSize = $file['size'];
        $fileError = $file['error'];
        $fileType = $file['type'];

        $fileExt = explode('.', $fileName);
        $fileActualExt = strtolower(end($fileExt));
        $allowed = array('jpg','jpeg','.png','pdf');

        if (in_array($fileActualExt, $allowed)) {
            if ($fileError === 0) {
                if ($fileSize < 50000) {
                    $fileNameNew = uniqid('', true).".".$fileActualExt;
                    $fileDestination = "uploads/".$fileNameNew;
                    move_uploaded_file($fileTmpName, $fileDestination);
                    header("Location: index.php?uploadsuccess");
                    // echo 'File uploaded successfully';
                } else {
                    echo 'File too big';
                } 
            } else {
                echo 'Error uploading';
            }
        } else {
            echo 'Unsupported file format';
        }
    }
?>
</body>
</html>
