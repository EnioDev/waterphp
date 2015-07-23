<?php $app::view('template/header'); ?>

<body>
    <div class="container">
        <div class="wrapper">
            <form class="form form-signin" action="<?php echo $app::route('login'); ?>" method="post">

                <h3 class="form-heading"><?php echo $app::strings()->user->login->title; ?></h3>

                <?php if (isset($error)) : ?>
                    <div class="alert alert-danger">
                        <?php echo $error; ?>
                    </div>
                <?php endif; ?>

                <h5>
                    <?php echo $app::strings()->user->login->new_user . ' '; ?>
                    <a href="<?php echo $app::route('register'); ?>">
                        <?php echo $app::strings()->user->register->title; ?>
                    </a>
                </h5>

                <input name="email" type="email" class="form-control no-radius-bottom" placeholder="<?php echo $app::strings()->user->fields->email; ?>" autofocus>
                <input name="password" type="password" class="form-control no-radius-top" placeholder="<?php echo $app::strings()->user->fields->password; ?>">

                <button class="btn btn-lg btn-primary btn-block" type="submit"><?php echo $app::strings()->user->buttons->login; ?></button>
            </form>
        </div>
    </div>

<?php $app::view('template/footer'); ?>