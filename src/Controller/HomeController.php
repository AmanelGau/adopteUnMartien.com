<?php

/**
 * Created by PhpStorm.
 * User: aurelwcs
 * Date: 08/04/19
 * Time: 18:40
 */

namespace App\Controller;

use Symfony\Component\HttpClient\HttpClient;

class HomeController extends AbstractController
{
    /**
     * Display home page
     *
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function index()
    {
        return $this->twig->render('Home/index.html.twig');
    }

    public function match()
    {
        $client = HttpClient::create();
        $apiKey = "J58UsoM5RD70wuHaOM42522bR6KSyoNk";
        $response = $client->request('GET', "https://api.giphy.com/v1/stickers/search?q=robot&api_key=$apiKey");
        $statusCode = $response->getStatusCode();
        if ($statusCode === 200) {
            $content = $response->toArray();
            $nbAleatoire = rand(0, count($content['data']) - 1);
            $image = $content['data'][$nbAleatoire]['images']['original']['url'];
        }

        $citation1 = "J'ai toujours su que l'humanité était cruelle, méchante, injuste, fourbe, inhumaine, j'ai voulu la quitter, pour de vrai, lui préférant une autre pourriture, plus saine, celle de la mort.";
        $citation2 =  "100 ans de...b...bo...non, de déchirements oui!";
        $citation3 = "Est-ce qu'on peut rejouer son tour? Je sais pas mais là ça craint un peu non?";
        $citation4 = "Il vaut mieux viser la perfection et la manquer que viser l'imperfection et l'atteindre.";
        $citation5 = "Est-ce qu'on est payé pour embrasser ça...? Parce qu'on risque sa vie en fait.";
        $citation6 = "Oula, il va falloir s'adapter!";
        $citation7 = "Vu l'isolement c'est déjà pas si mal";
        $citation8 = "Il vaut mieux viser la perfection et la manquer que viser l'imperfection et l'atteindre.";
        $citation9 = "L’amour est comme le vent, nous ne savons pas d’où il vient.";
        $citation10 = "Quand tu tombes amoureux de la lune, tu arrêtes de regarder les étoiles.";

        $compatibility = random_int(0, 100);
        $sentence = '';
        if ($compatibility >= 0 && $compatibility < 10) {
            $sentence = $citation1;
        } elseif ($compatibility >= 10 && $compatibility < 20) {
            $sentence = $citation2;
        } elseif ($compatibility >= 20 && $compatibility < 30) {
            $sentence = $citation3;
        } elseif ($compatibility >= 30 && $compatibility < 40) {
            $sentence = $citation4;
        } elseif ($compatibility >= 40 && $compatibility < 50) {
            $sentence = $citation5;
        } elseif ($compatibility >= 50 && $compatibility < 60) {
            $sentence = $citation6;
        } elseif ($compatibility >= 60 && $compatibility < 70) {
            $sentence = $citation7;
        } elseif ($compatibility >= 70 && $compatibility < 80) {
            $sentence = $citation8;
        } elseif ($compatibility >= 80 && $compatibility < 90) {
            $sentence = $citation9;
        } else {
            $sentence = $citation10;
        }

        return $this->twig->render('Home/match.html.twig', [
            'image' => $image,
            'nbAleatoire' => $nbAleatoire,
            'compatibility' => $compatibility,
            'sentence' => $sentence
            ]);
    }
}
