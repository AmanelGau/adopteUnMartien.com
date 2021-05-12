<?php

namespace App\Model;

class MatchManager extends AbstractManager
{
    private array $apiArray = [];
    private array $citationsArray = [
        "J'ai toujours su que l'humanité était cruelle, méchante,
        injuste, fourbe, inhumaine, j'ai voulu la quitter, pour de vrai, lui préférant 
        une autre pourriture, plus saine, celle de la mort.",
        "100 ans de...b...bo...non, de déchirements oui!",
        "Est-ce qu'on peut rejouer son tour? Je sais pas mais là ça craint un peu non?",
        "Il vaut mieux viser la perfection et la manquer que viser l'imperfection et l'atteindre.",
        "Est-ce qu'on est payé pour embrasser ça...? Parce qu'on risque sa vie en fait.",
        "Oula, il va falloir s'adapter!",
        "Vu l'isolement c'est déjà pas si mal",
        "Il vaut mieux viser la perfection et la manquer que viser l'imperfection et l'atteindre.",
        "L’amour est comme le vent, nous ne savons pas d’où il vient.",
        "Quand tu tombes amoureux de la lune, tu arrêtes de regarder les étoiles."
    ];
    public function getApiArray($response)
    {
            $this->apiArray[] = $response;
        return $this->apiArray;
    }
    public function getRandomApi()
    {
    }

    public function getCitation(int $citationNumber): string
    {
        return $this->citationsArray[$citationNumber];
    }
}
