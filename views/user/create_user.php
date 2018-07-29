<?php
    $createUserUrl = $urlPrefix . 'user/create';
?>

<h1>Register a new user</h1>

<?php
if(isset($confMsg)) {
    echo "<span class='label label-success def-shop-msg'>$confMsg</span>";
}
if(isset($errorMsg)) {
    echo "<span class='label label-danger def-shop-msg'>$errorMsg</span>";
}
?>

<form action="<?php echo $createUserUrl ?>" method="POST">
    <div class="input-group">
        <span class="input-group-addon">Email Address</span>
        <input type="text" class="form-control" id="email" name="email">
    </div>

    <div class="input-group">
        <span class="input-group-addon" id="basic-addon1">Name</span>
        <input type="text" class="form-control" id="name" name="name">
    </div>

    <div class="input-group">
        <span class="input-group-addon" id="basic-addon1">Password</span>
        <input type="password" class="form-control" id="password" name="password">
    </div>


    <button type="submit" class="btn btn-default">Submit</button>
</form>