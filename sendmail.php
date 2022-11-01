<?php
$name = 'Name';
$email = 'mail@example.com';
$phone = '000 00-00-00';
$message = 'Test message';
// email
$to = 'YOUR EMAIL';
$subject = 'Հետադարձ կապ - example.com';
$body = '<html>
            <body>
                <h2>Հետադարձ կապ - example.com</h2>
                <hr>
                <p>Անուն<br>'.$name.'</p>
                <p>Էլ. փոստ<br>'.$email.'</p>
                <p>Հեռախոս<br>'.$phone.'</p>
                <p>Նամակ<br>'.$message.'</p>
            </body>
        </html>';
// headers
$headers  = "From: ".$name." <".$email.">\r\n";
$headers .= "Reply-To: ".$email."\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-type: text/html; charset=utf-8";
// send
$send = mail($to, $subject, $body, $headers);
if ($send) {
    echo 'ok';
} else {
    echo 'error';
}
?>