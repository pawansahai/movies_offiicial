<?php
/**
 * Created by PhpStorm.
 * User: abhishekdubey
 * Date: 6/17/14
 * Time: 12:33 PM
 */
require("constant.php");
$con=mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
if (mysqli_errno($con)) {
    echo "Failed to connect to mysql: " . mysqli_error($con);
}

?>