<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include_once('../../../../wp-load.php');
    $mailForSend = get_option('ps_main_email') ? get_option('ps_main_email') : 'info@parimatch.foundation';

  $allData = '';
  $subject = 'Заявка з сайту - Parimatch Foundation'; // topic of the letter
  $reply_mail = !empty($_POST['name']) ? htmlspecialchars($_POST['email']) : $mailForSend;
  $emails__arr = [ // mail address separated by comma
                   $mailForSend,
  ];
  $allData = '<h3>При заповненні форми користувачем були отримані наступні дані :</h3>';

  //multipart
  if ($_FILES['file']['size'][0] !== 0 && !empty($_FILES['file'])) {

    $subject = 'Лист із вкладенням';
    if (!empty($_POST['form_name'])) {
      $allData .= '<br><b>Відправка з форми - : </b>' . htmlspecialchars(strip_tags($_POST['form_name']));
    }

    if (!empty($_POST['name'])) {
      $allData .= '<br><br><b>Ім\'я : </b>' . htmlspecialchars($_POST['name']);
    }
    if (!empty($_POST['tel'])) {
      $allData .= '<br><b>Телефон : </b>' . htmlspecialchars($_POST['tel']);
    }
    if (!empty($_POST['email'])) {
      $allData .= '<br><b>E-mail : </b>' . htmlspecialchars($_POST['email']);
    }
    if (!empty($_POST['themes'])) {
      $allData .= '<br><b>Тема звернення : </b>' . htmlspecialchars($_POST['themes']);
    }
    if (!empty($_POST['textarea'])) {
      $allData .= '<br><b>Повідомлення : </b>' . htmlspecialchars($_POST['textarea']);
    }
    if (!empty($_POST['location_url'])) {
      $location_url = $_POST['location_url'];
    }
    if ($location_url && $location_url !== '') {
      $location_url = str_replace(["http://", "https://"], "", $location_url);
      $location_url = preg_replace("#/$#", "", $location_url);
      $allData .= '<br><b>Url сторінки відправки листа - : </b>' . $location_url;
    }
    $allData .= '<br><b>Дата відправки : </b>' . date("H:i - d:m:Y");

    $message = $allData;
    $emails__arr = [ // mail address separated by comma
                     $mailForSend,
    ];

    $boundary = "--" . md5(uniqid(time()));
    $headers = "MIME-Version: 1.0;\r\n";
    $headers .= "Content-Type: multipart/mixed; boundary=\"$boundary\"\r\n";
    $headers .= "From: <" . $mailForSend . ">\r\n";
    $headers .= "Reply-To:  " . $reply_mail . "\r\n";
    $multipart = "--$boundary\r\n";
    $multipart .= "Content-Type: text/html; charset=utf-8 \r\n";
    $multipart .= "Content-Transfer-Encoding: base64 \r\n";
    $multipart .= "\r\n";
    $multipart .= chunk_split(base64_encode($message));

    for ($i = 0, $length = count($_FILES['file']['name']); $i < $length; $i++) {
      $filename = $_FILES['file']['name'][$i];
      $path = $_FILES['file']['tmp_name'][$i];

      $fp = fopen($path, "rb");
      if (!$fp) {
        print "Cannot open file";
        exit();
      }
      $file = fread($fp, filesize($path)) . " ";
      fclose($fp);

      $multipart .= "\r\n--$boundary\r\n";
      $multipart .= "Content-Type: application/octet-stream; name=\"$filename\"\r\n";
      $multipart .= "Content-Transfer-Encoding: base64\r\n";
      $multipart .= "Content-Disposition: attachment; filename=\"$filename\"\r\n";
      $multipart .= "\r\n";
      $multipart .= chunk_split(base64_encode($file));

    }
    $multipart .= "\r\n--$boundary--\r\n";

    foreach ($emails__arr as $email__arr) {
      $send = mail($email__arr, $subject, $multipart, $headers);
    }
    if ($send) {
      $json = [
        "error" => 0,
      ];
      echo json_encode($json);
    } else {
      $json = [
        "error" => "Ошибка, данные не отправлены обратитесь к администратору сайта",
      ];
      echo json_encode($json);
    }
  }//multipart

  // standard
  else {

    if (!empty($_POST['form_name'])) {
      $allData .= '<br><b>Відправка з форми - : </b>' . htmlspecialchars(strip_tags($_POST['form_name']));
    }

    if (!empty($_POST['name'])) {
      $allData .= '<br><br><b>Ім\'я : </b>' . htmlspecialchars($_POST['name']);
    }
    if (!empty($_POST['tel'])) {
      $allData .= '<br><b>Телефон : </b>' . htmlspecialchars($_POST['tel']);
    }
    if (!empty($_POST['email'])) {
      $allData .= '<br><b>E-mail : </b>' . htmlspecialchars($_POST['email']);
    }
    if (!empty($_POST['themes'])) {
      $allData .= '<br><b>Тема звернення : </b>' . htmlspecialchars($_POST['themes']);
    }
    if (!empty($_POST['textarea'])) {
      $allData .= '<br><b>Повідомлення : </b>' . htmlspecialchars($_POST['textarea']);
    }
    if (!empty($_POST['location_url'])) {
      $location_url = $_POST['location_url'];
    }
    if ($location_url && $location_url !== '') {
      $location_url = str_replace(["http://", "https://"], "", $location_url);
      $location_url = preg_replace("#/$#", "", $location_url);
      $allData .= '<br><b>Url сторінки відправки листа - : </b>' . $location_url;
    }
    $allData .= '<br><b>Дата відправки : </b>' . date("H:i - d:m:Y");

    $headers = "Content-type: text/html; charset=utf-8 \r\n";
    $headers .= "From:  <$mailForSend>\r\n";
    $headers .= "Reply-To: $reply_mail\r\n";
    $message = $allData;

    foreach ($emails__arr as $email__arr) {
      $send = mail($email__arr, $subject, $message, $headers);
    }
    if ($send) {
      $json = [
        "error" => 0,
      ];
      echo json_encode($json);
    } else {
      $json = [
        "error" => "Ошибка, данные не отправлены обратитесь к администратору сайта",
      ];
      echo json_encode($json);
    }

  }//standard
} else {
  http_response_code(403);
  echo "<h1 style='text-align: center; color: red; margin: 50px;'>Че хакер что ли ?  ану брысь отсюда!</h1>";
}