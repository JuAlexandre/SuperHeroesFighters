<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 11/10/17
 * Time: 16:07
 * PHP version 7
 */

namespace Controller;



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
}
