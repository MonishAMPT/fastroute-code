<?php

use FastRoute\RouteCollector;

return function (RouteCollector $r) {

    // header('Content-Type: text/html; charset=utf-8' );


    $r->get('/', function() {
        require __DIR__ . '/../views/main.php';
    });

    $r->get('/about', function() {
        require __DIR__ . '/../views/about.php';
    });

    // $r->get('/classtest', function() {
    //     if (isset($_GET['id'])) {
    //         echo ($_GET['id']);
    //     } else {
    //         echo json_encode(["error" => "ID parameter missing"]);
    //     }
    // });
};
