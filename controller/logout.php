<?php
unset($_SESSION['auth']);
session_destroy();
redirect("index");
?>