<?php
    if(isset($confMsg)) {
        echo "<span class='label label-success def-shop-msg'>$confMsg</span>";
    }
    if(isset($errorMsg)) {
        echo "<span class='label label-danger def-shop-msg'>$errorMsg</span>";
    }
?>