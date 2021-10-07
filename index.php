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

//http://localhost/git-routing/img/condor.jpg

$router->get('/walibi/photos/{photoId}', function($photoId) use ($router) {
    if (file_exists('./img/'.$photoId.'.jpg')) {
        echo '<img src="http://localhost/git-routing/img/' . $photoId . '.jpg">';

    } else {
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