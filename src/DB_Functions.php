<?php
require_once 'Database.php';
$db = new DataBase();
$conn = $db->getConnection();

function select_limit($table,$order,$limit)
{
    global $conn;
    $query = "SELECT * FROM $table ORDER BY id $order LIMIT $limit";
    return mysqli_query($conn,$query);
}
function getrow($table,$id)
{
    global $conn;
    $query = "SELECT * FROM `$table` WHERE id = '$id'";
    $res = mysqli_query($conn,$query);
    return mysqli_fetch_assoc($res);
}
function sum_price($table)
{
    global $conn;
    $query = "SELECT SUM(price) AS total FROM `$table`";
    $res = mysqli_query($conn,$query);
    $row = mysqli_fetch_assoc($res);
    
    return $row['total'];
}
function last_id($table)
{
    
}