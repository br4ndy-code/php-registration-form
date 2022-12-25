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
    function error_class(array $errors, string $field): string{
        return isset($errors[$field]) ? 'error' : '';
    }
    function redirect_to(string $url): void{
        header('Location:' . $url);
        exit;
    }
    function redirect_with(string $url, array $items): void{
        foreach ($items as $key => $value) {
            $_SESSION[$key] = $value;
        }

        redirect_to($url);
    }
    function redirect_with_message(string $url, string $message, string $type=FLASH_SUCCESS){
        flash('flash_' . uniqid(), $message, $type);
        redirect_to($url);
    }

?>