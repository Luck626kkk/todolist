<?php

	try{
		 $pdo = new PDO("mysql:host=localhost;dbname=todolist_demo;port=3306;charset=utf8",'Luck','12345678');
		}catch(PDOException $e){
			echo "Database connection failed";
			exit;
		}
	$sql = 'UPDATE todos SET content=:content WHERE id=:id';
	$statement = $pdo->prepare($sql);
	$statement ->bindValue(':content',$_POST['content'], PDO::PARAM_STR);
	$statement ->bindValue(':id', $_POST['id'], PDO::PARAM_INT);
	$result = $statement->execute();
	
	if(!$result){
		echo "error";
	}
?>