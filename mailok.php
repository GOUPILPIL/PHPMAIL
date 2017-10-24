<!doctype html>
<html>
  <head>
    <meta charset="utf-8">
  </head>
  <body>
    <header class="card with-background">
      <h1>YOURNAME<strong> hi</strong></h1>
    </header>
    <main>
      <?php
        // HEADER
        date_default_timezone_set('Etc/UTC');
        use PHPMailer\PHPMailer\PHPMailer;
        use PHPMailer\PHPMailer\Exception;
        require './PHPMailer/src/phpmailer.php'; // CHECK PASS TO PHPMAILER !!!!!!!!!!!!!
        require './PHPMailer/src/Exception.php'; // SAME
        require './PHPMailer/src/SMTP.php';     // SAME
        // HEADER

        $name = $replyto = $message = null;
        // récupération des valeurs dans $_POST

        if(isset($_POST["name"], $_POST["_replyto"], $_POST["message"])) {
            $name = $_POST["name"];
            $replyto = $_POST["_replyto"];
            $message = $_POST["message"];
        }
        // validation des valeurs

        if($name && $replyto && $message) { // Check if there is no NULL value inside input post
            echo "vous avez rentré $name<br>";
            echo "vous avez rentré $replyto<br>";
            echo "vous avez rentré $message<br>";
            
            if (filter_var($replyto, FILTER_VALIDATE_EMAIL)) 
            {
            $mail = new PHPMailer(true);
            try {
            //Server settings
            $mail->SMTPDebug = 1;                                 // Enable verbose debug output
            $mail->isSMTP();                                      // Set mailer to use SMTP
            $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
            $mail->SMTPAuth = true;                               // Enable SMTP authentication
            $mail->Username = 'X@gmail.com';                 // SMTP username X IS YOUR EMAIL
            $mail->Password = 'X';                           // SMTP password X IS YOUR PASSWORD
            $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
            $mail->Port = 587;                                    // TCP port to connect to
            //Recipients
            $mail->setFrom('X@gmail.com', 'X'); // X IS YOUR EMAIL
            $mail->addAddress($replyto, $name);               // Name is optional, email
           // $mail->addReplyTo('vibucho@gmail.com', 'Information');
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = 'Here is the subject';
            $mail->Body    = $message;
            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            $mail->send(); // SEND EMAIL
            echo 'Message has been sent';
        } catch (Exception $e) {
            echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        }
      } else {
        echo "EMAIL IS INVALID";
      }
    }
        
      ?> 
    </main>
    <footer class="card">
      <form class="burger" action="" method="post">
        <div class="bun-top">
          <label for="name">Votre nom</label><input id="name" type="text" name="name" value="<?php if($name) echo $name; ?>">
        </div>
        <div class="patty">
          <label for="email">Votre email</label><input id="email" type="email" name="_replyto" value="<?php if($replyto) echo $replyto; ?>">
        </div>
        <div class="bun-bottom">
          <label for="message">Votre message</label><textarea id="message" name="message"><?php if($message) echo $message; ?></textarea>
        </div>
        <div class="plate">
          <input type="submit" value="Envoyer">
        </div>
      </form>
    </footer>
  </body>
</html>