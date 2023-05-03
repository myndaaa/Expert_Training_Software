<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $email = $_POST['email'];
  $message = $_POST['message'];
  $subject = 'OTP code';
  $headers = 'From: noreply@example.com' . "\r\n" .
             'Reply-To: noreply@example.com' . "\r\n" .
             'X-Mailer: PHP/' . phpversion();

  if (mail($email, $subject, $message, $headers)) {
    http_response_code(200);
  } else {
    http_response_code(500);
  }
} else {
  http_response_code(400);
}
?>
