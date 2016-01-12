<?php load('template/header'); ?>

<body>
    <div class="container">
        <div class="wrapper">
            <form class="form form-signup" action="<?php echo url('user/store'); ?>" method="post">

                <h3 class="form-heading"><?php echo strings()->register->title; ?></h3>

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
                        $name = previous('name');
                        $email = previous('email');
                        $password = previous('password');
                    }
                ?>

                <input type="hidden" name="_token" value="<?php echo session_token(); ?>">

                <input name="name" type="text" class="form-control no-radius-bottom" value="<?php echo $name; ?>" placeholder="<?php echo strings()->field->name; ?>" autofocus>
                <input name="email" type="email" class="form-control no-radius" value="<?php echo $email; ?>" placeholder="<?php echo strings()->field->email; ?>">
                <input name="password" type="password" class="form-control no-radius-top" value="<?php echo $password; ?>" placeholder="<?php echo strings()->field->password; ?>">

                <input type="submit" class="btn btn-lg btn-success btn-block" name="submit" value="<?php echo strings()->button->register; ?>">
                <a class="btn btn-lg btn-primary btn-block" href="<?php echo route('login'); ?>"><?php echo strings()->button->login; ?></a>
            </form>
        </div>
    </div>

<?php load('template/footer'); ?>
