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
    private array $background = [
        "/assets/images/paysageMars1.jpg",
        "/assets/images/paysagePlage.jpg",
        "/assets/images/paysageCollines.jpg",
        "/assets/images/paysageMountains.jpg",
        "/assets/images/paysageForest1.jpg",
        "/assets/images/paysageForest2.jpg",
    ];

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
        session_start();
        if (isset($_SESSION["image"])) {
            unset($_SESSION["image"]);
        }
        if (isset($_SESSION["compatibility"])) {
            unset($_SESSION["compatibility"]);
        }
        return $this->twig->render('Home/index.html.twig');
    }

    public function match()
    {
        session_start();
        if (isset($_GET["robot"])) {
            $_SESSION["robot"] = $_GET["robot"];
            $_SESSION["robotImage"] = "/assets/images/robot-" . $_GET["robot"] . ".png";
            $_SESSION["backgroundImage"] = $this->background[0];
        }
        if (!isset($_SESSION["image"]) || !isset($_SESSION["compatibility"])) {
            $client = HttpClient::create();
            $apiKey = "J58UsoM5RD70wuHaOM42522bR6KSyoNk";
            $response = $client->request('GET', "https://api.giphy.com/v1/stickers/search?q=robot&api_key=$apiKey");
            $statusCode = $response->getStatusCode();
            if ($statusCode === 200) {
                $content = $response->toArray();
                $nbAleatoire = rand(0, count($content['data']) - 1);
                $_SESSION["image"] = $content['data'][$nbAleatoire]['images']['original']['url'];
            } else {
                $_SESSION["image"] = "";
            }
            $_SESSION["compatibility"] = random_int(0, 99);
        }
        $matchManager = new MatchManager();
        $sentence = $matchManager->getCitation(intdiv($_SESSION["compatibility"], 10));
        return $this->twig->render('Home/match.html.twig', [
            'image' => $_SESSION["image"],
            //'nbAleatoire' => $nbAleatoire,
            'compatibility' => $_SESSION["compatibility"],
            'sentence' => $sentence,
            'robot' => $_SESSION["robot"],
            'robotImage' => $_SESSION["robotImage"],
            'backgroundImage' => $_SESSION["backgroundImage"]
        ]);
    }
    public function background()
    {
        session_start();
        if (
            isset($_SESSION["image"]) &&
            isset($_SESSION["compatibility"]) &&
            isset($_SESSION["robot"]) &&
            isset($_SESSION["robotImage"]) &&
            isset($_SESSION["backgroundImage"])
        ) {
            $nbAleatoire = rand(0, count($this->background) - 1);
            $_SESSION["backgroundImage"] = $this->background[$nbAleatoire];
            header("Location: /home/match");
        } else {
            header("Location: /");
        }
    }
}
