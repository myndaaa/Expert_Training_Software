<?php
if (isset($_POST['email'])  && !empty($_POST['email']) && isset($_POST['name'])  && !empty($_POST['name']) && isset($_POST['msg'])  && !empty($_POST['msg'])) {
    $connection = new mysqli('localhost', 'root', '', 'expert-db');
    $stmt = $connection->prepare("INSERT INTO customerReview (`name`, `email`, `msg`) VALUES(?,?,?)");
    //die($connection->error);
    $name = addslashes($_POST['name']);
    $email = addslashes($_POST['email']);
    $msg = addslashes($_POST['msg']);
    $stmt->bind_param("sss", $name, $email, $msg);
    if ($stmt->execute()) {
        echo json_encode(array('success' => 1));
    } else {
        echo json_encode(array('success' => 3));
    }
} else {
    echo json_encode(array('success' => 2));
}
