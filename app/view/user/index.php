<!-- view/template/header.php -->
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
                        <li><a href="<?php echo BASE_URL; ?>"><i class="glyphicon glyphicon-home"></i>&nbsp;Home</a></li>
                        <li><a href="<?php echo BASE_URL . 'login'; ?>"><i class="glyphicon glyphicon-log-out"></i>&nbsp;Logout</a></li>
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
                $id = $this->old('id');
                $name = $this->old('name');
                $email = $this->old('email');
                $password = $this->old('password');
            }

            // TODO: Verificar se dá para melhorar a chamada das funções na view sem o $this.
            $submit = ($id) ? $this->strings()->user->buttons->update : $this->strings()->user->buttons->create;
        ?>

        <form class="form-horizontal" role="form" method="POST" action="<?php echo BASE_URL; ?>user/store">

            <input type="hidden" name="_token" value="<?php echo $this->token(); ?>">
            <input type="hidden" name="id" value="<?php echo $id; ?>">

            <div class="form-group">
                <label class="col-md-1 control-label"><?php echo $this->strings()->user->fields->name; ?>:</label>
                <div class="col-md-3">
                    <input type="text" class="form-control" name="name" value="<?php echo $name; ?>">
                </div>
                <label class="col-md-1 control-label"><?php echo $this->strings()->user->fields->email; ?>:</label>
                <div class="col-md-4">
                    <input type="text" class="form-control" name="email" value="<?php echo $email; ?>">
                </div>
                <label class="col-md-1 control-label"><?php echo $this->strings()->user->fields->password; ?>:</label>
                <div class="col-md-2">
                    <input type="password" class="form-control" name="password" value="<?php echo $password; ?>">
                </div>
            </div>
            <input type="submit" class="btn btn-primary" name="submit" value="<?php echo $submit; ?>">
            <?php if ($id) : ?>
                <a href="<?php echo BASE_URL; ?>user" class="btn btn-danger"><?php echo $this->strings()->user->buttons->cancel; ?></a>
            <?php endif; ?>
        </form>
        <br><br>
        <table class="table table-hover">

            <thead>
            <tr>
                <th>#</th>
                <th><?php echo $this->strings()->user->fields->name; ?>:</th>
                <th><?php echo $this->strings()->user->fields->email; ?>:</th>
                <th>&nbsp;</th>
            </tr>
            </thead>

            <tbody>
            <?php foreach($users as $user) : ?>
                <tr>
                    <form method="POST" action="<?php echo BASE_URL; ?>user/destroy">

                        <input type="hidden" name="_token" value="<?php echo $this->token(); ?>">
                        <input type="hidden" name="id" value="<?php echo $user->id; ?>">

                        <td><?php echo $user->id; ?></td>
                        <td><?php echo htmlspecialchars($user->name); ?></td>
                        <td><?php echo htmlspecialchars($user->email); ?></td>
                        <td>
                            <a href="<?php echo BASE_URL; ?>user/edit/<?php echo $user->id; ?>" class="btn btn-sm btn-default"><?php echo $this->strings()->user->buttons->edit; ?></a>
                            <input type="submit" value="<?php echo $this->strings()->user->buttons->remove; ?>" class="btn btn-sm btn-danger">
                        </td>
                    </form>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div><!-- /Container -->
<!-- view/template/footer.php -->