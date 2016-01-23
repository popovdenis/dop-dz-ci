<!DOCTYPE html>
<html>
<head>
    <title>Galleries</title>
</head>
<body>
<a href="<?php echo site_url('gallery/add') ?>">Add gallery</a>
<table border="1">
    <tbody>
    <?php $count = 0; foreach ($galleries as $gallery): ?>
    <?php if($count%3 == 0): ?>
    <tr>
    <?php endif ?>
        <td>
            <img width="100"
                 src="<?php echo base_url() . 'files/' . $gallery['file_name'] . '_thumb' . $gallery['file_ext'] ?>">
        </td>
    <?php if($count %3 == 0): ?>
    </tr>
    <?php endif ?>
    <?php $count++; endforeach ?>
    </tbody>
</table>
</body>
</html>