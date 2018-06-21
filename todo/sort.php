<?php

	try{
		 $pdo = new PDO("mysql:host=localhost;dbname=todolist_demo;port=3306;charset=utf8",'Luck','12345678');
		}catch(PDOException $e){
			echo "Database connection failed";
			exit;
		}

	foreach ($_POST['orderPair'] as $key => $orderPair){
		#$orderPair['id']
		#$orderPair['order']

		$sql = 'UPDATE todos SET orders=:orders WHERE id=:id'; #14.15行可以擺在外面
		$statement = $pdo->prepare($sql);
		$statement ->bindValue(':orders',$orderPair['order'], PDO::PARAM_INT);
		$statement ->bindValue(':id', $orderPair['id'], PDO::PARAM_INT);
		$result = $statement->execute();
	}

	
	
	if(!$result){
		echo "error";
	}
?>