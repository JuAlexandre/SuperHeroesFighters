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
     * Display item listing
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

    public function player()
    {


        try {
            return $this->twig->render('Super/player.html.twig', []);
        } catch (\Exception $e) {
            $e->getMessage();
        }
    }
}
