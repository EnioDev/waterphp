<?php $app::view('template/header'); ?>

<body>
    <div class="container">
        <div class="wrapper">
            <form class="form-signup" action="<?php echo $app::url('user/store'); ?>" method="post">

                <h3 class="form-signin-heading"><?php echo $app::strings()->user->register->title; ?></h3>

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

                <input type="hidden" name="_token" value="<?php echo $app::token(); ?>">

                <input name="name" type="text" class="form-control no-radius-bottom" value="<?php echo $app::old('name'); ?>" placeholder="<?php echo $app::strings()->user->fields->name; ?>" autofocus>
                <input name="email" type="email" class="form-control no-radius" value="<?php echo $app::old('email'); ?>" placeholder="<?php echo $app::strings()->user->fields->email; ?>">
                <input name="password" type="password" class="form-control no-radius-top" value="<?php echo $app::old('password'); ?>" placeholder="<?php echo $app::strings()->user->fields->password; ?>">

                <input type="submit" class="btn btn-lg btn-success btn-block" name="submit" value="<?php echo $app::strings()->user->buttons->register; ?>">
                <a class="btn btn-lg btn-primary btn-block" href="<?php echo $app::route('login'); ?>"><?php echo $app::strings()->user->buttons->login; ?></a>
            </form>
        </div>
    </div>

<?php $app::view('template/footer'); ?>