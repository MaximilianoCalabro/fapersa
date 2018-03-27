<?
// KILL SESSIONS
$_SESSION[SESSION_ADMIN] = array();
unset($_SESSION[SESSION_ADMIN]);

header("Location: index.php");
exit;
?>