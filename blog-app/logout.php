<?php
session_start();
session_destroy();
header("Location: index.php?tab=login");
exit();
