<!-- view/template/header.php -->
<body>
    <div class="container">
        <div class="wrapper">
            <form class="form-signin" action="<?php echo BASE_URL . 'login'; ?>" method="post">

                <h3 class="form-signin-heading"><?php echo $this->strings()->user->login->title; ?></h3>

                <?php if (isset($error)) : ?>
                    <div class="alert alert-danger">
                        <?php echo $error; ?>
                    </div>
                <?php endif; ?>

                <h5>
                    <?php echo $this->strings()->user->login->first . ' '; ?>
                    <a href="<?php echo BASE_URL . 'register'; ?>">
                        <?php echo $this->strings()->user->register->title; ?>
                    </a>
                </h5>

                <input name="email" type="email" class="form-control no-radius-bottom" placeholder="<?php echo $this->strings()->user->fields->email; ?>" autofocus>
                <input name="password" type="password" class="form-control no-radius-top" placeholder="<?php echo $this->strings()->user->fields->password; ?>">

                <button class="btn btn-lg btn-primary btn-block" type="submit"><?php echo $this->strings()->user->buttons->login; ?></button>
            </form>
        </div>
    </div>
<!-- view/template/footer.php -->