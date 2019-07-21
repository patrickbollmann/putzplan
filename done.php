<?php
echo "test";
	header('Content-Type: text/plain; charset=utf-8');
	
    $mysqli = new mysqli("localhost", "user", "pass", "putzplan");
	$mysqli->set_charset("utf8");

    if ($mysqli->connect_errno) {
        die("Verbindung fehlgeschlagen: " . $mysqli->connect_error);
    }
	
    $sql = "SELECT scheduleid FROM `schedule` WHERE date = (SELECT MAX(date) FROM schedule)";
    $result = $mysqli->query($sql);
	while ($row = $result->fetch_assoc()) {
		$scheduleid = $row["scheduleid"];
		echo $scheduleid;
	}
    $location = $_POST["location"];
	echo $location;
	
    $sql = "UPDATE done SET ".$location." = 1 WHERE scheduleid = ".(string)$scheduleid;
    $stmt = $mysqli->stmt_init();

    if ($stmt->prepare($sql)) {
        $OK = $stmt->execute();
		$last = $mysqli->insert_id;
        
		if ($OK) {
            $adresse_id = $mysqli->insert_id;
            echo "Erfolg\r\n";
			header('Location: https://patrickbollmann.de/putzplan/');
        } else {
            echo $stmt->error . "\r\n";
        }
    }

        $mysqli->close();
    
?>