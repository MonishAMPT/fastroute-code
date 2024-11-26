<?php

use FastRoute\RouteCollector;
use FastRoute\ConfigureRoutes;
include __DIR__."/../v1/test.php";
$obj = new testing;
return function (RouteCollector $r) {
    $obj = new testing;
    // header('Content-Type: application/json; charset=utf-8');


    $r->addGroup('/api/projects', function (FastRoute\RouteCollector $r)use($obj) {
        $r->get('/testing/test', function()use($obj){
            $obj->hello();
        });
        $r->get("/",function()use($obj){
            $obj->display(1);
        });
    });
    $r->addGroup('/api/tasks', function (FastRoute\RouteCollector $r)use($obj) {
    
        $r->get("/",function()use($obj){
            $obj->display(2);
        });
    });


    

    $r->addRoute('GET', '/api/test', 'test_get');
    $r->addRoute('POST', '/api/test', 'test_post');
    $r->addRoute('GET', '/api/items', 'items_get');
    $r->addRoute('POST', '/api/items', 'items_post');
    $r->addRoute('GET', '/api/items/1', 'item_get_1');

    // $r->get('/api/testing/test', 'helloworld');
    $r->get('/api/test/{id:\d+}/test/{id2:\d+}', 'getid');
    $r->delete('/api/test/delete/{id:\d+}', 'delete');
    $r->post('/api/test/{test:\d+}', 'postdata');

    $r->get('/api/class', function() use($obj) {
        // $test->hello();
        $obj->hello();
    });

//     $r->get('/api/class/{id:\d+}', function($vars) use($test) {
//         $test->display($vars['id']);
//     });

//     $r->post('/api/class/{id:\d+}', function($vars) use($test) {
//         $data = json_decode(file_get_contents('php://input'), true);
//         $id = $vars['id'];
//         $test->displaydata($id, $data);
//     });
};
