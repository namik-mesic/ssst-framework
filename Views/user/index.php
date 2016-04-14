<html>
<?php include "Views/template/head.php" ?>

<body>
<?php include "Views/template/header.php" ?>

<div class="container">
    <table class="table">
        <thead>
        <tr>
            <th>
                ID
            </th>
            <th>
                Ime
            </th>
            <th>
                Email
            </th>
            <th>
                Identifier
            </th>
            <th>
                Number of posts
            </th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($users as $user): ?>
            <tr>
                <td>
                    <?php echo $user->id ?>
                </td>
                <td>
                    <?php echo $user->name ?>
                </td>
                <td>
                    <?php echo $user->email ?>
                </td>
                <td>
                    <?php echo $user->identifier() ?>
                </td>
                    <?php echo $user->postCount() ?>
                <td>

                </td>
            </tr>
        <?php endforeach ?>
        </tbody>
    </table>
</div>

</body>
</html>