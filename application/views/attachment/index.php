<!DOCTYPE html>
<html>
<head>
    <title>Attachments</title>
</head>
<body>
<form action="<?php echo site_url('attachment/upload') ?>" method="post" enctype="multipart/form-data">
    <input type="file" name="attachment">
    <input type="submit" value="Upload">
</form>
</body>
</html>