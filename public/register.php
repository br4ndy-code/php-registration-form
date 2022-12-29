<?php
    include_once __DIR__ . '/../src/bootstrap.php';
    include_once __DIR__ . '/../src/register.php';
?>

<?php view('header', ['title' => 'Registration'])?>
<style>
    .main{
        height: 100vh;
    }
    form{
        padding: 3rem;
        border: 2px dashed #D3D3D3;
        border-radius: 1.5rem;
        text-align: center;
    }
    input{
        display:block;
        margin-top: 0.5rem;
        margin: 0 auto;
        border: 1px solid #D3D3D3;
        border-radius: 0.5rem;
    }
    small{
        display: block;
        width: 300px;
        color: red;
        margin-bottom: 1rem;
    }
</style>
<div class="container">
    <div class="row main">
        <div class="col-md-12 d-flex justify-content-center align-items-center">
            <form action="register.php" method="post">
            <h1>Sign Up</h1>
            <div>
                <label for="username">Username:</label>
                <input type="text" name="username" id="username" value="<?= $inputs['username'] ?? '' ?>"
                    class="<?= error_class($errors, 'username') ?>">
                <small><?= $errors['username'] ?? '' ?></small>
            </div>
            
            <div>
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" value="<?= $inputs['email'] ?? '' ?>"
                    class="<?= error_class($errors, 'email') ?>">
                <small><?= $errors['email'] ?? '' ?></small>
            </div>

            <div>
                <label for="password">Password:</label>
                <input type="password" name="password" id="password" value="<?= $inputs['password'] ?? '' ?>"
                    class="<?= error_class($errors, 'password') ?>">
                <small><?= $errors['password'] ?? '' ?></small>
            </div>

            <div>
                <label for="password2">Password Again:</label>
                <input type="password" name="password2" id="password2" value="<?= $inputs['password2'] ?? '' ?>"
                    class="<?= error_class($errors, 'password2') ?>">
                <small><?= $errors['password2'] ?? '' ?></small>
            </div>

            <div>
                <label for="agree">
                    <input type="checkbox" class="d-inline" name="agree" id="agree" value="checked" <?= $inputs['agree'] ?? '' ?> /> I
                    agree
                    with the
                    <a href="#" title="term of services">term of services</a>
                </label>
                <small><?= $errors['agree'] ?? '' ?></small>
            </div>

            <button type="submit" class="btn btn-outline-primary">Register</button>

            <footer>Already a member? <a href="login.php">Login here</a></footer>

        </form>
        </div>
    </div>
</div>
<?php view('footer')?>
