<?php
require_once('config.php');
require ('validators.php');
$errors = [];
$missing = [];
$mailsent = FALSE;
$notice = "";

// detect form submission
if (isset($_POST['submit'])) {
    //expected and required field names
    $expected = ['type','name','email','username','password'];
    $required = ['type','name','email','username'];
    //when submit button clicked
    $type = isset($_POST['type']) ? $_POST['type'] : "sales";
    $name = isset($_POST['name']) ? $_POST['name'] : "";
    $email = isset($_POST['email']) ? $_POST['email'] : "";
    $username = isset($_POST['username']) ? $_POST['username'] : "";
    $password = isset($_POST['password']) ? $_POST['password'] : "password";

    //validation
    foreach ($_POST as $key => $value) {
        $value = is_array($value) ? $value : trim($value);
        if (empty($value) && in_array($key, $required)) {
            $missing[] = $key;
            $$key = '';
        } elseif (in_array($key, $expected)) {
            $$key = $value;
        }
    }

    // Validate user's email
    if ($missing && requiredFieldValidator($email)) {
        $errors['email']= " : Enter your email address";
    } elseif (emailValidator($email)) {
        $errors['email'] = " : Invalid email address";
    }
    
    // Validate name
    if (requiredFieldValidator($name)) {
        $errors['name']= " : Enter your name";
    } elseif (nameValidator($name)) {
        $errors['name'] = " : Invalid name";
    }

    // Validate username
    if (requiredFieldValidator($username)) {
        $errors['username']= " : Enter a username";
    } elseif (userNameValidator($username)) {
        $errors['username'] = " : Invalid username";
    }

    // If no errors, insert to db and send email
    if (!$errors && !$missing) {
        $password = mysqli_real_escape_string($db,$password);
        $query  = "INSERT INTO users (username, password, type, name, email) VALUES ('{$username}', '{$password}', '{$type}', '{$name}', '{$email}')";

        $result = mysqli_query($db, $query);

        if ($result) {
            // Success
            //send email
            //require ('sendmail.php');

            if($mailsent) {
                $notice = '<div class="alert alert-success"><b>Registration Successful!</b> Email with password has been sent to the user.</div>';
                $name = "";
                $email = "";
                $username = "";
                $password = "";
                header('Refresh: 3; staff_dir.php');
            }
        } else {
            die("Database query failed. " . mysqli_error($db));
        }
    } else {
        $notice = '<div class="alert alert-danger"><b>Error!</b> Please provide complete information.</div>';
    }
} else {
    //initial form load
    $name = "";
    $email = "";
    $username = "";
    $password = "";
}
?>

    <!-- Page Header -->
<?php $pageid = "staffreg";
$title = "Dashboard - Create Users";
include('header.php'); ?>

<?php include('bossmenu.php'); ?>

    <!-- **********************************************************************************************************************************************************
    MAIN CONTENT
    *********************************************************************************************************************************************************** -->
    <!--main content start-->
    <section id="main-content">
        <section class="wrapper">
            <h3><i class="fa fa-angle-right"></i>Add New Users</h3>

            <!-- BASIC FORM ELELEMNTS -->
            <div class="row mt">
                <div class="col-lg-12">
                    <div class="form-panel">
                        <h4 class="mb"><i class="fa fa-angle-right"></i>Staff Registration Form</h4>
                        <?php
                        if ($mailsent) {
                            echo $notice;
                        } else {
                            echo $notice;
                        }
                        ?>
                        <form class="form-horizontal style-form" action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>"
                              method="post">
                            <div class="form-group">
                                <label class="col-sm-2 col-sm-2 control-label" for="type">Account Type</label>
                                <div class="col-sm-10">
                                    <select name="type" class="form-control">
                                        <option value="student">student</option>
                                        <option value="lecturer">lecturer</option>
                                        <option value="admin">admin</option>
                                    </select>
                                </div>
                            </div>
                            <div <?= (isset($errors['name']) ? 'class="form-group has-error"' : 'class="form-group"') ?>>
                                <label class="col-sm-2 col-sm-2 control-label" for="name">Name<?= (isset($errors['name'])) ? $errors['name'] : '' ?></label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="name" id="name"
                                           value="<?= htmlspecialchars($name) ?>">
                                </div>
                            </div>

                            <div <?= (isset($errors['email']) ? 'class="form-group has-error"' : 'class="form-group"') ?>>
                                <label class="col-sm-2 col-sm-2 control-label" for="email">Email<?php if (isset($errors['email'])) { echo $errors['email']; } ?></label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="email" id="email"
                                           value="<?= htmlspecialchars($email) ?>">
                                </div>
                            </div>
                            <div <?= (isset($errors['username']) ? 'class="form-group has-error"' : 'class="form-group"') ?>>
                                <label class="col-sm-2 col-sm-2 control-label" for="username">Username<?= (isset($errors['username'])) ? $errors['username'] : '' ?></label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="username" id="username"
                                           value="<?= htmlspecialchars($username) ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 col-sm-2 control-label" for="password">Password</label>
                                <div class="col-sm-10">
                                    <input type="password" class="form-control" name="password" id="password" value="">
                                </div>
                            </div>
                            <button type="submit" name="submit" value="Submit" class="btn btn-theme"
                                    style="margin: auto; display:block;">Create Users
                            </button>
                        </form>
                    </div>
<!--                    <pre>-->
<!--                        --><?php
//                        print_r($_POST);
//                        print_r($expected);
//                        print_r($errors);
//                        print_r($missing);
//                        ?>
<!--                    </pre>-->
                </div><!-- col-lg-12-->
            </div><!-- /row -->
        </section>
        <! --/wrapper -->
    </section>
    <!-- /MAIN CONTENT -->

<?php include('footer.php'); ?>