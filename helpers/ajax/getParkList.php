<?php
require_once __DIR__ . '/../../models/Parks.php';

$arrayDatas = [];

$ParksValidated = Parks::readAll(!null);
array_push($arrayDatas, $ParksValidated);

$ParksNotValidated = Parks::readAll(null);
array_push($arrayDatas, $ParksNotValidated);

echo json_encode($arrayDatas);