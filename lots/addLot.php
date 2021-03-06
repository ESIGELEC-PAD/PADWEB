<?php
	include("../dbConnection.php");

	session_start();

    //Must be logged into create a new lot
	if(isset($_SESSION['valUser'])) {
		//Description of this new lot
        $location = $_POST['location'];
        $pKey = uniqid('',true);
        
		$dbConnection = database_connection();
		
        //Create this new lot in the DB
		$statement = $dbConnection->prepare("INSERT INTO parking_lot (location, pKey, user_id) VALUES (:location, :pKey, :user_id)");
		$statement->bindParam(':location', $location);
        $statement->bindParam(':pKey', $pKey);
        $statement->bindParam(':user_id', $_SESSION['user_id']);
		$statement->execute();
        
        header('Location: ' . "../admin.php");
    }
?>