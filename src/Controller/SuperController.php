<?php

namespace Controller;

use GuzzleHttp\Client;
use Model\Fight;
use Model\Player;
use Model\Hero;

/**
 * Class SuperController
 * @package Controller
 */
class SuperController extends AbstractController
{
    /**
     * Display home.
     * @return string
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function index()
    {
        session_start();
        session_destroy();
        session_start();

        $clientGuzzle = new Client([
            'base_uri' => 'https://cdn.rawgit.com/akabab/superhero-api/0.2.0/api/',
        ]);

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
            $params = [
                new Hero(intval($hero->id),
                    $hero->name,
                    intval($hero->powerstats->intelligence),
                    intval($hero->powerstats->strength),
                    intval($hero->powerstats->speed),
                    intval($hero->powerstats->durability),
                    intval($hero->powerstats->power),
                    intval($hero->powerstats->combat),
                    $hero->appearance->gender,
                    $hero->appearance->race,
                    $hero->biography->alignment,
                    $hero->images->sm
                )];
            if ($alignment == 'good') {
                $goods[] = $params;
            } elseif ($alignment == 'neutral' || $alignment == '-') {
                $neutrals[] = $params;
            } else {
                $bads[] = $params;
            }
        }
        array_splice($bads, 397, 1);

        $_SESSION['heroes'] = array_merge($goods, $neutrals, $bads);
        $_SESSION['goods'] = $goods;
        $_SESSION['neutrals'] = $neutrals;
        $_SESSION['bads'] = $bads;

        $nbGoods = count($goods)-1;
        $nbNeutrals = count($neutrals)-1;
        $nbBads = count($bads)-1;

        $heroGood = $goods[rand(0, $nbGoods)][0];
        $heroNeutral = $neutrals[rand(0, $nbNeutrals)][0];
        $heroBad = $goods[rand(0, $nbBads)][0];

        try {
            return $this->twig->render('Super/index.html.twig', [
                'hero1' => $heroGood,
                'hero2' => $heroNeutral,
                'hero3' => $heroBad
            ]);
        } catch (\Exception $e) {
            $e->getMessage();
        }
    }

    /**
     * @return string
     */
    public function player()
    {
        try {
            return $this->twig->render('Super/player.html.twig', []);
        } catch (\Exception $e) {
            $e->getMessage();

        }
    }

