<?php

namespace App\DataFixtures;

use App\Entity\Article;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class ArticleFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create();

        for ($i = 0; $i < 50; $i++) {
            $article = new Article(
                $faker->sentence(),
                $faker->text($faker->numberBetween(150, 450))
            );

            $manager->persist($article);
        }

        $manager->flush();
    }
}
