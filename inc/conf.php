<?php
// feedback
if ($_GET['cmd'] == 'feedback') {
    // data
    $name = trim(htmlspecialchars($_POST['name']));
    $email = trim(htmlspecialchars($_POST['email']));
    $phone = trim(htmlspecialchars($_POST['phone']));
    $message = trim(htmlspecialchars($_POST['message']));
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
        header('location: ../index.php?page=feedback&result=1');
    } else {
        header('location: ../index.php?page=feedback&result=0');
    }
}
?>