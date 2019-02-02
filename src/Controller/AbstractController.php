<?php

namespace Controller;

use Twig_Loader_Filesystem;
use Twig_Environment;

/**
 * Class AbstractController
 * @package Controller
 */
abstract class AbstractController
{
    /**
     * @var Twig_Environment $twig
     */
    protected $twig;

    /**
     * Initializes this class.
     */
    public function __construct()
    {
        $loader = new Twig_Loader_Filesystem(APP_VIEW_PATH);
        $this->twig = new Twig_Environment($loader, ['cache' => !APP_DEV, 'debug' => APP_DEV]);
        $this->twig->addExtension(new \Twig_Extension_Debug());
    }
}
