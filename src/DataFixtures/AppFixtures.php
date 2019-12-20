<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;
use App\Entity\Entreprise;
use App\Entity\Formation;
use App\Entity\OffreStage;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = \Faker\Factory::create('fr_FR');
        for($i = 0;$i < 10;$i++){
            $stage = new OffreStage;
            $stage->setDescription($faker->text(50));
            $stage->setNom($faker->randomElement('Stage Technicien informatique','Stage développeur web','Stage Symfony'));
            $stage->setMail($faker->email);
            $stage->setTel($faker->phoneNumber);
            $stage->addFormation($faker->randomElement('DUT Informatique','DU TIC','GIM','DUT GEA','LP Info'));
            $entreprise = new Entreprise;
            $entreprise->setNom($faker->company);
            $entreprise->setType($faker->randomElement('Développement Web','Programmation informatique'));
            $entreprise->setSite($faker->url);
        }
        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }
}
