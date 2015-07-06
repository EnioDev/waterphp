<?php $app::view('template/header'); ?>

<body>
    <div class="container">
        <div class="col-sm-8 col-sm-offset-2 text-center">

            <img src="<?php echo $app::asset('images/water.jpg'); ?>" />
            <h1><span class="text-primary">Water</span> Framework.</h1>

            <pre>You are in the <strong>/view/home/welcome.php</strong> file.</pre><br>

            <a href="<?php echo ($app::is_auth()) ? $app::base_url('user') : $app::base_url('login'); ?>" class="btn btn-primary btn-lg">
                CRUD Example
            </a>
        </div>
    </div>

<?php $app::view('template/footer'); ?>