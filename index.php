<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require './PHPMailer/src/Exception.php';
require './PHPMailer/src/PHPMailer.php';
require './PHPMailer/src/SMTP.php';

if (isset($_POST['send'])) {
    $name = htmlentities($_POST['name']);
    $senderEmail = htmlentities($_POST['email']); // User's email as sender
    $subject = htmlentities($_POST['subject']);
    $message = htmlentities($_POST['message']);

    $receiverEmail = $senderEmail; // Use user's input email as receiver's email

    $mail = new PHPMailer(true);
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'trisakay977@gmail.com';
    $mail->Password = 'grintluwuzhcpelt';
    $mail->Port = 465;
    $mail->SMTPSecure = 'ssl';
    $mail->isHTML(true);
    $mail->setFrom($senderEmail, $name);
    $mail->addAddress($receiverEmail);
    $mail->Subject = $subject;
    $mail->Body = $message;

    try {
        $mail->send();
        header("Location: ./index.php?status=email_sent");
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
?>

<html>
<head>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/allencasul/lonica@d9dbccfa5b0a4666760e4f72b28effa775c56857/css/cdn/lonica.css" integrity="sha256-E1S8yAbnRZ6uM4sA6NMSgTyoDsdK1ZCjBYF3lqXqv6Q=" crossorigin="anonymous">
  <script src="https://kit.fontawesome.com/1e8d61f212.js"></script>
</head>
<body class="center-absolute">
  <h1>test1</h1>
  <form class="display-grid row-gap-1-rem" method="post">
    <input class="box-shadow-primary" name="name" type="text" placeholder="Name" autocomplete="off" required />
    <input class="box-shadow-primary" name="email" type="email" placeholder="Email" autocomplete="off" required />
    <input class="box-shadow-primary" name="subject" type="text" placeholder="Subject" autocomplete="off" required />
    <textarea class="box-shadow-primary" name="message" placeholder="Message..." required></textarea>
    <button type="submit" name="send">
      Send <i class="fa-solid fa-paper-plane color-white margin-left-1-rem"></i>
    </button>
  </form>
</body>
</html>