    /**
     * Display team list.
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

    public function chooseHero()
    {
        session_start();

        if (isset($_SESSION['player']) && isset($_SESSION['cpu'])) {
            if (!empty($_SESSION['player']) && !empty($_SESSION['cpu'])) {
                if ($_SESSION['player']->getLife() <= 0 || $_SESSION['cpu']->getLife() <= 0) {
                    header('Location: /gameresult');
                    exit();
                }
            }
        }

        $heroesPlayer = [];

        if (!empty($_SESSION['fight'])) {
            $round =  $_SESSION['fight']->getRound();
        } else {
            $round = 0;
        }

        $nbHeroes = 6 - $round;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $ids = $_POST['ids'];
            sort($ids);
            for ($i = 0; $i < $nbHeroes; $i++) {

                $idSearch = $ids[$i];

                $heroesList = $_SESSION['heroes'];

                foreach ($heroesList as $hero) {
                    $heroId = $hero[0]->getId();
                    if ($heroId == $idSearch) {
                        $heroesPlayer[] = $hero[0];
                    }
                }
            }

        } else {
            $heroesPlayer = $_SESSION['player']->getHeroes();
        }



        $player = $_SESSION['player'];
        $player->setHeroes($heroesPlayer);

        $cpu = $_SESSION['cpu'];

        $alignmentPlayer = $player->getAlignment();


        if ($alignmentPlayer == 'good') {
            $goods = array_merge($_SESSION['bads'], $_SESSION['neutrals']);
            $numbersGood = count($goods);
            $cpuHeroes = [];
            for ($i=0; $i<$nbHeroes; $i++) {
                $randCpu = rand(0, $numbersGood);
                if ($randCpu < 0) {
                    $randCpu = 0;
                }
                $cpuHeroes[] = $goods[$randCpu][0];
            }
        } elseif ($alignmentPlayer == 'bad') {
            $bads = array_merge($_SESSION['goods'], $_SESSION['neutrals']);
            sort($bads);
            $numbersBads = count($bads);
            $cpuHeroes = [];
            for ($i=0; $i<6; $i++) {
                $randCpu = rand(0, $numbersBads);
                if ($randCpu < 0) {
                    $randCpu = 0;
                }
                $cpuHeroes[] = $bads[$randCpu][0];
            }
        }

        $cpu->setHeroes($cpuHeroes);

        if (!isset($_SESSION['fight'])) {
            $fight = new Fight($player, $cpu);
            $_SESSION['fight'] = $fight;
        } else {
            $fight = $_SESSION['fight'];
        }

        if ($fight->getRound() > Fight::MAX_ROUND) {
            header('Location: /gameresult');
        }

        $max = count($fight->getAttaksType()) - 1;
        if ($max < 0) {
            $max = 0;
        }
        $rand = rand(0, $max);
        $roundAttakType = $fight->getAttaksType()[$rand];
        $attacksType = $fight->getAttaksType();
        array_splice($attacksType, $rand, 1);
        sort($attacksType);
        $fight->setAttakType($attacksType);

        $_SESSION['roundAttackType'] = $roundAttakType;

        $round = $fight->getRound() + 1;
        $fight->setRound($round);
        $fightersPlayer = $fight->getPlayer()->getHeroes();

        $_SESSION['fight'] = $fight;

        $round = $fight->getRound();
        $nbHeroes = 6 - $round;

        try {
            return $this->twig->render('Super/chooseHero.html.twig', [
                'round' => $round,
                'fightersPlayer' => $fightersPlayer,
                'attakType' => $roundAttakType,
                'nbHeroes' => $nbHeroes,

            ]);
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }

    /**
     * @return string
     */
    public function round()
    {
        session_start();

        if (empty($_POST['hero'])) {
            $_POST['hero'] = 0;
        }

        $index = $_POST['hero'];
        $player = $_SESSION['player'];
        $playerHeroes = $player->getHeroes();
        $heroSelectedPlayer = $playerHeroes[$index];

        array_splice($playerHeroes, $index, 1);
        $player->setHeroes($playerHeroes);

        $cpu = $_SESSION['cpu'];
        $cpuHeroes = $cpu->getHeroes();
        $randIndex = rand(0, count($cpuHeroes)-1);
        $heroSelectedCpu = $cpu->getHeroes()[$randIndex];

        array_splice($cpuHeroes, $randIndex, 1);
        $cpu->setHeroes($cpuHeroes);


        $roundAttackType = $_SESSION['roundAttackType'];

        $getCarac = 'get' . ucfirst($roundAttackType);

        $damagePlayer = $heroSelectedPlayer->$getCarac();
        $damageCpu = $heroSelectedCpu->$getCarac();

        if ($damagePlayer > $damageCpu) {
            $diff = $damagePlayer - $damageCpu;
            $cpuLife = $cpu->getLife();
            $cpu->setLife($cpuLife-$diff);
        } else {
            $diff = $damageCpu - $damagePlayer;
            $playerLife = $cpu->getLife();
            $player->setLife($playerLife-$diff);
        }

        if (!isset($_SESSION['pvs'])) {
            $_SESSION['pvs'] = [];
        }
        $cpuPv = $cpu->getLife();
        $playerPV = $player->getLife();

        $_SESSION['pvs']['cpu'][] = $cpuPv;
        $_SESSION['pvs']['player'][] = $playerPV;

        $_SESSION['cpu'] = $cpu;
        $_SESSION['player'] = $player;

        try {
            return $this->twig->render('Super/round.html.twig', [
                'roundAttackType' => $roundAttackType,
                'fight' => $_SESSION['fight'],
                'player' => $player,
                'playerHero' => $heroSelectedPlayer,
                'cpu' => $cpu,
                'cpuHero' => $heroSelectedCpu,
            ]);
        } catch (\Exception $e) {
            $e->getMessage();
        }
    }

    /**
     * @return string
     */
    public function roundResult()
    {
        session_start();

        $player = $_SESSION['player'];
        $cpu = $_SESSION['cpu'];
        $fight = $_SESSION['fight'];

        try {
            return $this->twig->render('Super/round_result.html.twig', [
                'player' => $player,
                'cpu' => $cpu,
                'round' => $fight->getRound(),
            ]);
        } catch (\Exception $e) {
            $e->getMessage();
        }
    }

    /**
     * @return string
     */
    public function gameResult()
    {
        session_start();

        $cpuPvs = $_SESSION['pvs']['cpu'];
        $playerPvs = $_SESSION['pvs']['player'];
        $player = $_SESSION['player'];

        if (end($cpuPvs) > end($playerPvs)) {
            $win = 'perdu';
        } else {
            $win = 'gagné';
        }

        try {
            return $this->twig->render('Super/game_result.html.twig', [
                'cpuPvs' => $cpuPvs,
                'playerPvs' => $playerPvs,
                'player' => $player,
                'win' => $win,
            ]);
        } catch (\Exception $e) {
            $e->getMessage();
        }
    }
}
