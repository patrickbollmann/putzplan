<?php
header('Content-Type: text/plain; charset=utf-8');
include "../secret/secret.php";
$mysqli = new mysqli("localhost", $dbuser, $dbpass, "putzplan");
$mysqli->set_charset("utf8");

if ($mysqli->connect_errno) {
    die("Verbindung fehlgeschlagen: " . $mysqli->connect_error);
}

$name = $_POST["name"];
$amount = $_POST["amount"];
if ($amount == "Eine Woche") {
    $weeks = 0;
}
if ($amount == "Zwei Wochen") {
    $weeks = -1;
}
if ($amount == "Drei Wochen") {
    $weeks = -2;
}
if ($amount == "Vier Wochen") {
    $weeks = -3;
}

$sql = "UPDATE person SET active = $weeks WHERE name = '" . $name . "'";
$stmt = $mysqli->stmt_init();

if ($stmt->prepare($sql)) {
    $OK = $stmt->execute();
    $last = $mysqli->insert_id;

    if ($OK) {
        $adresse_id = $mysqli->insert_id;
        header('Location: https://patrickbollmann.de/putzplan/');
    } else {
        echo $stmt->error . "\r\n";
    }
}
$mysqli->close();
