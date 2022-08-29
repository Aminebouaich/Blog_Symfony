<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Article;

class ArticteFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for($i = 1;$i <= 10; $i++ ){
        $article = new Article();
        
        $article->setTitle("Titre de l'article n°$i")
                ->setContent("<p>Contenu de l'article n°$i</p>")
                ->setImage("https://via.placeholder.com/468x60?text=Visit+Blogging.com+Now")
                ->setCreatedAt(new \DateTimeImmutable());

        $manager->persist($article);

    }
        $manager->flush();
    }
}
