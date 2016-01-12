<?php load('template/header'); ?>

<body>
    <div class="container">
        <div class="wrapper">
            <form class="form form-signin" action="<?php echo route('login'); ?>" method="post">

                <h3 class="form-heading"><?php echo strings()->login->title; ?></h3>

                <?php if (isset($error)) : ?>
                    <div class="alert alert-danger">
                        <?php echo $error; ?>
                    </div>
                <?php endif; ?>

                <h5>
                    <?php echo strings()->login->first . ' '; ?>
                    <a href="<?php echo route('register'); ?>">
                        <?php echo strings()->register->title; ?>
                    </a>
                </h5>

                <input name="email" type="email" class="form-control no-radius-bottom" placeholder="<?php echo strings()->field->email; ?>" autofocus>
                <input name="password" type="password" class="form-control no-radius-top" placeholder="<?php echo strings()->field->password; ?>">

                <button class="btn btn-lg btn-primary btn-block" type="submit"><?php echo strings()->button->login; ?></button>
            </form>
        </div>
    </div>

<?php load('template/footer'); ?>
