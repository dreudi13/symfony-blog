<?php

namespace App\DataFixtures;

use App\Entity\Article;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ArticleFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < 50; $i++) {
            $article = (new Article)
                ->setTitle("Title $i")
                ->setContent("Content $i...")
            ;

            $manager->persist($article);
        }

        $manager->flush();
    }
}
