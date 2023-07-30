<?php
session_start();

if (isset($_SESSION['auth'])) {
    $_SESSION['message'] = 'You are already logged in';
    header('location:index.php');
    exit();
}

include 'includes/header.php';
?>

<div class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <?php
                if (isset($_SESSION['message'])) {
                ?>
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong>Hey!</strong> <?= $_SESSION['message']; ?>.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php
                    unset($_SESSION['message']);
                }
                ?>
                <div class="card">
                    <div class="card-header">
                        <h4>Registration Form</h4>
                    </div>
                    <div class="card-body">
                        <form action="function/authcode.php" method="post">
                            <div class="mb-3">
                                <label class="form-label">Name</label>
                                <input type="text" name="name" class="form-control" placeholder="Enter your name">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Phone</label>
                                <input type="number" name="phone" class="form-control" placeholder="Enter your phone number">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Email address</label>
                                <input type="email" name="email" class="form-control" placeholder="Enter your email">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Password</label>
                                <input type="password" name="password" class="form-control" placeholder="Enter password">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Confirm Password</label>
                                <input type="password" name="c_password" class="form-control" placeholder="Confirm password">
                            </div>

                            <button type="submit" name="register_btn" class="btn btn-primary">Add User</button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>



<?php include 'includes/footer.php'; ?>