<?php
session_start();
include 'connect.php';
$name = $_POST['name'];
$description = $_POST['description'];
$dotell = $_POST['dotell'];
$votes = 1;// first initial vote for new entry
$user = $_POST['user'];
$share = $_POST['share'];
$pict = ($_FILES["fileToUpload"]["name"]);
$cleanpict = htmlspecialchars($pict);
$pict = $cleanpict;
?>

<?php
$target_dir = "./upload/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
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
echo "<br>";
echo "file name:".($_FILES["fileToUpload"]["name"]);
echo "<br>";
echo ($_FILES["fileToUpload"]["size"]);
echo "<br>";
echo "type:".$imageFileType;
echo "<br>";
if ($_FILES["fileToUpload"]["size"] > 1100000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType == "JPG" || $imageFileType == "jpg" || $imageFileType == "png" || $imageFileType == "PNG" ||$imageFileType == "jpeg"
||$imageFileType == "JPEG"|| $imageFileType == "gif" || $imageFileType == "GIF" ) {
   $uploadOk = 1;
}
else {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}

/* prepare */
if (!($stmt = $mysqli->prepare("INSERT INTO scifidb ( name, description, dotell, votes, pict, user, share) VALUES ( ?, ?, ?, ?, ?, ?, ? )")) )
{
echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
}

 /* bind and execute */ 
if (!$stmt->bind_param("sssissi", $name, $description, $dotell, $votes, $pict, $user, $share)) {
echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
}

if (!$stmt->execute()) {
echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
}
/* close statement */
$stmt->close(); 

echo "<meta http-equiv='refresh' content='0; url=member.php'>";


?> 
