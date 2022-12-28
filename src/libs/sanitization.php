<?php
    /*
    Before processing data from untrusted sources such as HTTP post or get request, 
    we should always sanitize it first.

    Removing illegal characters using deleting,replacing, encoding, or escaping techniques.
    */
    const FILTERS = [
        'string' => FILTER_SANITIZE_FULL_SPECIAL_CHARS, // Convert special characters to HTML entities
        'string[]' => [
            'filter' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
            'flags' => FILTER_FLAG_NO_ENCODE_QUOTES,
        ],
        'email' => FILTER_SANITIZE_EMAIL,
        'int' => [
            'filter' => FILTER_SANITIZE_NUMBER_INT,
            'flags' => FILTER_REQUIRE_SCALAR
        ],
        'int[]' => [
            'filter' => FILTER_SANITIZE_NUMBER_INT,
            'flags' => FILTER_REQUIRE_ARRAY
        ],
        'float' => [
            'filter' => FILTER_SANITIZE_NUMBER_FLOAT,
            'flags' => FILTER_FLAG_ALLOW_FRACTION
        ],
        'float[]' => [
            'filter' => FILTER_SANITIZE_NUMBER_FLOAT,
            'flags' => FILTER_REQUIRE_ARRAY
        ],
        'url' => FILTER_SANITIZE_URL,
    ];

    // Remove whitespaces from array of strings
    function array_trim(array $items): array{
        return array_map(function ($item) {
            if (is_string($item)) {
                return trim($item);
            } elseif (is_array($item)) {
                return array_trim($item);
            } else
                return $item;
        }, $items);
    }

    // Sanitize the inputs based on the rules an optionally trim the string
    function sanitize(array $inputs, array $fields = [], int $default_filter = FILTER_SANITIZE_FULL_SPECIAL_CHARS, array $filters = FILTERS, bool $trim = true): array{
        if ($fields) {
            $options = array_map(fn($field) => $filters[$field], $fields);
            $data = filter_var_array($inputs, $options); // sanitize multiple fields at a time
        } else {
            $data = filter_var_array($inputs, $default_filter); // if $filters array is empty use default
        }

        return $trim ? array_trim($data) : $data; // call the array_trim() if the $trim parameter is true
    }