<?php
$conn = new mysqli("localhost", "ivylkubd_sakshi", "ivyleagueindia@123", "ivylkubd_forum_database");
if ($conn->connect_error) { die("DB connection failed"); }

$post_id   = $_POST['post_id'];
$parent_id = !empty($_POST['parent_id']) ? $_POST['parent_id'] : NULL;
$name      = $_POST['name'];
$email     = $_POST['email'];
$message   = $_POST['message'];

$stmt = $conn->prepare("INSERT INTO comments (post_id, parent_id, name, email, message) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("iisss", $post_id, $parent_id, $name, $email, $message);
$stmt->execute();
$stmt->close();

header("Location: " .$_SERVER['HTTP_REFERER']);
exit;
?>
