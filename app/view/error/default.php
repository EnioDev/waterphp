<!-- view/template/header.php -->
<body class="padding-20">
    <div class="container">
        <div class="well text-center">
            <div class="alert alert-danger padding-20">
                <h1 class="no-margin"><?php echo $title; ?></h1>
            </div>
            <div class="alert alert-info text-left">
                <?php echo $message; ?>
            </div>
            <a href="<?php echo BASE_URL . $this->getControllerName(); ?>" class="btn btn-default">
                <span class="glyphicon glyphicon-remove"></span>
                Close
            </a>
        </div>
    </div>
<!-- view/template/footer.php -->