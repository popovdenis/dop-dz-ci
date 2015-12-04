<!DOCTYPE html>
<html>
<head>
    <title>Dummy users</title>
</head>
<body>
<a href="<?php echo site_url('/users/add') ?>">Add</a>
<table border="1">
    <thead>
    <tr>
        <th>Firstname</th>
        <th>Lastname</th>
        <th>Email</th>
        <th>Created date</th>
        <th>Actions</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($users as $user): ?>
        <tr>
            <td><?php echo $user['firstname'] ?></td>
            <td><?php echo $user['lastname'] ?></td>
            <td><?php echo $user['email'] ?></td>
            <td><?php echo (new DateTime($user['created_at']))->format('d/m/Y H:m') ?></td>
            <td>
                <span>
                    <a href="<?php echo site_url('users/edit/' . $user['id']) ?>">Edit</a>
                </span>
                <span>
                    <a href="<?php echo site_url('users/delete/' . $user['id']) ?>">Delete</a>
                </span>
            </td>
        </tr>
    <?php endforeach ?>
    </tbody>
</table>
</body>
</html>