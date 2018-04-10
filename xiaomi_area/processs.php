<?php

$str = file_get_contents('data.json');
$str = trim($str);
$data = json_decode($str, true);
// print_r($data);

function getSql($areaData) {
    $sql = sprintf(
        'INSERT INTO `xiaomi_area` (id, name, fid, level, zip_code) VALUES (%d, "%s", %d, %d, "%s");',
        $areaData['id'], $areaData['name'], $areaData['fid'], $areaData['level'], $areaData['zip_code']
    );

    return $sql;
}

$out = '';
foreach ($data as $provence) {
    $areaData = array(
        'id'       => $provence['id'],
        'name'     => $provence['name'],
        'fid'      => 0,
        'level'    => 1,
        'zip_code' => '',
    );
    $sql = getSql($areaData);
    printf("%s\n", $sql);
    $out .= $sql."\n";

    foreach ($provence['child'] as $city) {
        $areaData = array(
            'id'       => $city['id'],
            'name'     => $city['name'],
            'fid'      => $provence['id'],
            'level'    => 2,
            'zip_code' => '',
        );
        $sql = getSql($areaData);
        printf("%s\n", $sql);
        $out .= $sql."\n";

        foreach ($city['child'] as $conty) {
            $areaData = array(
                'id'       => $conty['id'],
                'name'     => $conty['name'],
                'fid'      => $city['id'],
                'level'    => 3,
                'zip_code' => $conty['zipcode'],
            );
            $sql = getSql($areaData);
            printf("%s\n", $sql);
            $out .= $sql."\n";
        }
    }
}

$outFile = 'E:\\download\\xshell\\xiaomi.sql';
file_put_contents($outFile, $out);
