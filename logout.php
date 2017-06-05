<?
session_start();

session_destroy();

header( "Location: https://accounts.google.com/logout");
exit;

?>