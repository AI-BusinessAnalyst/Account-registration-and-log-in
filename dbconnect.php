<?php
try
{
    $conn = new PDO('mysql:host=db.cs.dal.ca;dbname=tvo', 'tvo', 'B00782065');
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conn->exec('SET NAMES "utf8"');
}
catch (PDOException $e)
{
    echo "Unable to connect to the database server.".$e->getMessage();
    exit();
}
?>
