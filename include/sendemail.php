<?php

require_once('phpmailer/class.phpmailer.php');

$mail = new PHPMailer();

if( isset( $_POST['template-contactform-submit'] ) AND $_POST['template-contactform-submit'] == 'submit' ) {
    if( $_POST['nombre'] != '' AND $_POST['email'] != '' AND $_POST['mensaje'] != '' ) {

        $name = $_POST['nombre'];
        $email = $_POST['email'];
        $phone = $_POST['telefono'];
        $razon = $_POST['razon'];
        $subject = $_POST['template-contactform-subject'];
        $message = $_POST['mensaje'];

        $subject = isset($subject) ? $subject : 'Nuevo Mensaje del Sitio Web';

        $botcheck = $_POST['template-contactform-botcheck'];

        $toemail = 'info@garzasoftboards.com'; // Your Email Address
        $toname = 'Garza Surfboards'; // Your Name

        if( $botcheck == '' ) {

            $mail->SetFrom( $email , $name );
            $mail->AddReplyTo( $email , $name );
            $mail->AddAddress( $toemail , $toname );
            $mail->Subject = $subject;

            $name = isset($name) ? "Nombre: $name<br><br>" : '';
            $email = isset($email) ? "Email: $email<br><br>" : '';
            $phone = isset($phone) ? "Telefono: $phone<br><br>" : '';
            $razon = isset($razon) ? "Razon de Contacto: $razon<br><br>" : '';
            $message = isset($message) ? "Mensaje: $message<br><br>" : '';

            $referrer = $_SERVER['HTTP_REFERER'] ? '<br><br><br>Este formulario fue generado en: ' . $_SERVER['HTTP_REFERER'] : '';

            $body = "$name $email $phone $razon $message $referrer";

            $mail->MsgHTML( $body );
            $sendEmail = $mail->Send();

            if( $sendEmail == true ):
                echo 'We have <strong>successfully</strong> received your Message and will get Back to you as soon as possible.';
            else:
                echo 'Email <strong>could not</strong> be sent due to some Unexpected Error. Please Try Again later.<br /><br /><strong>Reason:</strong><br />' . $mail->ErrorInfo . '';
            endif;
        } else {
            echo 'Bot <strong>Detected</strong>.! Clean yourself Botster.!';
        }
    } else {
        echo 'Please <strong>Fill up</strong> all the Fields and Try Again.';
    }
} else {
    echo 'An <strong>unexpected error</strong> occured. Please Try Again later.';
}

?>