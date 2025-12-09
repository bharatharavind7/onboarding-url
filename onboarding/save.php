<?php

$agency = trim($_POST['agency']);
$url = trim($_POST['url']);

$filename = "../wsp-agencies.json";

if (!file_exists($filename)) {
    file_put_contents($filename, json_encode([], JSON_PRETTY_PRINT));
}

$data = json_decode(file_get_contents($filename), true);

$found = false;

foreach ($data as &$entry) {
    if ($entry["labels"]["agency"] === $agency) {
        $entry["targets"][] = $url;
        $entry["targets"] = array_values(array_unique($entry["targets"]));
        $found = true;
        break;
    }
}

if (!$found) {
    $data[] = [
        "targets" => [$url],
        "labels" => [
            "agency" => $agency,
            "env" => "prod"
        ]
    ];
}

file_put_contents($filename, json_encode($data, JSON_PRETTY_PRINT));

header("Location: index.php");
exit;

?>
