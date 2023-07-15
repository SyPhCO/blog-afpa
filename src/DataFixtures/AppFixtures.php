<?php

namespace App\DataFixtures;

use App\Entity\Post;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create("fr_FR");
        for ($i = 0; $i < 20; $i++){
            $post = new Post();
            $post->setTitle($faker->words(5, true))
                 ->setContent($faker->realText(255));

            $manager->persist($post);
        }

        $manager->flush();
    }
}
