<?php

$data = json_decode(file_get_contents("php://input"), true);

$participant = $data["participant"];
$start = $data["experiment_start"];
$results = $data["results"];

$filename = "data/SRET_" . $participant . "_" . str_replace(":", "-", $start) . ".csv";

if (!file_exists("data")) {
    mkdir("data", 0777, true);
}

$file = fopen($filename, "w");

fputcsv($file, ["participant","experiment_start","trial","sentence","key_pressed","response","reaction_time_s"]);

foreach ($results as $r) {
    fputcsv($file, [
        $participant,
        $start,
        $r["trial"],
        $r["sentence"],
        $r["key_pressed"],
        $r["response"],
        $r["reaction_time"]
    ]);
}

fclose($file);

echo "saved";

?>