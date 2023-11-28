<?php
session_start();
session_unset();
session_destroy();
//echo "<script>item already in cart</script>";
echo "<script>window.open('../index.php','_self')</script>";

?>