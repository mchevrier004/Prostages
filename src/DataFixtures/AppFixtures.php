<?php

namespace App\DataFixtures;

use App\Entity\Entreprise;
use App\Entity\Formation;
use App\Entity\OffreStage;
use App\Entity\User;
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
            $entreprise->setType($faker->randomElement(['Développement Web','Programmation informatique']));
            $entreprise->setSite($faker->url);
            $entreprise->setAdresse($faker->address);
            $entreprise->setTel($faker->phoneNumber);
            $manager->persist($entreprise);
        
            $formation = new Formation();
            $formation->setNom($faker->randomElement(['DUT Informatique','DU TIC','GIM','DUT GEA','LP Info']));
            $formation->setDiplome($faker->randomElement(['Bac+1','Bac+2','Bac+3','Bac+4','Bac+5']));
            $manager->persist($formation);
        
            $stage = new OffreStage();
            $stage->setDescription($faker->text(50));
            $stage->setNom($faker->randomElement(['Stage Technicien informatique','Stage développeur web','Stage Symfony']));
            $stage->setMail($faker->email);
            $stage->setTel($faker->phoneNumber);
            $stage->addFormation($formation);

            $stage->setEntreprise($entreprise);
            $stage->addFormation($formation);

            $manager->persist($stage);
        }
        $testAdmin = new User();
        $testAdmin->setUsername("testAdmin");
        $testAdmin->setPassword('$2y$10$xGA/WI3VlFlZYg5hHj18y.H3QJADTpW/P6zIDjyMmJI1En6yy7dSO');
        $testAdmin->setRoles(["ROLE_ADMIN"]);
        $testUser = new User();
        $testUser->setUsername("testUser");
        $testUser->setPassword('$2y$10$KwO/a8TN2DbZEHHxwx4LdO5PtL6UXOu3c5/uMvZFIaKC6osPCetMW');
        $testUser->setRoles(["ROLE_USER"]);
        $manager->persist($testAdmin);
        $manager->persist($testUser);
        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }
}
?>