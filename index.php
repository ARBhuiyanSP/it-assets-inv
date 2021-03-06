<?php session_start();
if(isset($_SESSION['logged']['status'])){
    header("location: dashboard.php");
    exit();
}  
include 'connection/connect.php';
include 'includes/login_process.php';
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Login - Saif Power Group</title>
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="bg-primary">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header">
										<center></center>
										<h3 class="text-center font-weight-light my-4"><center><img src="assets/img/logo-wide.png" /></center>SAIF Power Group - IT Assets</h3>
										
									</div>
                                    <div class="card-body">
                                        <form id="login_form" name="login_form" method="post">
                                            <div class="form-floating mb-3">
                                                <input type="text" id="username" name="username" class="form-control" placeholder="username" autocomplete="off">
												<?php if (isset($_SESSION['error_message']['username_empty']) && !empty($_SESSION['error_message']['username_empty'])) { ?>
													<div class="alert alert-warning">
														<strong>Warning!</strong> <?php echo $_SESSION['error_message']['username_empty']; ?>
													</div>
													<?php
													unset($_SESSION['error_message']['username_empty']);
												}
												?>
												<?php if (isset($_SESSION['error_message']['username_valid']) && !empty($_SESSION['error_message']['username_valid'])) { ?>
													<div class="alert alert-warning">
														<strong>Warning!</strong> <?php echo $_SESSION['error_message']['username_valid']; ?>
													</div>
													<?php
													unset($_SESSION['error_message']['username_valid']);
												}
												?>
                                                <label for="inputEmail">Username</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input type="password" id="password" name="password" class="form-control" placeholder="Password" autocomplete="off">
												<?php if (isset($_SESSION['error_message']['password_empty']) && !empty($_SESSION['error_message']['password_empty'])) { ?>
													<div class="alert alert-warning">
														<strong>Warning!</strong> <?php echo $_SESSION['error_message']['password_empty']; ?>
													</div>
													<?php
													unset($_SESSION['error_message']['password_empty']);
												}
												?>
                                                <label for="inputPassword">Password</label>
                                            </div>
                                            <input type="submit" name="login_submit" value="Login" class="btn btn-primary btn-block" style="width:100%">
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
    </body>
</html>
