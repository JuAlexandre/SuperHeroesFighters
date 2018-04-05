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
use Model\Hero;


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
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function index()
    {
        session_start();

        $clientGuzzle = new \GuzzleHttp\Client([
                'base_uri' => 'https://cdn.rawgit.com/akabab/superhero-api/0.2.0/api/',
            ]
        );

        try {
            $heroesList = $clientGuzzle->request('GET', 'all.json');
        } catch (\Exception $e) {
            $e->getMessage();
        }

        $heroes = json_decode($heroesList->getBody());

        $goods = [];
        $neutrals = [];
        $bads = [];

        foreach ($heroes as $hero) {
            $alignment = $hero->biography->alignment;
            $params = [new Hero(intval($hero->id), $hero->name, intval($hero->powerstats->intelligence), intval($hero->powerstats->strength), intval($hero->powerstats->speed), intval($hero->powerstats->durability), intval($hero->powerstats->power), intval($hero->powerstats->combat), $hero->appearance->gender, $hero->appearance->race, $hero->biography->alignment, $hero->images->sm)];
            if ($alignment == 'good') {
                $goods[] = $params;
            } elseif ($alignment == 'neutral' || $alignment == '-') {
                $neutrals[] = $params;
            } else {
                $bads[] = $params;
            }
        }
        $_SESSION['goods'] = $goods;
        $_SESSION['neutrals'] = $neutrals;
        $_SESSION['bads'] = $bads;

        try {
            return $this->twig->render('Super/index.html.twig', []);
        } catch (\Exception $e) {
            $e->getMessage();
        }
    }

    public function chooseHero()
    {
        session_start();

        //données fixtures
        $player = new Player('toto', 'good');
        $cpu = new Player('cpu', 'vilain');
        $_SESSION['fight'] = new Fight($player, $cpu);

        //fin données fixtures

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

    /**
     * Display team list
     *
     * @param $alignment
     * @return string
     */
    public function team()
    {
        session_start();
        $_POST['alignment'] = 'good';
        if (empty($_POST['alignment'])) {
            throw new \LogicException('Un alignement doit être choisi.');
        }

        $alignment = $_POST['alignment'];

        if ($alignment == 'good') {
            $goods = array_merge($_SESSION['goods'], $_SESSION['neutrals']);
            $numbersGood = count($goods);
            $preselectedHeroes = [];
            for ($i=0; $i<12; $i++) {
                $preselectedHeroes[] = $goods[rand(0, $numbersGood)][0];
            }
        } elseif ($alignment == 'bad') {
            $bads = array_merge($_SESSION['bads'], $_SESSION['neutrals']);
            $numbersBads = count($bads);
            $preselectedHeroes = [];
            for ($i=0; $i<12; $i++) {
                $preselectedHeroes[] = $bads[rand(0, $numbersBads)][0];
            }
        }

        try {
            return $this->twig->render('Super/team.html.twig', ['preselectedHeroes' => $preselectedHeroes]);
        } catch (\Exception $e) {
            $e->getMessage();
        }
    }
}
