<?php
$createUserUrl = $urlPrefix . 'user/create';
$loginUrl = $urlPrefix . 'login';
?>

<h1>Log In</h1>

<?php
    include ROOT . "views/layout/messages.php";
?>

<form action="<?php echo $loginUrl ?>" method="GET">
    <div class="input-group">
        <span class="input-group-addon">Email Address</span>
        <input type="text" class="form-control" id="email" name="email">
    </div>

    <div class="input-group">
        <span class="input-group-addon" id="basic-addon1">Password</span>
        <input type="password" class="form-control" id="password" name="password">
    </div>


    <button type="submit" class="btn btn-default">Submit</button>
</form>