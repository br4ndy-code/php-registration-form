<?php
    $fields = [
        'username' => 'reguired, max:255',
        'email' => 'required | email',
        'password' => 'required | secure',
        'password2' => 'required | same:password'
    ];
    const DEFAULT_VALIDATION_ERRORS = [
        'required' => 'Please enter the %s',
        'email' => 'The %s is not a valid email address',
        'min' => 'The %s must have at least %s characters',
        'max' => 'The %s must have at most %s characters',
        'between' => 'The %s must have between %d and %d characters',
        'same' => 'The %s must match with %s',
        'alphanumeric' => 'The %s should have only letters and numbers',
        'secure' => 'The %s must have between 8 and 64 characters and contain at least one number, one upper case letter, one lower case letter and one special character',
        'unique' => 'The %s already exists',
    ];

    function validate(array $data, array $fields):array{
        // split a str by a separator
        // trim each item in the result array and return it
        $split = fn($str, $separator) => array_map('trim', explode($separator, $str));

        $errors = [];

        foreach ($fields as $field => $option){
            // get the rules of the field
            $rules = $split($option. '|');

            foreach ($rules as $rule){
                $params = [];
                // Extract the rule name and its parameters
                if (strpos($rule, ':')){ 
                    [$rule_name, $param_str] = $split($rule, ':');
                    $params = $split($param_str, ',');
                }
                else{
                    $rule_name = trim($rule); // strip whitespace
                }

                /* To prevent the validation function from collie with the standard function like min, added prefix for the validation function with the string is_.
                */

                $fn = 'is_' . $rule_name;

                if(is_callable($fn)){
                    $pass = $fn($data, $field, ...$params);
                    if (!$pass){
                        $errors[$field] = sprintf(DEFAULT_VALIDATION_ERRORS[$rule_name], $field, ...$params);
                    }
                }
            }
        }
        return $errors;
    }
?>