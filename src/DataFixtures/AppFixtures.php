<?php

namespace App\DataFixtures;

use App\Entity\Admin;
use App\Entity\Adoptant;
use App\Entity\Annonce;
use App\Entity\Annonceur;
use App\Entity\Dog;
use App\Entity\Race;
use DateTimeImmutable;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        // fixture Admin

        $admin = new Admin();
        $admin
            ->setUsername("admin")
            ->setEmail('admin@gmail.com')
            ->setCity("lyon")
            ->setPassword(password_hash("007", PASSWORD_DEFAULT))
            ->setPhone("+3312345678")
            ->setZipCode("69");
        $manager->persist($admin);

        // Fixtures Adoptant
        $usersData = json_decode(file_get_contents("https://jsonplaceholder.typicode.com/users"), true);
        $adoptants = [];

        for ($i = 0; $i < 5; $i++) {
            $userData = $usersData[$i];
            $adoptant = new Adoptant();

            $fullname = explode(" ", $userData["name"]);
            $firstName = $fullname[0];
            $lastName = $fullname[1];
            $adoptant
                ->setUsername($userData["username"])
                ->setEmail($userData["email"])
                ->setCity($userData["address"]["city"])
                ->setPassword(password_hash("mdp" . $i, PASSWORD_DEFAULT))
                ->setPhone($userData["phone"])
                ->setZipCode($userData["address"]["zipcode"])
                ->setFirstname($firstName)
                ->setLastName($lastName);
            $manager->persist($adoptant);
            $adoptants[] = $adoptant;
        }
        // fixture annonceur

        $annonceurs = [];

        $assocName = ["SecondeChance", "RonRhone", "PAAW", "PetAdoption"];
        $assocData =
            [
                ["assocName" => "SPA", "email" => "SPA@gmail.com"],
                ["assocName" => "secondeChance", "email" => "secondeChance@gmail.com"],
                ["assocName" => "ronRhone", "email" => "ronRhone@gmail.com"],
                ["assocName" => "PAAW", "email" => "PAAW@gmail.com"],
                ["assocName" => "PetAdoption", "email" => "PetAdoption@gmail.com"],
            ];
        for ($i = 5; $i < 10; $i++) {
            $userData = $usersData[$i];
            $annonceur = new Annonceur();

            $annonceur
                ->setUsername($userData["username"])
                ->setEmail($assocData[$i - 5]["email"])
                ->setCity($userData["address"]["city"])
                ->setPassword(password_hash("mdp" . $i, PASSWORD_DEFAULT))
                ->setPhone($userData["phone"])
                ->setZipCode($userData["address"]["zipcode"])
                ->setName($assocData[$i - 5]["assocName"]);
            $manager->persist($annonceur);
            $annonceurs[] = $annonceur;
        }

        // Fixture Annonce
        $annonces = [];
        for ($i = 1; $i < 5; $i++) {
            $titleData = json_decode(file_get_contents("https://jsonplaceholder.typicode.com/posts/" . $i), true);
            $title = $titleData["title"];
            $randAnnonceur = mt_rand(0, count($annonceurs) - 1);
            $annonce = new Annonce();
            $date = new DateTimeImmutable();
            $annonce
                ->setIsAvailable(true)
                ->setTitle($title)
                ->setAnnonceur($annonceurs[$randAnnonceur])
                ->setCreatedAt($date)
                ->setModifiedAt($date);
            $manager->persist($annonce);
            $annonces[] = $annonce;
        }

        // Fixture Breed + Dog
        $dogsNames =
            [
                "Admiral",
                "Alfred",
                "Asher",
                "Barrett",
                "Bond",
                "Buddy",
                "Churchill",
                "Cyrano",
                "Dilbert",
                "Duke",
                "Farley",
                "Frito",
                "Hawk",
                "Hunter",
                "Jupiter",
                "Kingston",
                "Lex",
                "Meatball",
                "Nolan",
                "Pedro",
                "Redmond",
                "Rosco",
                "Rufus",
                "Spud",
                "Twinkie",
                "Whiskey"
            ];

        $breedDataAll = json_decode(file_get_contents("https://dogapi.dog/api/v2/breeds"), true);
        $breedData = $breedDataAll["data"];
        $races = [];
        for ($i = 0; $i < 10; $i++) {
            $name = $breedData[$i]["attributes"]["name"];
            $description = $breedData[$i]["attributes"]["description"];
            $race = new Race();
            $race
                ->setName($name)
                ->setDescritpion($description);
            $races[] = $race;
        }
        $dogs = [];
        $descrip = "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quid enim possumus hoc agere divinius? Vitae autem degendae ratio maxime quidem illis placuit quieta. Sin dicit obscurari quaedam nec apparere, quia valde parva sint, nos quoque concedimus; Duo Reges: constructio interrete. Non dolere, inquam, istud quam vim habeat postea videro; Quid ergo attinet dicere";
        $antec = "Nec enim, dum metuit, iustus est, et certe, si metuere destiterit, non erit; Hoc ille tuus non vult omnibusque ex rebus voluptatem quasi mercedem exigit.";

        foreach ($dogsNames as $dogName) {
            $dog = new Dog();
            $rnd = mt_rand(0, 1);
            $isAdopted = [true, false];

            $dog
                ->setName($dogName)
                ->setDescription($descrip)
                ->setAntecedant($antec)
                ->setAcceptAnimmals($isAdopted[$rnd])
                ->setIsAdopted(false);

            $randnb = mt_rand(1, 3);
            for ($i = 0; $i <= $randnb; $i++) {
                $randomNumber = mt_rand(0, count($races) - 1);
                $dog->addRace($races[$randomNumber]);
                $races[$randomNumber]->addDog($dog);
            }
            $randAnnonce = mt_rand(0, count($annonces) - 1);
            $dog->setAnnonce($annonces[$randAnnonce]);
            $dogs[] = $dog;
        }

        foreach ($dogs as $dog) {
            $manager->persist($dog);
        }
        foreach ($races as $race) {
            $manager->persist($race);
        }
        $manager->flush();
    }
}