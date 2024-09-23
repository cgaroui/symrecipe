<?php

namespace App\DataFixtures;

use Faker\Factory;
use Faker\Generator;
use App\Entity\Ingredient;
use App\Entity\Recipe;
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
        //ingredients 
        $ingredients = [];
        // Boucle pour créer 50 objets "Ingredient"
        for ($i = 0; $i < 50; $i++) { 
            // Création d'un nouvel objet Ingredient
            $ingredient = new Ingredient();
            
            // Définition du nom de l'ingrédient avec un index unique pour chaque élément
            $ingredient->setNom($this->faker->word())
                       // Définition du prix aléatoire de l'ingrédient, compris entre 0 et 100
                       ->setPrice(mt_rand(0, 100)); 
    

            $ingredients[] = $ingredient;
            // Prépare l'enregistrement de l'objet Ingredient dans la base de données
            $manager->persist($ingredient);          
        }


        // Recipes
        $recipes = [];
        for ($j = 0; $j < 25; $j++) {
            $recipe = new Recipe();
            $recipe->setName($this->faker->word())
                ->setTime(mt_rand(0, 1) == 1 ? mt_rand(1, 1440) : null)
                ->setNbPeople(mt_rand(0, 1) == 1 ? mt_rand(1, 50) : null)
                ->setDifficulty(mt_rand(0, 1) == 1 ? mt_rand(1, 5) : null)
                ->setDescription($this->faker->text(300))
                ->setPrice(mt_rand(0, 1) == 1 ? mt_rand(1, 1000) : null)
                ->setFavorite(mt_rand(0, 1) == 1 ? true : false);

                for ($k = 0; $k < mt_rand(5, 15); $k++) {
                    $recipe->addIngredient($ingredients[mt_rand(0, count($ingredients) - 1)]);         
                }
                $manager->persist($recipe);
        }
        
        // Enregistrement effectif de tous les ingrédients dans la base de données
        $manager->flush();
    }
    
    

}
