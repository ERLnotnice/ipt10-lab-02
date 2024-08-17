<?php

define('REGISTRANTS_FILE_PATH', 'registration.csv');

function get_regsitation_data()
{
    $opened_file_handler = fopen(REGISTRANTS_FILE_PATH, 'r');

    $data = [];
    $headers = [];
    $row_count = 0;
    $max_rows = 10000;
    while (!feof($opened_file_handler) && $row_count <= $max_rows) {

        $row = fgetcsv($opened_file_handler, 1024);
        if (!empty($row)) {
            if ($row_count == 0) {
                $headers = $row;    
            } else {
                array_push($data, $row);
            }
        }

        $row_count++;

    }

    fclose($opened_file_handler);

    return [
        'headers' => $headers,
        'data' => $data
    ];

    
}

$registrant = get_regsitation_data();

?>
<html>
<head>
    <meta charset="utf-8">
    <title>IPT10 Laboratory Activity #2</title>
    <link rel="icon" href="https://phpsandbox.io/assets/img/brand/phpsandbox.png">
    <link rel="stylesheet" href="https://assets.ubuntu.com/v1/vanilla-framework-version-4.15.0.min.css" />   
</head>
<body>

<h1>
    Registrants
</h1>
<table aria-label="Registrants Dataset">
    <thead>
        <tr>
            <th>Complete Name</th>
            <th>Birthday</th>
            <th>Age</th>
            <th>Contact Number</th>
            <th>Sex</th>
            <th>Program</th>
            <th>Complete Address</th>
            <th>Email Address</th>
        </tr>
    </thead>
    <tbody>
    <?php
    foreach ($registrant['data'] as $record):
    ?>
        <tr>
            <td><?php echo "<strong>{$record[0]}</strong>"; ?></td>
            <td><?php echo $record[1]; ?></td>
            <td><?php echo $record[4]; ?></td>
            <td><?php echo $record[2]; ?></td>
            <td><?php echo $record[3]; ?></td>
            <td><?php echo $record[5]; ?></td>
            <td><?php echo $record[6]; ?></td>
            <td><?php echo $record[7]; ?></td>
        </tr>
    <?php
    endforeach;
    ?>
    </tbody>
</table>


</body>
</html>