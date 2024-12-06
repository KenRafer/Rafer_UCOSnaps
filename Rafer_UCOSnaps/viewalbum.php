<?php require_once 'core/dbConfig.php'; ?>
<?php require_once 'core/models.php'; ?>

<?php  
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
}

$album_id = $_GET['album_id'];
$album = getAlbumByID($pdo, $album_id);
$photos = getPhotosByAlbumID($pdo, $album_id);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($album['album_name']); ?></title>
    <link rel="stylesheet" href="styles/styles.css">
</head>
<body>
    <?php include 'navbar.php'; ?>
    <h1><?php echo htmlspecialchars($album['album_name']); ?></h1>
    <div class="photos" style="display: flex; justify-content: center; flex-wrap: wrap;">
        <?foreach ($photos as $photo) { ?>
            <div class="photoContainer" style="background-color: ghostwhite; border: 1px solid gray; margin: 10px; padding: 10px; width: 200px; text-align: center;">
                <img src="images/<?php echo htmlspecialchars($photo['photo_name']); ?>" alt="" style="width: 100%;">
                <h4><?php echo htmlspecialchars($photo['description']); ?></h4>
                <p><i>Uploaded by: <?php echo htmlspecialchars($photo['username']); ?></i></p>
                <form action="core/handleForms.php" method="POST" style="display: inline;">
                    <input type="hidden" name="photo_id" value="<?php echo $photo['photo_id']; ?>">
                    <input type="hidden" name="photo_name" value="<?php echo $photo['photo_name']; ?>">
                    <input type="submit" name="deletePhotoBtn" value="Delete Photo" style="background-color: red; color: white;">
                </form>
                <form action="editphoto.php" method="GET" style="display: inline;">
                    <input type="hidden" name="photo_id" value="<?php echo $photo['photo_id']; ?>">
                    <input type="submit" value="Edit Photo" style="background-color: blue; color: white;">
                </form>
            </div>
        <?php } ?>
    </div>
</body>
</html>