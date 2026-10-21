<?php
// Cancels one of the logged-in patient's own bookings.

session_start();

if (!isset($_SESSION["user"]) || $_SESSION["user"] == "" || $_SESSION["usertype"] != 'p') {
    header("location: ../login.php"); exit;
}

include("../connection.php");

if ($_GET) {
    $me = $database->query("select pid from patient where pemail='{$database->esc($_SESSION["user"])}' limit 1")->fetch_assoc();
    if ($me && isset($_GET["id"])) {
        $database->query("delete from appointment where appoid={$database->int($_GET["id"])} and pid={$database->int($me["pid"])};");
    }
    header("location: appointment.php"); exit;
}
