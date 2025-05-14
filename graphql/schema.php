<?php

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Schema;

$myType = new ObjectType([
    "name" => "myType",
    "fields" => [
        "id" => Type::nonNull(Type::id()),
        "field1" => Type::string(),
        "filed2" => Type::boolean()
    ]
]);


$QueryType = new ObjectType([
    "name" => "query",
    "fields" => [
        "myType" => [
            "type" => Type::listOf($myType),
            "args" => [
                "id" => Type::nonNull(Type::id())
            ],
            "resolvers" => fn($root, $args, $context) => []
        ]
    ]
]);


return new Schema([
    "query" => $QueryType,
]);