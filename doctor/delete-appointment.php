<?php
// Removes a booking from one of the logged-in doctor's own sessions.

session_start();

if (!isset($_SESSION["user"]) || $_SESSION["user"] == "" || $_SESSION["usertype"] != 'd') {
    header("location: ../login.php"); exit;
}

include("../connection.php");

if ($_GET) {
    $me = $database->query("select docid from doctor where docemail='{$database->esc($_SESSION["user"])}' limit 1")->fetch_assoc();
    if ($me && isset($_GET["id"])) {
        $database->query("delete from appointment where appoid={$database->int($_GET["id"])} and scheduleid in (select scheduleid from schedule where docid='{$database->esc($me["docid"])}');");
    }
    header("location: appointment.php"); exit;
}
