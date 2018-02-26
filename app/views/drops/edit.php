<?php use DroplineMVC\Utils\Encode; ?>
<?php use DroplineMVC\Utils\HTTP; ?>
<div class="card">
    <div class="card">
        <div class="card-header"><h4>Edit Drop!</h4></div>
        <div class="card-body">
            <form method="post" action="">
                <div class="form-group">
                    <label for="title">Title</label>
<!--                    $_POST['title'] ?? ''; Null Coalescing Operator - the same as (isset($_POST['title'])) ? $_POST['title'] : '';-->
<!--                    <input type="text" id="title" name="title" class="form-control" value="--><?php //echo Encode::html($_POST['title'] ?? '');?><!--"/>-->
                    <input type="text" id="title" name="title" class="form-control" value="<?php if (HTTP::reqIsGET()) {echo Encode::html($data['title']);} else {echo Encode::html($_POST['title']);} ?>"/>
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
<!--                    <textarea id="description" name="body" class="form-control" style="min-height: 140px">--><?php //echo Encode::html($_POST['body'] ?? '');?><!--</textarea>-->
                    <textarea id="description" name="body" class="form-control" style="min-height: 140px"><?php if (HTTP::reqIsGET()) {echo Encode::html($data['body']);} else {echo Encode::html($_POST['body']);} ?></textarea>
                </div>
                <div class="form-group">
                    <label for="link">Link</label>
<!--                    <input type="text" id="link" name="link" class="form-control" value="--><?php //echo Encode::html($_POST['link'] ?? '');?><!--"/>-->
                    <input type="text" id="link" name="link" class="form-control" value="<?php if (HTTP::reqIsGET()) {echo Encode::html($data['link']);} else {echo Encode::html($_POST['link']);} ?>"/>
                </div>
                <input type="submit" name="submitEditDrop" value="Submit" class="btn btn-success" style="margin-right: 5px"/>
                <a class="btn btn-secondary" href="/drops">Cancel</a>
            </form>
        </div>
    </div>
</div>