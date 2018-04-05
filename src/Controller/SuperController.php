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
use Model\Fight;
use Model\Player;


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

    public function chooseHero()
    {

        //données fixtures
        $player = new Player('toto', 'good');
        $cpu = new Player('cpu', 'vilain');
        $_SESSION['fight'] = new Fight($player, $cpu);

        //fin données fixtures

        session_start();

        if (empty($_SESSION['fight'])) {
            throw new \LogicException('Une partie doit exister.');
        }

        $fight = $_SESSION['fight'];

        if ($fight->getRound() > Fight::MAX_ROUND) {
            header('Location: /gameresult');
        }

        $round = $fight->getRound() + 1;
        $fightersPlayer = $fight->getPlayer()->getHeroes();


        try {
            return $this->twig->render('Super/chooseHero.html.twig', [
                'round' => $round,
                'fightersPlayer' => $fightersPlayer,
            ]);
        } catch (\Exception $e) {
            echo $e->getMessage();
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

    public function round()
    {
        try {
            return $this->twig->render('Super/round.html.twig', []);
        } catch (\Exception $e) {
            $e->getMessage();

        }
    }
}
