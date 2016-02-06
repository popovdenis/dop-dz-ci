<!DOCTYPE html>
<html>
<head>
    <title>Add article</title>
</head>
<body>
<div><?php echo form_error('title') ?></div>
<div><?php echo form_error('content') ?></div>
<div><?php echo form_error('public_date') ?></div>
<form action="<?php echo site_url('article/add') ?>" method="post" enctype="multipart/form-data">
    <div>Название статьи</div>
    <input type="text" name="title"><br />

    <div>Содержимое статьи</div>
    <textarea name="content" rows="15" cols="15"></textarea><br />

    <div>Дата публикации</div>
    <input type="text" name="public_date"><br />

    <input type="submit" name="add_article" value="Add Article">
</form>
</body>
</html>