<?php
if(isset($_POST['submit'])){
    ini_set('SMTP','smtp.gmail.com');
    ini_set('sendmail_from', 'brunetenzo79@gmail.com');
    
    ini_set( 'display_errors', 1 );
    error_reporting( E_ALL );
    $from = "brunetenzo79@gmail.com";
    $to = "enzo.brunet@epitech.eu";
    $subject = "Essai de PHP Mail";
    $message = "PHP Mail fonctionne parfaitement";
    $headers = "De :" . $from;
    mail($to,$subject,$message, $headers);
    echo "L'email a été envoyé.";


mail('brunetenzo79@gmail.com', 'Mon Sujet', $message);

// $name = $_POST['Name'];
// $from = $_POST['Email']; // this is the sender's Email address
// $msg = $_POST['Message'];
// $to = "jadshammas@hotmail.com"; // this is your Email address
// $subject = "Form submission";
// $subject2 = "Copy of your form submission";
// $message = $name . " wrote the following:" . "\n\n" . $msg;
// $message2 = "Here is a copy of your message " . $name . "\n\n" . $msg;
// $headers = "From:" . $from;
// $headers2 = "From:" . $to;
// if (mail($to,$subject,$message,$headers)) {
    // mail($from,$subject2,$message2,$headers2); // sends a copy of the message to the sender
    // echo "Mail Sent. Thank you " . $name . ", we will contact you shortly.";
    // You can also use header('Location: thank_you.php'); to redirect to another page.

} else {
    echo "nothing";
}

?>