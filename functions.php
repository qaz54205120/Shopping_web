<?php
function pdo_connect_mysql() {
    // Update the details below with your MySQL details
    $DATABASE_HOST = 'localhost';
    $DATABASE_USER = 'root';
    //$DATABASE_PASS = 'A12345678';
    //$DATABASE_NAME = 'shoppingcart';
    $DATABASE_PASS = 'ntueman123456';
    $DATABASE_NAME = 'shopping_web';
    try {
    	return new PDO('mysql:host=' . $DATABASE_HOST . ';dbname=' . $DATABASE_NAME . ';charset=utf8', $DATABASE_USER, $DATABASE_PASS);
    } catch (PDOException $exception) {
    	// If there is an error with the connection, stop the script and display the error.
    	exit('Failed to connect to database!');
    }
}
// Template header, feel free to customize this
function template_header($title) {
// Get the amount of items in the shopping cart, this will be displayed in the header.
echo <<<EOT
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>$title</title>
		<link href="style.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v6.0.0/css/all.css">
	</head>
	<body>
        <header>
            <div class="content-wrapper">
                <!--<h1>THE Shopping Cart</h1>-->
                <h1>Shopping</h1>
                <nav>
                    <a href="index.php">Home</a>
                    
                </nav>
                <div class="link-icons">
                    <a href="index.php?page=cart">
						<i class="fas fa-shopping-cart"></i>
					</a>
                </div>
                <div class="link-icons">
                    <a href="php/logout.php">
                        <!--<i class="fas fa-shopping-cart"></i>-->
                        <i class="fa-solid fa-right-from-bracket"></i>
                    </a>
                </div>
            </div>
        </header>
        <main>
EOT;
}
// Template footer
function template_footer() {
$year = date('Y');
echo <<<EOT
        </main>
        <footer>
            <div class="content-wrapper">
                <p>&copy; $year, THE Shopping Cart</p>
            </div>
        </footer>
        <script src="script.js"></script>
    </body>
</html>
EOT;
}
?>