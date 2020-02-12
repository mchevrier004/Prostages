<?php

namespace App\DataFixtures;

use App\Entity\Entreprise;
use App\Entity\Formation;
use App\Entity\OffreStage;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = \Faker\Factory::create('fr_FR');
        for($i = 0;$i < 10;$i++){
            $entreprise = new Entreprise();
            $entreprise->setNom($faker->company);
            $entreprise->setType($faker->randomElement('Développement Web','Programmation informatique'));
            $entreprise->setSite($faker->url);
            $entreprise->setAdresse($faker->address);
            $entreprise->setTel($faker->phoneNumber);
        
            $formation = new Formation();
            $formation->setNom($faker->randomElement('DUT Informatique','DU TIC','GIM','DUT GEA','LP Info'));
            $formation->setDiplome($faker->randomElement('Bac+1','Bac+2','Bac+3','Bac+4','Bac+5'));
        
            $stage = new OffreStage();
            $stage->setDescription($faker->text(50));
            $stage->setNom($faker->randomElement('Stage Technicien informatique','Stage développeur web','Stage Symfony'));
            $stage->setMail($faker->email);
            $stage->setTel($faker->phoneNumber);
            $stage->addFormation($formation);

            $stage->setEntreprise($entreprise);
            $stage->addFormation($formation);

            $manager->persist($entreprise);
            $manager->persist($formation);
            $manager->persist($stage);
        }
        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }
}
