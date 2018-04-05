<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 11/10/17
 * Time: 16:07
 * PHP version 7
 */

namespace Controller;
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

        $good = [];
        $neutral = [];
        $bad = [];

        foreach ($heroes as $hero) {
            $alignment = $hero->biography->alignment;
            if ($alignment == 'good') {
                $good[] = new Hero(intval($hero->id), $hero->name, intval($hero->powerstats->intelligence), intval($hero->powerstats->strength), intval($hero->powerstats->speed), intval($hero->powerstats->durability), intval($hero->powerstats->power), intval($hero->powerstats->combat), $hero->appearance->gender, $hero->appearance->race, $hero->biography->alignment, $hero->images->sm);
            } elseif ($alignment == 'neutral' || $alignment == '-') {
                $neutral[] = new Hero(intval($hero->id), $hero->name, intval($hero->powerstats->intelligence), intval($hero->powerstats->strength), intval($hero->powerstats->speed), intval($hero->powerstats->durability), intval($hero->powerstats->power), intval($hero->powerstats->combat), $hero->appearance->gender, $hero->appearance->race, $hero->biography->alignment, $hero->images->sm);
            } else {
                $bad[] = new Hero(intval($hero->id), $hero->name, intval($hero->powerstats->intelligence), intval($hero->powerstats->strength), intval($hero->powerstats->speed), intval($hero->powerstats->durability), intval($hero->powerstats->power), intval($hero->powerstats->combat), $hero->appearance->gender, $hero->appearance->race, $hero->biography->alignment, $hero->images->sm);
            }
        }

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
        // Récupérer 12 héros aléatoirement en fonction de l'alignement
            // Générer 12 id de 1 à 731


        try {
            return $this->twig->render('Super/team.html.twig', []);
        } catch (\Exception $e) {
            $e->getMessage();
        }
    }
}
