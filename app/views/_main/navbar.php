<?php use DropLine\Utils\Encode; ?>

<div class="container-fluid px-0">
    <nav class="navbar navbar-expand-md navbar-light" style="background-color:#f8f8f8; padding-left: 50px; padding-right: 50px">
        <!-- Navbar left side -->
<!--        <a class="navbar-brand" href="--><?php //echo ROOT_URL; ?><!--">DropLine</a>-->
        <a class="navbar-brand" href="/">DropLine</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
<!--                    <a class="nav-link" href="--><?php //echo ROOT_URL; ?><!--drops">Drops</a>-->
                    <a class="nav-link" href="/drops">Drops</a>
                </li>
                <li class="nav-item">
<!--                    <a class="nav-link" href="--><?php //echo ROOT_URL; ?><!--activities">Activity</a>-->
                    <a class="nav-link" href="/activities">Activity</a>
                </li>
                <li class="nav-item">
<!--                    <a class="nav-link" href="--><?php //echo ROOT_URL; ?><!--wordcloud">Word Cloud</a>-->
                    <a class="nav-link" href="/wordcloud">Word Cloud</a>
                </li>
            </ul>
            <!-- Navbar right side -->
            <ul class="navbar-nav">
                <!--Select language-->
<!--                <li class="nav-item dropdown">-->
<!--                    <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">English</a>-->
<!--                    <div class="dropdown-menu">-->
<!--                        <a class="dropdown-item" href="#">English</a>-->
<!--                        <a class="dropdown-item" href="#">Slovenian</a>-->
<!--                    </div>-->
<!--                </li>-->
                <?php if (isset($_SESSION['is_logged_in'])) : ?>
                    <li class="nav-item">
<!--                        <a class="nav-link" href="--><?php //echo ROOT_URL; ?><!--">Welcome --><?php //echo Encode::html($_SESSION['user_data']['name']); ?><!--</a>-->
                        <a class="nav-link" href="/">Welcome <?php echo Encode::html($_SESSION['user_data']['name']); ?></a>
                    </li>
                    <li class="nav-item">
<!--                        <a class="nav-link" href="--><?php //echo ROOT_URL; ?><!--users/logout">Logout</a>-->
                        <a class="nav-link" href="/users/logout">Logout</a>
                    </li>
                <?php else : ?>
                    <li class="nav-item">
<!--                        <a class="nav-link" href="--><?php //echo ROOT_URL; ?><!--users/login">Login</a>-->
                        <a class="nav-link" href="/users/login">Login</a>
                    </li>
                    <li class="nav-item">
<!--                        <a class="nav-link" href="--><?php //echo ROOT_URL; ?><!--users/register">Register</a>-->
                        <a class="nav-link" href="/users/register">Register</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </nav>
</div>