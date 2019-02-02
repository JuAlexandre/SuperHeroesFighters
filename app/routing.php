<?php

$routes = [
    'Super' => [ // Controller
        ['index', '/', 'GET'], // action, url, method
        ['player', '/player', 'GET'],
        ['team', '/team', 'POST'],
        ['chooseHero', '/choosehero', 'POST'],
        ['chooseHero', '/choosehero', 'GET'],
        ['round', '/round', 'POST'],
        ['roundResult', '/roundresult', 'GET'],
        ['gameResult', '/gameresult', 'GET'],
    ],
];
