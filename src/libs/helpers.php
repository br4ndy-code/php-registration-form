<?php
/*
In the future, we may want to include the header.php and footer.php files in other files, e.g., login.php. Therefore, the title of the page should not be fixed.
To make a title tag dynamic was defined the view() function that loads the code from a PHP file and passes data to it
*/

function view(string $filename, array $data = []):void{
    // create variables from associative array
    foreach ($data as $key => $value){
        $$key = $value;
    }
    require_once __DIR__ . '/../inc/' . $filename . '.php';
}

function is_post_request():bool{
    return strtoupper($_SERVER['REQUEST_METHOD']) === 'POST';
}

function is_get_request():bool{
    return strtoupper($_SERVER['REQUEST_METHOD']) === 'GET';
}

?>