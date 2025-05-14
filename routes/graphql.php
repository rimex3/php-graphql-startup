<?php

use GraphQL\GraphQL;
use GraphQL\Error\FormattedError;
use GraphQL\Error\DebugFlag;

require_once '../vendor/autoload.php';

$schema = require_once '../graphql/schema.php';

$rawInput = file_get_contents('php://input');

$input = json_decode($rawInput, true);
$query = $rawInput['query'] ?? null;
$variables = $rawInput['variables'] ?? [];

try {
    $result = GraphQL::executeQuery($schema, $query, null, null, $variables);
    $output = $result->toArray(DebugFlag::INCLUDE_DEBUG_MESSAGE | DebugFlag::INCLUDE_TRACE);
} catch (Throwable $err) {
    http_response_code(500);

    $output = [
        "error" => FormattedError::createFromException($err)
    ];
}

echo json_encode($result);