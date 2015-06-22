<!-- view/template/header.php -->
<body>
    <div class="container">
        <div class="wrapper">
            <form class="form-signup" action="<?php echo BASE_URL . 'user/store'; ?>" method="post">

                <h3 class="form-signin-heading"><?php echo $this->strings()->user->register->title; ?></h3>

                <?php if (isset($message) and strlen($message) > 0) : ?>
                    <div class="alert alert-success">
                        <?php echo $message; ?>
                    </div>
                <?php endif; ?>

                <?php if (isset($errors) and count($errors) > 0) : ?>
                    <div class="alert alert-danger">
                        <?php foreach ($errors as $e) : ?>
                            <li><?php echo $e; ?></li>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>

                <?php
                    $name = '';
                    $email = '';
                    $password = '';

                    if (isset($errors) and count($errors) > 0)
                    {
                        $name = $this->old('name');
                        $email = $this->old('email');
                        $password = $this->old('password');
                    }
                ?>

                <input name="name" type="text" class="form-control no-radius-bottom" value="<?php echo $name; ?>" placeholder="<?php echo $this->strings()->user->fields->name; ?>" autofocus>
                <input name="email" type="email" class="form-control no-radius" value="<?php echo $email; ?>" placeholder="<?php echo $this->strings()->user->fields->email; ?>">
                <input name="password" type="password" class="form-control no-radius-top" value="<?php echo $password; ?>" placeholder="<?php echo $this->strings()->user->fields->password; ?>">

                <input type="submit" class="btn btn-lg btn-success btn-block" name="submit" value="<?php echo $this->strings()->user->buttons->register; ?>">
                <a class="btn btn-lg btn-primary btn-block" href="<?php echo BASE_URL . 'login'; ?>"><?php echo $this->strings()->user->buttons->login; ?></a>
            </form>
        </div>
    </div>
<!-- view/template/footer.php -->