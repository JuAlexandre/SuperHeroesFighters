<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 11/10/17
 * Time: 16:07
 * PHP version 7
 */

namespace Controller;

use GuzzleHttp\Client;
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

        $clientGuzzle = new Client([
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

        $_SESSION['heroes'] = array_merge($goods, $neutrals, $bads);
        $_SESSION['goods'] = $goods;
        $_SESSION['neutrals'] = $neutrals;
        $_SESSION['bads'] = $bads;

        $nbGoods = count($goods)-1;
        $nbBads = count($bads)-1;

        $heroGood = $goods[rand(0, $nbGoods)][0];
        $heroBad = $goods[rand(0, $nbBads)][0];


        try {
            return $this->twig->render('Super/index.html.twig', [
                'hero1' => $heroGood,
                'hero2' => $heroBad,
            ]);
        } catch (\Exception $e) {
            $e->getMessage();
        }
    }


    public function gameResult()
    {


        try {
            return $this->twig->render('Super/game_result.html.twig', []);
        } catch (\Exception $e) {
            $e->getMessage();
        }
    }

    public function chooseHero()
    {
        session_start();

        $heroesPlayer = [];

        for ($i = 0; $i < 6; $i++) {

            $idSearch = $_POST['ids'][$i];

            $heroesList = $_SESSION['heroes'];

            foreach ($heroesList as $hero) {
                $heroId = $hero[0]->getId();
                if ($heroId == $idSearch) {
                    $heroesPlayer[] = $hero[0];
                }
            }
        }
        $player = $_SESSION['player'];
        $player->setHeroes($heroesPlayer);

        $cpu = $_SESSION['cpu'];

        $alignmentPlayer = $player->getAlignment();


        if ($alignmentPlayer == 'good') {
            $goods = array_merge($_SESSION['bads'], $_SESSION['neutrals']);
            $numbersGood = count($goods);
            $cpuHeroes = [];
            for ($i=0; $i<6; $i++) {
                $cpuHeroes[] = $goods[rand(0, $numbersGood)][0];
            }
        } elseif ($alignmentPlayer == 'bad') {
            $bads = array_merge($_SESSION['goods'], $_SESSION['neutrals']);
            $numbersBads = count($bads);
            $cpuHeroes = [];
            for ($i=0; $i<6; $i++) {
                $cpuHeroes[] = $bads[rand(0, $numbersBads)][0];
            }
        }

        $cpu->setHeroes($cpuHeroes);

        $fight = new Fight($player, $cpu);


        if ($fight->getRound() > Fight::MAX_ROUND) {
            header('Location: /gameresult');
        }

        //type de round
        $rand = rand(0, count($fight->getAttaksType()) - 1);
        $roundAttakType = $fight->getAttaksType()[$rand];
        $attacksType = $fight->getAttaksType();
        array_splice($attacksType, $rand, 1);
        sort($attacksType);
        $fight->setAttakType($attacksType);


        $round = $fight->getRound() + 1;
        $fightersPlayer = $fight->getPlayer()->getHeroes();

        try {
            return $this->twig->render('Super/chooseHero.html.twig', [
                'round' => $round,
                'fightersPlayer' => $fightersPlayer,
                'attakType' => $roundAttakType,
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
     * @return string
     */
    public function round()
    {



        try {
            return $this->twig->render('Super/round.html.twig', []);
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
        session_start();

        if (empty($_POST['alignment'])) {
            throw new \LogicException('Un alignement doit être choisi.');
        }

        $alignment = $_POST['alignment'];

        $player = new Player($_POST['name'], $alignment);

        if ($alignment === 'good') {
            $cpu = new Player('CPU', 'bad');
        } else {
            $cpu = new Player('CPU', 'good');
        }

        $_SESSION['player'] = $player;
        $_SESSION['cpu'] = $cpu;

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

    public function roundResult()
    {
        try {
            return $this->twig->render('Super/round_result.html.twig', []);
        } catch (\Exception $e) {
            $e->getMessage();
        }
    }
}
