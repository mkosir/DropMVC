<?php use DroplineMVC\Utils\Encode; ?>
<div>
    <div class="card" style="margin-bottom: 30px">
        <div class="card-header">
            <small>Dropped by:
                <?php echo str_repeat('&nbsp;', 1);
                echo Encode::html($data['user_name']);
                echo str_repeat('&nbsp;', 3);
                echo Encode::html($data['create_date']); ?>
                <?php if (isset($_SESSION['user_data']['id'])) : ?>
                    <?php if ($_SESSION['user_data']['id'] === $data['user_id']) : ?>
                        <a class="card-link" href="<?php echo Encode::html($data['link']); ?>" style="margin-left: 10px">Edit</a>
                        <a class="card-link" href="<?php echo Encode::html($data['link']); ?>" style="margin-left: 7px">Delete</a>
                    <?php endif; ?>
                <?php endif; ?>
                <span style="float:right; color:#a7a7a7">ID:
                    <?php echo str_repeat('&nbsp;', 1);
                    echo "#";
                    echo Encode::html($data['id']); ?>
                </span>
            </small>
        </div>
        <div class="card-body bg-light">
            <h5 class="card-title"><?php echo Encode::html($data['title']); ?></h5>
            <p class="card-text"><?php echo Encode::html($data['body']); ?></p>
            <hr/>
            <a class="card-link" href="<?php echo Encode::html($data['link']); ?>" target="_blank">Go To Website</a>
        </div>
    </div>
</div>