<!DOCTYPE html>
<html>
<head>
    <title>Article info</title>
    <script type="text/javascript" src="<?= base_url() ?>js/jquery-2.2.0.min.js"></script>
    <script type="text/javascript" src="<?= base_url() ?>js/articleObj.js"></script>
    <script type="text/javascript" src="<?= base_url() ?>js/bootstrap/js/bootstrap.js"></script>
    <link rel="stylesheet" href="<?= base_url() ?>js/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="<?= base_url() ?>css/style.css">
</head>
<body>
<script type="text/javascript">
    $(document).ready(function() {
        articleObj.setBaseUrl('<?php echo site_url('article') ?>');
        articleObj.init();
    });
</script>
<div class="message">
<?php
if (isset($_SESSION['update_result'])) {
    $result = $_SESSION['update_result'];
    $class = $result['success'] ? 'success' : 'error';

    echo '<div class="' . $class . '">' . $result['message'] . '</div>';
}
?>
</div>
<p>
    <a href="<?php echo site_url('article/add') ?>">Add article</a>
</p>
<table border="1" width="100%">
    <thead>
    <tr>
        <th width="10%">Title</th>
        <th width="60%">Content</th>
        <th width="10%">Public date</th>
        <th width="20%">Actions</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($articles as $article): ?>
        <tr>
            <td><?php echo $article['title'] ?></td>
            <td><?php echo $article['content'] ?></td>
            <td><?php echo (new DateTime($article['public_date']))->format('d/m/Y H:m') ?></td>
            <td align="center">
                <span style="margin-right: 30px" class="edit_article" data-article-id="<?php echo $article['id'] ?>">Edit</span>
                <span class="delete_article" data-article-id="<?php echo $article['id'] ?>">Delete</span>
            </td>
        </tr>
    <?php endforeach ?>
    </tbody>
</table>
<div style="text-align: center; margin-top: 20px;"><?php echo $this->pagination->create_links() ?></div>
<div id="editArticle" class="modal hide fade modal-form">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3>Edit Article</h3>
    </div>
    <div class="modal-body">
        <div>Название статьи</div>
        <input class="title" type="text" name="title"><br />

        <div>Содержимое статьи</div>
        <textarea class="content" name="content"></textarea><br />

        <div>Дата публикации</div>
        <input class="public-date" type="text" name="public_date"><br />

        <input class="edit-article" type="button" name="edit_article" value="Edit Article">
    </div>
</div>
</body>
</html>