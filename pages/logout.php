<!-- fungsi logout -->
<?php
session_start();
session_unset();
session_destroy();
header("Location: /web-lib/index.php");
exit();
