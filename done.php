<?php
echo "test";
	header('Content-Type: text/plain; charset=utf-8');
	
    $mysqli = new mysqli("localhost", "user", "pass", "putzplan");
	$mysqli->set_charset("utf8");

    if ($mysqli->connect_errno) {
        die("Verbindung fehlgeschlagen: " . $mysqli->connect_error);
    }
    
    $location = $_POST["location"];
	
	// update anmerkungen
    $sql = "UPDATE location SET Done = 1 WHERE Name = '".$location."'";
    $stmt = $mysqli->stmt_init();

    if ($stmt->prepare($sql)) {
        $OK = $stmt->execute();
        
		if ($OK) {
            echo "Erfolg\r\n";
			header('Location: https://patrickbollmann.de/putzplan/');
        } else {
            echo $stmt->error . "\r\n";
        }
    }

        $mysqli->close();
    
?>