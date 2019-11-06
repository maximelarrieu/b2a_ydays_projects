<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;
use App\Entity\Categories;
use App\Entity\People;
use App\Entity\Movie;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);

        $faker = Factory::create('fr_FR');

        $categories = ['Comedie', 'Policier', 'Action', 'Aventure', 'Drame'];
        $categorieTab = [];
        for ($i = 0; $i < sizeof($categories); $i++) {
            $category = new Categories();
            $category->setTitle($categories[$i]);
            $categoriesTab[] = $category;

            $manager->persist($category);
        }

        $actors = [];
        for ($p = 0; $p < 20; $p++) {
            $people = new People();
            $people->setLastName($faker->lastName)
                    ->setFirstName($faker->firstName)
                    ->setDescription($faker->sentence)
                    ->setPictures('https://randomuser.me/api/portraits/men/' . $p . '.jpg');

            $manager->persist($people);
            $actors[] = $people;
        }

        $movies = [];
        for ($m = 0; $m < 50; $m++) {
            $movie = new Movie();
            $movie->setTitle($faker->realText(20))
                    ->setSynopsis($faker->text)
                    ->setReleasedAt($faker->dateTimeBetween('-30 years'))
                    ->setImage('https://picsum.photos/500/200?random='. $m);

            $movieActors = $faker->randomElements($actors, $faker->numberBetween(1, 20));
            foreach($movieActors as $actor) {
                $movie->addPerson($actor);
            }
            $movieCategories = $faker->randomElements($categories, $faker->numberBetween(0, 5));
            foreach($movieCategories as $categorie) {
                $movie->addCategory($category);
            }

            $manager->persist($movie);

        }

        $manager->flush();
    }
}
