<?php
ob_end_clean();
$data = filter_input(INPUT_POST, 'data');
header('Content-Type:application/json');
echo json_encode($data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK);
