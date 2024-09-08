<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
       $ingredient = new Ingredient();
        $ingredient->setNom('Ingredient #1')
                    ->setPrix(3.0)
                ->setCreatedAt


        $manager->flush();
    }
}
