<?php require('header.php'); ?>
<?php $fullView ? require('navbar.php') : '';?>

<div class="container" id="mainCont">
    <?php require('mainContRowMsg.php'); ?>
    <div class="row mx-auto" id="mainContRowContent" <?php if (!isset($_SESSION['addMessageMargin'])):?> style="margin-top: 40px" <?php endif; unset($_SESSION['addMessageMargin']) ?>>
        <div id="mainContentColumn" class="col-sm-12">
            <?php require($viewFile); ?>
        </div>
    </div>
</div>

<?php //require('testGettextLocale.php'); ?>

<?php require('footer.php'); ?>