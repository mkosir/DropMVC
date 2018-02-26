<?php use DroplineMVC\Utils\Encode; ?>
<div class="card">
    <div class="card-header">Register User</div>
    <div class="card-body">
        <form method="post" action="">
            <div class="form-group">
                <label>Name</label>
                <input type="text" name="name" class="form-control" value="<?php echo Encode::html($_POST['name'] ?? '');?>"/>
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="text" name="email" class="form-control" value="<?php echo Encode::html($_POST['email'] ?? '');?>"/>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control"/>
            </div>
            <input type="submit" name="submitRegister" value="Submit" class="btn btn-primary"/>
        </form>
    </div>
</div>