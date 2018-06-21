<?php
	header('Content-Type: application/json; charset=utf-8');
	
	try{
		$pdo = new PDO("mysql:host=localhost;dbname=todolist_demo;port=3306;charset=utf8",'Luck','12345678');
	} catch(PDOException $e){
		echo "Database connection failed";
		exit;
	}

	$sql= 'INSERT INTO todos (content, is_complete, orders)
			VALUES(:content, :is_complete, :orders)';
	$statement = $pdo->prepare($sql);
	$statement ->bindValue(':content',$_POST['content'], PDO::PARAM_STR);
	$statement ->bindValue(':is_complete', 0, PDO::PARAM_INT);
	$statement ->bindValue(':orders',$_POST['orders'], PDO::PARAM_INT);
	$result = $statement -> execute();	

	if($result){
		echo json_encode(['id'=>$pdo->lastInsertId()]);
	}else{
		var_dump($pdo->errorInfo());
	}

	//$_POST['todo'];


?>