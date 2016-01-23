<!DOCTYPE html>
<html>
<head>
    <title>Upload</title>
</head>
<body>
    <h1>Upload file</h1>
    <form action="<?php echo site_url('gallery/add') ?>" method="post" enctype="multipart/form-data">
        <input type="file" name="upload">
        <input type="submit" value="Upload">
    </form>
<?php
if (isset($success)) {
    if ($success === false) {
        echo $message;
    } elseif ($success) {
        echo '<pre>';
        var_dump($upload_data);
        echo '</pre>';
    }
}
?>
</body>
</html>