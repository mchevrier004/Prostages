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
        $user1 = new User();
        $user1->setName("testAdmin");
        $user1->setPassword("$2y$10\$txg2q76UA9h3/3Rx0yne.uS26Dpg0dRyZZmQSzb26NZbJbzJcFcfe");
        $user1->setRole("ROLE_ADMIN");
        $user2 = new User();
        $user2->setName("testUser");
        $user2->setPassword("$2y$10\$rSsBNcYM4Inm1Wk/dArVnu4WLmt5c08vBUf6Eul9Iw6h2TLKq2ulS");
        $user2->setRole("ROLE_USER");
        $manager->persist($user1);
        $manager->persist($user2);
        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }
}
?>