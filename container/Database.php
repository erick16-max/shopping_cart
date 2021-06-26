<?php
 $db = mysqli_connect('localhost', 'root', '') or
        die (mysqli_error($db));
        mysqli_select_db($db, 'shopping-cart' ) or die(mysqli_error($db));
?>