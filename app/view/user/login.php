<?php $app::template('template/header'); ?>

<body>
    <div class="container">
        <div class="wrapper">
            <form class="form-signin" action="<?php echo BASE_URL . 'login'; ?>" method="post">

                <h3 class="form-signin-heading"><?php echo $app::values()->user->login->title; ?></h3>

                <?php if (isset($error)) : ?>
                    <div class="alert alert-danger">
                        <?php echo $error; ?>
                    </div>
                <?php endif; ?>

                <h5>
                    <?php echo $app::values()->user->login->first . ' '; ?>
                    <a href="<?php echo BASE_URL . 'register'; ?>">
                        <?php echo $app::values()->user->register->title; ?>
                    </a>
                </h5>

                <input name="email" type="email" class="form-control no-radius-bottom" placeholder="<?php echo $app::values()->user->fields->email; ?>" autofocus>
                <input name="password" type="password" class="form-control no-radius-top" placeholder="<?php echo $app::values()->user->fields->password; ?>">

                <button class="btn btn-lg btn-primary btn-block" type="submit"><?php echo $app::values()->user->buttons->login; ?></button>
            </form>
        </div>
    </div>

<?php $app::template('template/footer'); ?>