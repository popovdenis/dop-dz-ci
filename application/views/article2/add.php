<!DOCTYPE html>
<html>
<head>
    <title>Add Article</title>
</head>
<body>

<form method="post" action="<?php echo site_url('article') ?>">
    Название статьи:<br />
    <input type="text" name="title" value="<?php echo set_value('title') ?>"><?php echo form_error('title') ?><br />
    Текст статьи:<br />
    <textarea name="text" rows="10" cols="40"><?php echo set_value('text') ?></textarea><?php echo form_error('text') ?><br />
    Дата статьи:<br />
    <input type="text" name="date" value="
    <?php echo set_value('date') ?>"><?php echo form_error('date') ?><br />
    <input type="submit" name="add" value="Add">
</form>

</body>
</html>
