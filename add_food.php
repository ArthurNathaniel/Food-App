<?php
include 'db.php';

if (isset($_POST['submit'])) {
    $food_name = $_POST['food_name'];
    $price = $_POST['price'];
    $discount = $_POST['discount'];
    
    // Handle file upload
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["food_image"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if image file is a actual image or fake image
    $check = getimagesize($_FILES["food_image"]["tmp_name"]);
    if ($check !== false) {
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }

    // Check file size
    if ($_FILES["food_image"]["size"] > 5500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Allow certain file formats
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    } else {
        if (move_uploaded_file($_FILES["food_image"]["tmp_name"], $target_file)) {
            // File is uploaded, now insert the data into the database
            $sql = "INSERT INTO food_items (food_name, price, discount, food_image) VALUES ('$food_name', '$price', '$discount', '$target_file')";
            if (mysqli_query($conn, $sql)) {
                echo "New food item added successfully.";
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Food</title>
    <link rel="stylesheet" href="./css/base.css">
</head>
<body>
    <h2>Add New Food Item</h2>
    <form action="add_food.php" method="POST" enctype="multipart/form-data">
        <label for="food_name">Food Name:</label><br>
        <input type="text" id="food_name" name="food_name" required><br><br>
        
        <label for="price">Price (GHS):</label><br>
        <input type="number" id="price" name="price" step="0.01" required><br><br>
        
        <label for="discount">Discount (%):</label><br>
        <input type="number" id="discount" name="discount" required><br><br>
        
        <label for="food_image">Food Image:</label><br>
        <input type="file" id="food_image" name="food_image" required><br><br>
        
        <input type="submit" name="submit" value="Add Food">
       
    </form>
</body>
</html>
