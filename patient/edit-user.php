<?php
// Updates the logged-in patient's own details. Redirects back to settings.

session_start();

if (!isset($_SESSION["user"]) || $_SESSION["user"] == "" || $_SESSION["usertype"] != 'p') {
    header("location: ../login.php"); exit;
}

include("../connection.php");

if (!$_POST) {
    header("location: settings.php"); exit;
}

$currentEmail = $_SESSION["user"];
$name     = $_POST['name'];
$nic      = $_POST['nic'];
$address  = $_POST['address'];
$email    = $_POST['email'];
$tele     = $_POST['Tele'];
$password = $_POST['password'];
$cpassword = $_POST['cpassword'];
$postedId = (int) $_POST['id00'];

// The record is identified from the session, never from the form.
$me = $database->query("select pid from patient where pemail='{$database->esc($currentEmail)}' limit 1")->fetch_assoc();
if (!$me || (int) $me['pid'] !== $postedId) {
    header("location: settings.php?action=edit&error=3&id=" . $postedId); exit;
}
$id = (int) $me['pid'];

if ($password !== $cpassword) {
    $error = '2';
} else {
    // Email must not belong to another account.
    $taken = $database->query("select email from webuser where email='{$database->esc($email)}' and email!='{$database->esc($currentEmail)}' limit 1");
    if ($taken && $taken->num_rows > 0) {
        $error = '1';
    } else {
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $database->query("update patient set pemail='{$database->esc($email)}',pname='{$database->esc($name)}',ppassword='{$database->esc($hash)}',pnic='{$database->esc($nic)}',ptel='{$database->esc($tele)}',paddress='{$database->esc($address)}' where pid={$database->int($id)};");
        $database->query("update webuser set email='{$database->esc($email)}' where email='{$database->esc($currentEmail)}';");
        $_SESSION["user"] = $email;
        $error = '4';
    }
}

header("location: settings.php?action=edit&error=" . $error . "&id=" . $id); exit;
