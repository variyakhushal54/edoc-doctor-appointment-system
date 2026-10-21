<?php
// Admin updates an existing doctor's details. Redirects back to the doctors list.

session_start();

if (!isset($_SESSION["user"]) || $_SESSION["user"] == "" || $_SESSION["usertype"] != 'a') {
    header("location: ../login.php"); exit;
}

include("../connection.php");

if (!$_POST) {
    header("location: doctors.php"); exit;
}

$name      = $_POST['name'];
$nic       = $_POST['nic'];
$oldemail  = $_POST['oldemail'];
$spec      = (int) $_POST['spec'];
$email     = $_POST['email'];
$tele      = $_POST['Tele'];
$password  = $_POST['password'];
$cpassword = $_POST['cpassword'];
$id        = (int) $_POST['id00'];

$exists = $database->query("select docid from doctor where docid={$database->int($id)} and docemail='{$database->esc($oldemail)}' limit 1");
if (!$exists || $exists->num_rows != 1) {
    $error = '3';
} elseif ($password !== $cpassword) {
    $error = '2';
} else {
    $taken = $database->query("select email from webuser where email='{$database->esc($email)}' and email!='{$database->esc($oldemail)}' limit 1");
    if ($taken && $taken->num_rows > 0) {
        $error = '1';
    } else {
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $database->query("update doctor set docemail='{$database->esc($email)}',docname='{$database->esc($name)}',docpassword='{$database->esc($hash)}',docnic='{$database->esc($nic)}',doctel='{$database->esc($tele)}',specialties={$database->int($spec)} where docid={$database->int($id)};");
        $database->query("update webuser set email='{$database->esc($email)}' where email='{$database->esc($oldemail)}';");
        $error = '4';
    }
}

header("location: doctors.php?action=edit&error=" . $error . "&id=" . $id); exit;
