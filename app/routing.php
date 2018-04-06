<?php
/**
 * This file hold all routes definitions.
 *
 * PHP version 7
 *
 * @author   WCS <contact@wildcodeschool.fr>
 *
 * @link     https://github.com/WildCodeSchool/simple-mvc
 */

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
