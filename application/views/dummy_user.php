<!DOCTYPE html>
<html>
<head>
    <title>Dummy users</title>
</head>
<body>
    <table border="1">
        <thead>
            <tr>
                <th>Firstname</th>
                <th>Lastname</th>
                <th>Email</th>
                <th>Created date</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($users as $user): ?>
        <tr>
            <td><?php echo $user['firstname'] ?></td>
            <td><?php echo $user['lastname'] ?></td>
            <td><?php echo $user['email'] ?></td>
            <td><?php echo (new DateTime($user['created_at']))->format('d/m/Y H:m') ?></td>
        </tr>
        <?php endforeach ?>
        </tbody>
    </table>
</body>
</html>