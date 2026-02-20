<?php
// Temporary dev script to clear cart session
session_start();
unset($_SESSION['cart']);
session_destroy();
echo "Cart cleared! <a href='/'>Go to homepage</a>";
?>
