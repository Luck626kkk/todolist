<?php

	try{
		 $pdo = new PDO("mysql:host=localhost;dbname=todolist_demo;port=3306;charset=utf8",'Luck','12345678');
		}catch(PDOException $e){
			echo "Database connection failed";
			exit;
		}

	// load todo
	$sql = 'SELECT is_complete FROM todos WHERE id=:id';
	$statement = $pdo->prepare($sql);
	$statement ->bindValue(':id', $_POST['id'], PDO::PARAM_INT);
	$result = $statement->execute();
	$todo = $statement->fetch(PDO::FETCH_ASSOC);
	
	// save
	$sql = ' UPDATE todos SET is_complete=:is_complete WHERE id=:id';
	$statement = $pdo->prepare($sql);
	$statement ->bindValue(':id', $_POST['id'], PDO::PARAM_INT);
	$statement ->bindValue(':is_complete', !$todo['is_complete'], PDO::PARAM_INT);
	$result = $statement->execute();

	#$complete = !$todo['is_complete'];
	
	if($result){
		echo json_encode(['id'=>$_POST['id'], 'is_complete'=>!$todo['is_complete']]);
	}else{
		echo "error";
	}
?>