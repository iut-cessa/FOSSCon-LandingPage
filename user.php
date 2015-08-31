<?php

if (empty($_GET['id'])) {
    die ("Arg: id not available");
    return false;
}

require_once('mail/config.php');

$con = new mysqli($servername, $username, $password, $dbname);
if ($con->connect_error) {
    die('Connection to db failed! ' . $con->connect_error);
}

if (!empty($_POST['workshop'])) {
    // workshop has been chosen
    echo $_POST['workshop'];

    $query = 'update users set workshop_num=' . $_POST['workshop'] . ' where uniqid="' . $_GET['id'].'"';
    $con->query($query);
    if ($con->affected_rows == 1) {
     echo 'workshop updated';
    } else {
     die('workshop update failed: ' . $con->error);
    }

    return false;
}



$query = 'select * from users where uniqid="' . $_GET['id'] . '"';
// print_r($con->query($query)->fetch_array()['email']);
$arr = $con->query($query)->fetch_array();

$name = $arr['name'];
$email = $arr['email'];
$phone = $arr['phone'];

?>

<!DOCTYPE html>
<html lang="fa">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1"> -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>گردهمایی نرم افزارهای آزاد/متن باز دانشگاه صنعتی اصفهان</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/agency.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Kaushan+Script' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700' rel='stylesheet' type='text/css'>
    <link href="css/my_style.css" rel="stylesheet">
    <link href="css/user.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body id="page-top" class="index">

    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header page-scroll">
                <div class="navbar-brand page-scroll">
                    <a href="#page-top">IUT FOSS Con</a>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </nav>

    <!-- Contact Section -->
    <section id="register">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">سلام <?php echo $name ?>.</h2>
                    <h3 class="section-subheading text-muted">register</h3>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <form name="register" id="contactForm" method="post" action="" novalidate>
                        <div class="row">
                            <div class="col-md-6 col-lg-offset-3">
                                <div class="form-group radio">
                                    <label><input type="radio" value="0" name="workshop">Linux</label>
                                </div>
                                <div class="form-group radio">
                                    <input type="radio" class="form-control" value="1" name="workshop">Laravel
                                </div>
                                <div class="form-group radio">
                                    <input type="radio" class="form-control" value="2" name="workshop">Golang
                                </div>
                                <div class="form-group radio">
                                    <input type="radio" class="form-control" value="3" name="workshop">Angular.js
                                </div>
                                <div class="form-group radio">
                                    <input type="radio" class="form-control" value="4" name="workshop">Embedded Systems
                                </div>
                                <input type="submit" class="btn btn-lg btn-success" value="پرداخت">
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </section>

    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-md-push-4">
                    <span class="copyright">Copyleft <span class="copy-left">&copy;</span> 2015 IUT FOSS Con</span>
                </div>
            </div>
        </div>
    </footer>

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
    <script src="js/classie.js"></script>
    <script src="js/cbpAnimatedHeader.js"></script>

    <!-- Contact Form JavaScript -->
    <script src="js/jqBootstrapValidation.js"></script>
    <!-- <script src="js/contact_me.js"></script> -->

    <!-- Custom Theme JavaScript -->
    <script src="js/agency.js"></script>

    <!-- Custom JavaScript -->
    <script src="js/javascript.js"></script>

</body>

</html>