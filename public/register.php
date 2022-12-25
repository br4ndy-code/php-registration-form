<?php
    include_once __DIR__ . '/../src/bootstrap.php';

    if (is_post_request()){
        $fields = [
            'username' => 'string | required | alphanumeric | between: 3, 25',
            'email' => 'email | required | email',
            'password' => 'string | required | secure',
            'password2' => 'string | required | same: password',
            'agree' => 'string | required'
        ];
        
        // custom messages
        $messages = [
            'password2' => [
                'required' => 'Please enter the password again',
                'same' => 'The password does not match'
            ],
            'agree' => [
                'required' => 'You need to agree to the term of services to register'
            ]
        ];
        
        [$inputs, $errors] = filter($_POST, $fields, $messages);

    }
?>

<?php view('header', ['title' => 'Registration'])?>

<form action="register.php" method="post">
    <h1>Sign Up</h1>
    <div>
        <label for="username">Username:</label>
        <input type="text" name="username" id="username">
    </div>
    <div>
        <label for="email">Email:</label>
        <input type="text" name="email" id="email">
    </div>
    <div>
        <label for="password">Password:</label>
        <input type="text" name="password" id="password">
    </div>
    <div>
        <label for="password2">Password Again:</label>
        <input type="text" name="password2" id="password2">
    </div>
    <div>
        <label for="agree">
            <input type="checkbox" name="agree" id="agree" value="yes"/> I agree with the
            <a href="#" title="term of serices">term of services</a>
        </label>
    </div>
    <button type="submit">Register</button>
    <footer>
        Already a member <a href="#">Login here</a>
    </footer>
</form>
<?php view('footer')?>
