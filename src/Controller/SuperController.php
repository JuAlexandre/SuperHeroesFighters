<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 11/10/17
 * Time: 16:07
 * PHP version 7
 */

namespace Controller;
use GuzzleHttp\Exception\GuzzleException;


/**
 * Class SuperController
 *
 */
class SuperController extends AbstractController
{

    /**
     * Display home
     *
     * @return string
     */
    public function index()
    {
        try {
            return $this->twig->render('Super/index.html.twig', []);
        } catch (\Exception $e) {
            $e->getMessage();
        }
    }

    /**
     * Display team list
     *
     * @return string
     */
    public function team()
    {
        try {
            return $this->twig->render('Super/team.html.twig', []);
        } catch (\Exception $e) {
            $e->getMessage();
        }
    }
}
