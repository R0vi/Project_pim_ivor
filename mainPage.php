<?php
require_once ("connection.php");
require_once("loginPage.php");
require_once("functions.php");
require_once("handleStockChange.php");

// maken db connectie
$connection = new Connection('', 'test', 'root', '');
$login = new Login($connection);

// instanties van classes
$functions = new debug();
$stockHandler = new StockChange($connection);




// check if login is valid
if ( empty( $_SESSION['login'] ) ){
    header('location: http://localhost/Project_pim_ivor/index.php/1');
}

$totalStock = $stockHandler->returnTotalStock();


?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Scrolling Nav - Start Bootstrap Template</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/scrolling-nav.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<!-- The #page-top ID is part of the scrolling feature - the data-spy and data-target are part of the built-in Bootstrap scrollspy function -->

<body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">

    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
        <div class="container">
            <div class="navbar-header page-scroll">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand page-scroll" href="#page-top">Tools4Ever</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav">
                    <!-- Hidden li included to remove active class from about link when scrolled up past about section -->
                    <li class="hidden">
                        <a class="page-scroll" href="#page-top"></a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#voorraad">Voorraad</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#services">Fabriek</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#contact">Contact</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <!-- Intro Section -->
    <section id="intro" class="intro-section">
        <div class="container">
            <div class="row">
                <?php
                var_dump($totalStock);
                ?>
            </div>
        </div>
    </section>

    <!-- voorraad Section -->
    <section id="voorraad" class="about-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h1>Voorraad</h1>
                    <form method="post">
                        <select name="locatiekeuze">
                            <?php
                            $locationBuffer = [];
                            foreach($totalStock as $row)
                            {
                                if(!in_array($row['Locatie'], $locationBuffer))
                                {
                                    array_push($locationBuffer, $row['Locatie']);
                                    echo "<option name='locatie' value='".$row['Locatie']."'>".$row['Locatie']."</option>";
                                }
                            }
                            ?>
                        </select>
                    </form>
                    <table width="100%">
                        <tr><td>product</td><td>type</td><td>merk</td><td>aantal</td><td>inkoopprijs</td><td>verkoopprijs</td></tr>
                        <tr><td>_______</td><td>_______</td><td>_______</td><td>_______</td><td>_______</td><td>_______</td></tr>
                        <?php
                        foreach($totalStock as $row)
                        {
                            echo "<tr><td>{$row['product']}</td><td>{$row['type']}</td><td>{$row['fabriek']}</td><td>{$row['aantal']}</td><td>{$row['inkoopprijs']}</td><td>{$row['verkoopprijs']}</td></tr>";
                        }
                        ?>
                    </table>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section id="services" class="services-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h1>Services Section</h1>

                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="contact-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h1>Contact Section</h1>
                </div>
            </div>
        </div>
    </section>

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Scrolling Nav JavaScript -->
    <script src="js/jquery.easing.min.js"></script>
    <script src="js/scrolling-nav.js"></script>

</body>

</html>
