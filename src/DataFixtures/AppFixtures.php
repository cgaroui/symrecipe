<?php

namespace App\DataFixtures;

use Faker\Factory;
use Faker\Generator;
use App\Entity\Ingredient;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture
{

    /**
    *@var Generator
    */
    private Generator $faker;

    public function __construct()
    {
        $this->faker = Factory::create('fr_FR');
    }



    public function load(ObjectManager $manager): void
    {
        // Boucle pour créer 50 objets "Ingredient"
        for ($i = 0; $i < 50; $i++) { 
            // Création d'un nouvel objet Ingredient
            $ingredient = new Ingredient();
            
            // Définition du nom de l'ingrédient avec un index unique pour chaque élément
            $ingredient->setNom($this->faker->word())
                       // Définition du prix aléatoire de l'ingrédient, compris entre 0 et 100
                       ->setPrice(mt_rand(0, 100)); 
    
            // Prépare l'enregistrement de l'objet Ingredient dans la base de données
            $manager->persist($ingredient);          
        }
        
        // Enregistrement effectif de tous les ingrédients dans la base de données
        $manager->flush();
    }
    
    

}
