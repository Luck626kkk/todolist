<?php

	try{
		 $pdo = new PDO("mysql:host=localhost;dbname=todolist_demo;port=3306;charset=utf8",'Luck','12345678');
		}catch(PDOException $e){
			echo "Database connection failed";
			exit;
		}
	$sql = 'SELECT * FROM todos ORDER BY orders ASC';
	$statement = $pdo->prepare($sql);
	$statement->execute();
	$todos = $statement->fetchAll(PDO::FETCH_ASSOC);
?>