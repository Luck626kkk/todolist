 <?php 
 	echo "<p>Hello World</p>"; 
 	$fruit =['apple' => 'red', 'lemon' => 'green', 'pineapple' => 'yellow'];
 	echo 'my favoirte fruit is';
 	echo '<ul>';
 	foreach ($fruit as $key => $value) {
 		echo "<li>$key</li>";
 	}
 	echo'</ul>';

 ?>