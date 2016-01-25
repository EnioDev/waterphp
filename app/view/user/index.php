<?php load('template/header'); ?>

<body>
    <div class="container">
        <nav class="navbar navbar-inverse">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">CRUD Example</a>
                </div>
                <div id="navbar" class="collapse navbar-collapse">
                    <ul class="nav navbar-nav pull-right">
                        <li><a href="<?php echo route('language'); ?>"><i class="glyphicon glyphicon-globe"></i>&nbsp;<?php echo (session_language() == 'pt-br') ? 'Português/Inglês' : 'English/Portuguese'; ?></a></li>
                        <li><a href="<?php echo base_url(); ?>"><i class="glyphicon glyphicon-home"></i>&nbsp;Home</a></li>
                        <li><a href="<?php echo route('logout'); ?>"><i class="glyphicon glyphicon-log-out"></i>&nbsp;Logout</a></li>
                    </ul>
                </div>
                <!-- /.nav-collapse -->
            </div>
        </nav>

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
            $id = (isset($user)) ? $user->id : null;
            $name = (isset($user)) ? $user->name : '';
            $email = (isset($user)) ? $user->email : '';
            $password = (isset($user)) ? $user->password : '';

            if (isset($errors) and count($errors) > 0)
            {
                $id = previous('id');
                $name = previous('name');
                $email = previous('email');
                $password = previous('password');
            }

            $submit = strings()->button->create;
            if ($id) {
                $submit = strings()->button->update;
            }
        ?>

        <form class="form-horizontal" role="form" method="POST" action="<?php echo url('user/store'); ?>">

            <input type="hidden" name="_token" value="<?php echo session_token(); ?>">
            <input type="hidden" name="id" value="<?php echo $id; ?>">

            <div class="form-group">
                <div class="col-md-4">
                    <label class="control-label"><?php echo strings()->field->name; ?>:</label>
                    <input type="text" class="form-control" name="name" value="<?php echo $name; ?>">
                </div>

                <div class="col-md-5">
                    <label class="control-label"><?php echo strings()->field->email; ?>:</label>
                    <input type="text" class="form-control" name="email" value="<?php echo $email; ?>">
                </div>

                <div class="col-md-3">
                    <label class="control-label"><?php echo strings()->field->password; ?>:</label>
                    <input type="password" class="form-control" name="password" value="<?php echo $password; ?>">
                </div>
            </div>
            <input type="submit" class="btn btn-success" name="submit" value="<?php echo $submit; ?>">
            <a href="<?php echo url('user/cancel'); ?>" class="btn btn-info"><?php echo strings()->button->cancel; ?></a>
        </form>
        <br><br>
        <table class="table table-hover">

            <thead>
            <tr>
                <th>#</th>
                <th><?php echo strings()->field->name; ?>:</th>
                <th><?php echo strings()->field->email; ?>:</th>
                <th>&nbsp;</th>
            </tr>
            </thead>

            <tbody>
            <?php foreach($users as $user) : ?>
                <tr>
                    <form method="POST" action="<?php echo url('user/destroy'); ?>">

                        <input type="hidden" name="_token" value="<?php echo session_token(); ?>">
                        <input type="hidden" name="id" value="<?php echo $user->id; ?>">

                        <td><?php echo $user->id; ?></td>
                        <td><?php echo htmlspecialchars($user->name); ?></td>
                        <td><?php echo htmlspecialchars($user->email); ?></td>
                        <td>
                            <a href="<?php echo url('user/edit', [$user->id]); ?>" class="btn btn-sm btn-default"><?php echo strings()->button->edit; ?></a>
                            <input type="submit" value="<?php echo strings()->button->remove; ?>" class="btn btn-sm btn-danger">
                        </td>
                    </form>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div><!-- /Container -->

<?php load('template/footer'); ?>
