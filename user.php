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

// check for user existance
$query = 'select * from users where uniqid="' . $_GET['id'] . '"';
if ($con->query($query)->num_rows != 1) {
    die("user not found");
}

// get free seats
$free_seats = array(0, 30, 30, 30, 30, 30);
for ($i = 1; $i <= 5; $i++) {
    $query = 'select * from users where workshop_num="' . $i . '"';
    $free_seats[$i] -= $con->query($query)->num_rows; // no error checking
}

if (!empty($_POST['workshop'])) {
    // workshop has been chosen
    echo $_POST['workshop'];
    if ($free_seats[$_POST['workshop']] > 0) {
        $query = 'update users set workshop_num=' . $_POST['workshop'] . ' where uniqid="' . $_GET['id'] . '"';
        $con->query($query);
        if ($con->affected_rows == 1) {
            echo ' workshop updated';
        } else {
            die('workshop update failed: ' . $con->error);
        }
    } else {
        echo 'no free seats for workshop num ' . $_POST['workshop'];
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
    <!-- <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Kaushan+Script' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700' rel='stylesheet' type='text/css'> -->
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
                    <h2 class="section-heading">انتخاب کارگاه</h2>
                    <h3 class="section-subheading text-muted">
                        یکی از کارگاه های زیر را انتخاب کنید
                    </h3>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 text-center">
                    <p id="userinfo">
                        کاربر:
                        <?php echo $name ?>
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <form name="register" id="contactForm" method="post" action="" novalidate>
                        <div class="row">
                            <div class="col-md-6 col-lg-offset-3">
                                <div class="form-group radio">
                                    <input type="radio" id="linux" value="1" name="workshop" <?php echo $free_seats[1] <= 0 ? "disabled" : "" ?> >
                                    <label for="linux">Linux</label>
                                    <span>
                                        ظرفیت باقی مانده:
                                        <?php echo $free_seats[1] ?>
                                    </span>
                                </div>
                                <div class="form-group radio">
                                    <input type="radio" id="laravel" value="2" name="workshop" <?php echo $free_seats[2] <= 0 ? "disabled" : "" ?> >
                                    <label for="laravel">Laravel</label>
                                    <span>
                                        ظرفیت باقی مانده:
                                        <?php echo $free_seats[2] ?>
                                    </span>
                                </div>
                                <div class="form-group radio">
                                    <input type="radio" id="golang" value="3" name="workshop" <?php echo $free_seats[3] <= 0 ? "disabled" : "" ?> >
                                    <label for="golang">Golang</label>
                                    <span>
                                        ظرفیت باقی مانده:
                                        <?php echo $free_seats[3] ?>
                                    </span>
                                </div>
                                <div class="form-group radio">
                                    <input type="radio" id="angularjs" value="4" name="workshop" <?php echo $free_seats[4] <= 0 ? "disabled" : "" ?> >
                                    <label for="angularjs">Angular.js</label>
                                    <span>
                                        ظرفیت باقی مانده:
                                        <?php echo $free_seats[4] ?>
                                    </span>
                                </div>
                                <div class="form-group radio">
                                    <input type="radio" id="embedded" value="5" name="workshop" <?php echo $free_seats[5] <= 0 ? "disabled" : "" ?> >
                                    <label for="embedded">Embedded Systems</label>
                                    <span>
                                        ظرفیت باقی مانده:
                                        <?php echo $free_seats[5] ?>
                                    </span>
                                </div>
                                <input type="submit" class="btn btn-lg btn-success" value="پرداخت">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8 col-lg-push-2">
                    <ul id="workshop-p">
                        <li>
                            کارگاه ها به صورت موازی برگزار می شوند. بدیهی است هر نفر فقط در یک کارگاه میتواند شرکت کند.
                        </li>
                        <li>
                            زمان برگزاری کارگاه ها ۹:۳۰ تا ۱۳:۳۰ است.
                        </li>
                        <li>
                            هزینه حضور در هر کارگاه،
                            <em>۱۵ هزار تومان</em>
                            برای دانشجویان دانشگاه صنعتی اصفهان و برای بقیه شرکت کنندگان،
                            <em>۲۰ هزار تومان </em>
                            است.
                        </li>
                        <li>
                            برای شرکت کنندگان در کارگاه ها، ناهار، پذیرایی، یک توزیع لینوکس بر روی یک فلش مموری و امکانات دیگر در قالب یک پوشه از طرف تیم برگزاری در نظر گرفته شده که به آنان تقدیم خواهد شد.
                        </li>
                        <li>
                            هنگام پذیرش قبل از کارگاه ها، کارت شناسایی همراه داشته باشید.
                        </li>
                        <li>
                            پس از پرداخت و پایان ثبت نام، ایمیلی مبنی بر تایید ثبت نام برای شما ارسال خواهد شد.
                            در صورت عدم دریافت آن، مشکل را با پشتیبانی از طریق ایمیل
                            <a href="mailto: info@fosscon.iut.ac.ir">info@fosscon.iut.ac.ir</a>
                            در میان بگذارید.
                        </li>
                    </ul>
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