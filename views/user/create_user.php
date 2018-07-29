<?php
    $createUserUrl = $urlPrefix . 'user/create';
?>

<h1>Register a new user</h1>

<form action="<?php echo $createUserUrl ?>" method="POST">
    <div class="input-group">
        <span class="input-group-addon">Email Address</span>
        <input type="text" class="form-control">
    </div>

    <div class="input-group">
        <span class="input-group-addon" id="basic-addon1">User Name</span>
        <input type="text" class="form-control">
    </div>

    <div class="input-group">
        <span class="input-group-addon" id="basic-addon1">Password</span>
        <input type="password" class="form-control">
    </div>


    <button type="submit" class="btn btn-default">Submit</button>
</form>