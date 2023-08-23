<?php
@session_start();
@setcookie("token", "");
@setcookie(session_name(), '', 0, '/');
@session_unset();
@session_write_close();
@session_regenerate_id(true);
@session_destroy();
header('location: /login');
exit();
?>