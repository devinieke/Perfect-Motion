<?php
    function redirect_to($new_location)
    {
        header("Location: " .$new_location);
        exit;
    }

    function mysql_prep($string)
    {
        global $connection;

        $escaped_string = mysqli_real_escape_string($connection, $string);
        return $escaped_string;
    }
 ?>
