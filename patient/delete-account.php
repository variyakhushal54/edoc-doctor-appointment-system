<?php
// Deletes the logged-in patient's own account and bookings.

session_start();

if (!isset($_SESSION["user"]) || $_SESSION["user"] == "" || $_SESSION["usertype"] != 'p') {
    header("location: ../login.php"); exit;
}
$useremail = $_SESSION["user"];

include("../connection.php");

$me = $database->query("select pid, pemail from patient where pemail='{$database->esc($useremail)}' limit 1")->fetch_assoc();
if (!$me) {
    header("location: ../login.php"); exit;
}

// Only the account owner may delete it.
if (!isset($_GET["id"]) || (int) $_GET["id"] !== (int) $me["pid"]) {
    header("location: settings.php"); exit;
}

$pid = (int) $me["pid"];
$database->query("delete from appointment where pid={$database->int($pid)};");
$database->query("delete from webuser where email='{$database->esc($useremail)}';");
$database->query("delete from patient where pid={$database->int($pid)};");

header("location: ../logout.php"); exit;
