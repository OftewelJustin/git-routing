<?php

// Require composer autoloader
require __DIR__ . '/vendor/autoload.php';

// Create Router instance
$router = new \Bramus\Router\Router();

// Define routes
// ...
$router->get('/testpagina', function() {
    echo 'Test Page Contents';
});

$router->get('/login', function() {
    echo "<form method='post' action='http://localhost/git-routing/login'>";
    echo "<input type='text' name='name' id='name' placeholder='Name:'>";
    echo "<input type='password' name='password' id='password' placeholder='Password:'>";
    echo "<input type='submit' value='Submit'>";
    echo "</form>";
});

$router->post('/login', function() {
    echo 'Name:'. $_POST['name'];
    echo '<br>';
    echo 'Password:'. $_POST['password'];
});


$router->get('/walibi/photos/{photoId}', function($photoId) use ($router) {
    if (file_exists('./img/'.$photoId.'.jpg')) {
        echo '<img src="http://localhost/git-routing/img/' . $photoId . '.jpg">';

    } else {
        $router->trigger404();
        return;
    }

});

$router->get('/event/{eventId}', function($eventId) use ($router){
    if($eventId == 'reverze'){
        header('Location: https://www.reverze.be/');
    } else{
        $router->trigger404();
        return;
    }
});

$router->set404(function() {
    header('HTTP/1.1 404 Not Found');
    echo "404 Error";
});

// Run it!
$router->run();


?>