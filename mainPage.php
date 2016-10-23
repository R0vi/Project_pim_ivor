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
    header('location: http://localhost/Project_pim_ivor/index.php');
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

    <link href="css/bootstrap.min.css" rel="stylesheet">

    <link href="css/scrolling-nav.css" rel="stylesheet">
    

</head>


<body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">

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
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav">
                    <li class="hidden">
                        <a class="page-scroll" href="#page-top"></a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#about">Welcome <?php echo $_SESSION['login']['username'] ?>!</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <section id="intro" class="intro-section">
        <div class="container">
            <div class="row">
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
                    </select> <input type="submit" value="Zoek">
                </form>
                <table width="100%">
                    <tr><td>product</td><td>type</td><td>merk</td><td>aantal</td><td>inkoopprijs</td><td>verkoopprijs</td></tr>
                    <tr><td>_______</td><td>_______</td><td>_______</td><td>_______</td><td>_______</td><td>_______</td></tr>
                    <?php
                    foreach($totalStock as $row)
                    {
                        if($row['Locatie'] == $_POST['locatiekeuze']) {
                            echo "<tr><td>{$row['product']}</td><td>{$row['type']}</td><td>{$row['fabriek']}</td><td>{$row['aantal']}</td><td>{$row['inkoopprijs']}</td><td>{$row['verkoopprijs']}</td></tr>";
                        }
                    }
                    ?>
                </table>
            </div>
        </div>
    </section>

    <script src="js/jquery.js"></script>

    <script src="js/bootstrap.min.js"></script>
    
    <script src="js/jquery.easing.min.js"></script>
    <script src="js/scrolling-nav.js"></script>

</body>

</html>
