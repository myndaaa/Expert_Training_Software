<?php
if (isset($_POST['enqEmail'])  && !empty($_POST['enqEmail']) && isset($_POST['enqName'])  && !empty($_POST['enqName']) && isset($_POST['enqText'])  && !empty($_POST['enqText'])) {
    $connection = new mysqli('localhost', 'root', '', 'expert-db');
    $stmt = $connection->prepare("INSERT INTO feedbackHomepage (`name`, `email`, `text`) VALUES(?,?,?)");
    //die($connection->error);
    $name = addslashes($_POST['enqName']);
    $email = addslashes($_POST['enqEmail']);
    $text = addslashes($_POST['enqText']);
    $stmt->bind_param("sss", $name, $email, $text);
    if ($stmt->execute()) {
        echo json_encode(array('success' => 1));
    } else {
        echo json_encode(array('success' => 3));
    }
} else {
    echo json_encode(array('success' => 2));
}
