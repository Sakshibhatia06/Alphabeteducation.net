<?php
$conn = new mysqli("localhost", "ivylkubd_sakshi", "ivyleagueindia@123", "ivylkubd_forum_database");
if ($conn->connect_error) { die("DB Error"); }

$post_id = intval($_GET['post_id']);

function showComments($parent_id, $conn, $post_id, $level = 0) {

    if ($parent_id === NULL) {
        $sql = "SELECT * FROM comments WHERE post_id=? AND parent_id IS NULL ORDER BY id DESC";
        $query = $conn->prepare($sql);
        $query->bind_param("i", $post_id);
    } else {
        $sql = "SELECT * FROM comments WHERE post_id=? AND parent_id=? ORDER BY id ASC";
        $query = $conn->prepare($sql);
        $query->bind_param("ii", $post_id, $parent_id);
    }

    $query->execute();
    $result = $query->get_result();

    while ($c = $result->fetch_assoc()) {

        echo "<div id='comment_".$c['id']."' style='margin-left:".($level * 25)."px; padding:8px;margin-bottom:10px;border-left:2px solid #eee'>";

        echo "<b>".htmlspecialchars($c['name'])."</b><br>";
        echo nl2br(htmlspecialchars($c['message']))."<br>";
        echo "<small style='color:#666;font-size:12px'>".$c['created_at']."</small><br>";

        echo "<a style='font-size:13px;color:#007bff;cursor:pointer;' onclick='replyToComment(".$c['id'].")'>Reply</a>";

        echo "<div id='replyBox_".$c['id']."' style='margin-top:6px;'></div>";

        echo "<div id='childReplies_".$c['id']."'>";
        showComments($c['id'], $conn, $post_id, $level + 1);
        echo "</div>";

        echo "</div>";
    }
}

showComments(NULL, $conn, $post_id);
?>

