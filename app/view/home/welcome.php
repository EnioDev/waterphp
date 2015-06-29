<?php $app::template('template/header'); ?>

<body>
    <div class="container">
        <div class="col-sm-8 col-sm-offset-2 text-center">

            <img src="<?php echo PUBLIC_URL . 'images/water.jpg'; ?>" />
            <h1><span class="text-primary">Water</span> Framework.</h1>

            <pre>You are in the <strong>/view/home/welcome.php</strong> file.</pre><br>

            <a href="<?php echo BASE_URL . 'user'; ?>" class="btn btn-primary btn-lg">
                CRUD Example
            </a>
        </div>
    </div>

<?php $app::template('template/footer'); ?>