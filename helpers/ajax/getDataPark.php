<?php

require_once __DIR__ . '/../../models/Parks.php';

$parks = Parks::readAll(!null);

echo json_encode($parks);
