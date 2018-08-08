<?php
$param = urldecode(basename($_SERVER['REQUEST_URI']));

try {
    if (is_numeric($param)) {
        $dt = new DateTime('@' . $param);
        $unix = (int) $param;
    } else {
        $dt = new DateTime($param, new DateTimeZone('UTC'));
        $unix = $dt->getTimestamp();
    }
    $date = $dt->format("F d, Y");
} catch (Exception $e) {
    $unix = null;
    $date = null;
}

$result = [
  'unix' => $unix,
  'natural' => $date,
];

header('Content-type: application/json');
echo json_encode($result);