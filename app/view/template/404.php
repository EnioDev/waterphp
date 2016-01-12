<?php load('template/header'); ?>

<body class="padding-20">
    <div class="container">
        <div class="well text-center">
            <img src="<?php echo asset('images/stop.png'); ?>" />
            <h1>404 Not found</h1>
            <div class="alert alert-danger">
                This will be shown if the page (controller or method) does not exist.
            </div>
            <a href="<?php echo base_url(); ?>" class="btn btn-default">
                <span class="glyphicon glyphicon-home"></span>
                Home
            </a>
        </div>
    </div>

<?php load('template/footer'); ?>