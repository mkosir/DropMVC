<?php use DroplineMVC\Utils\Encode; ?>
<div>
    <?php if (isset($_SESSION['is_logged_in'])) : ?>
        <a class="btn btn-success btn-drop" href="/drops/add">Drop a line!</a>
    <?php endif; ?>
    <?php foreach ($data as $dataItem) : ?>
    <div class="card" style="margin-bottom: 30px">
        <div class="card-header">
            <small>Dropped by:
                <?php echo str_repeat('&nbsp;', 1);
                echo Encode::html($dataItem['user_name']);
                echo str_repeat('&nbsp;', 3);
                echo Encode::html($dataItem['create_date']); ?>
                <?php if (isset($_SESSION['user_data']['id'])) : ?>
                    <?php if ($_SESSION['user_data']['id'] === $dataItem['user_id']) : ?>
                        <a class="card-link" href="<?php echo "/drops/edit/" . Encode::html($dataItem['id']); ?>" style="margin-left: 10px">Edit</a>
                        <a class="card-link" href="<?php echo "/drops/delete/" . Encode::html($dataItem['id']); ?>" style="margin-left: 7px">Delete</a>
                    <?php endif; ?>
                <?php endif; ?>
                <span style="float:right; color:#a7a7a7">ID:
                    <?php echo str_repeat('&nbsp;', 1);
                    echo "#";
                    echo Encode::html($dataItem['id']); ?>
                </span>
            </small>
        </div>
        <div class="card-body bg-light">
            <h5 class="card-title"><?php echo Encode::html($dataItem['title']); ?></h5>
            <p class="card-text"><?php echo Encode::html($dataItem['body']); ?></p>
            <hr/>
            <a class="card-link" href="<?php echo Encode::html($dataItem['link']); ?>" target="_blank">Go To Website</a>
        </div>
    </div>
    <?php endforeach; ?>
</div>