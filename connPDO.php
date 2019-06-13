<?php
	$pdo = new PDO('mysql:host=localhost;dbname=adventureworks', 'root', 'melancia');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, "SET NAMES 'utf8'");
	
	$target = $_GET['palavra'];
	
	($target == "") ? $condicao = "" : $condicao = "WHERE FirstName = '" . $target . "' OR LastName = '" . $target . "'";
	
	$tsql = "SELECT ContactId, Title, CONCAT(FirstName, ' ', LastName) AS FullName, ModifiedDate FROM contact " . $condicao;
 
    try {
        $pdoStatement = $pdo->query($tsql);
 
		echo "<table><tr><td>Id</td><td>Title</td><td>Name</td><td>Date upload</td></tr>";
        while($row = $pdoStatement->fetch(PDO::FETCH_ASSOC)){
 
			echo "<tr><td>{$row['ContactId']}</td><td>{$row['Title']}</td><td>{$row['FullName']}</td><td>{$row['ModifiedDate']}</td></tr>";
        }
		echo "</table>";
    } catch(Exception $e) {
        echo "Erro: {$e->getMessage()}";
    }

?>