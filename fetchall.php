<?php
require_once "pdo.php";
$sql="SELECT * FROM users where email = :e";
$stmt=$pdo->prepare($sql);
$stmt->execute(array(
    ':e' => "deeptimaanbanerjee@gmail.com",
));
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
print_r($rows);
echo("<br>");
foreach ($rows as $row)
{
    print_r($row);
    echo("<br>");
}