<?php if ($fullView) : ?>
    <?php if (isset($_SESSION[MSG::USER_ERROR]) or isset($_SESSION[MSG::USER_SUCCESS]) or isset($_SESSION[MSG::DEVELOPMENT_ERROR])) : ?>
        <div class="row mx-auto" id="mainContRowMsg">
            <div class="col-sm-12" style="margin-top: 40px">
                <?php DroplineMVC\Utils\Messages::display(); ?>
                <?php $_SESSION['addMessageMargin'] = true; ?>
            </div>
        </div>
    <?php endif; ?>
<?php else : ?>
    <?php if(isset($_SESSION[MSG::USER_ERROR])) : unset($_SESSION[MSG::USER_ERROR]); endif;?>
    <?php if(isset($_SESSION[MSG::USER_SUCCESS])) : unset($_SESSION[MSG::USER_SUCCESS]); endif;?>
    <?php if(isset($_SESSION[MSG::DEVELOPMENT_ERROR])) : unset($_SESSION[MSG::DEVELOPMENT_ERROR]); endif;?>
<?php endif; ?>