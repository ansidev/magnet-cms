<div class="row">
    <div class="col-lg-12">
        <?php if (!empty($_SESSION['messages'])) {
            foreach ($_SESSION['messages'] as $message) { ?>
                <div class="alert alert-warning alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <?php
                    echo $message;
                    array_shift($_SESSION['messages']);
                    ?>
                </div>
                <?php
            }
        }
        ?>
    </div>
    <!-- /.col-lg-12 -->
</div>

