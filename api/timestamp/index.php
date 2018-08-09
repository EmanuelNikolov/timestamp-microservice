<?php
$param = urldecode(basename($_SERVER['REQUEST_URI']));

try {
    if (is_numeric($param)) {
        $dt = new DateTime('@' . $param);
    } elseif (empty($param)) {
        $dt = new DateTime('now');
    } else {
        $dt = new DateTime($param, new DateTimeZone('UTC'));
    }

    $unix = $dt->getTimestamp();
    $date = $dt->format(DateTime::RFC7231);
    $result = [
      'unix' => $unix,
      'utc' => $date,
    ];
} catch (Exception $e) {
    $result = [
      'error' => 'Invalid Date'
    ];
}

header('Content-type: application/json');
echo json_encode($result);