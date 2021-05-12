<?php

/**
 * Created by PhpStorm.
 * User: aurelwcs
 * Date: 08/04/19
 * Time: 18:40
 */

namespace App\Controller;

use Symfony\Component\HttpClient\HttpClient;
use App\Model\MatchManager;

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

            $compatibility = random_int(0, 99);
            $matchManager = new MatchManager();
            $sentence = $matchManager->getCitation(intdiv($compatibility, 10));

            return $this->twig->render('Home/match.html.twig', [
            'image' => $image,
            'nbAleatoire' => $nbAleatoire,
            'compatibility' => $compatibility,
            'sentence' => $sentence
            ]);
        }
    }
}
