<?php
   use PHPMailer\PHPMailer\PHPMailer;
   use PHPMailer\PHPMailer\Exception;

   require 'phpmailer/src/Exception.php';
   require 'phpmailer/src/PHPMailer.php';
   require 'phpmailer/src/SMTP.php';

   // Instantiation and passing `true` enables exceptions   
   $mail = new PHPMailer(true);
   $mail->CharSet = 'UTF-8';
   $mail->setLanguage('ru', 'phpmailer/language/');
   $mail->IsHTML(true);


   //Server settings
   $mail->SMTPDebug = 0;                      // Enable verbose debug output
   $mail->isSMTP();                                            // Send using SMTP
   $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
   $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
   $mail->Username   = 'pendulumplay@gmail.com';                     // SMTP username
   $mail->Password   = 'vkowockfoyuiirfb';                               // SMTP password
   $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
   $mail->Port       = 465; 

   //Recipients
   //От кого письмо
   $mail->setFrom('pendulumplay@gmail.com', 'ПромАльпСервіс');
   //Кому отправить
   $mail->addAddress('promservisalp@gmail.com');

   //Тема письма
   $mail->Subject = 'ПромАльпСервіс';

   //Тело письма
   $body = '<h1>Заявка на ПромАльпСервіс</h1>';

   if (trim(!empty($_POST['name']))) {
      $body.='<p><strong>Імя:</strong> '.$_POST['name'].'</p>';
   }
   if (trim(!empty($_POST['phone']))) {
      $body.='<p><strong>Телефон:</strong> '.$_POST['phone'].'</p>';
   }
   // if (trim(!empty($_POST['email']))) {
   //    $body.='<p><strong>Email:</strong> '.$_POST['email'].'</p>';
   // }
   // if (trim(!empty($_POST['silver']))) {
   //    $body.='<p><strong>Тариф:</strong> '.$_POST['silver'].'</p>';
   // }
   // if (trim(!empty($_POST['gold']))) {
   //    $body.='<p><strong>Тариф:</strong> '.$_POST['gold'].'</p>';
   // }
   // if (trim(!empty($_POST['diamond']))) {
   //    $body.='<p><strong>Тариф:</strong> '.$_POST['diamond'].'</p>';
   // }

   $mail->Body = $body;

   //ОТправляем
   if (!$mail->send()) {
      $message = 'Помилка';
   } else {
      $message = 'Дані надіслані!';
   }

   $response = ['message' => $message];

   header('Content-type: application/json');
   echo json_encode($response);
?>
   