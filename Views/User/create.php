<html>

<?php include 'Views/template/head.php' ?>

<body>

<?php include 'Views/template/header.php' ?>

<div class="container">
    <form action="<?php echo url('user/post') ?>" method="POST">

        <div class="form-group">
            <label for="name">
                Ime
            </label>
            <input type="text" name="name" id="name" class="form-control">
        </div>

        <div class="form-group">
            <label for="email">
                Email
            </label>
            <input type="email" name="email" id="email" class="form-control">
        </div>

        <div class="form-group">
            <label for="password">
                Password
            </label>
            <input type="password" name="password" id="password" class="form-control">
        </div>

        <button type="submit" class="btn btn-sm btn-success">
            Submit
        </button>

    </form>
</div>

</body>

</html>