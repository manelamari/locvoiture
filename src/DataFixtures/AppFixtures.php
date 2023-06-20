<?php

namespace App\DataFixtures;

use App\Entity\Contact;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Generator;

class AppFixtures extends Fixture
{


   private Generator $faker;
   public function __construct()
   {
       $this->faker=Factory::create('fr_FR');
   }

    public function load(ObjectManager $manager): void
    {

//Contact
        for($i=0;$i<5;$i++){
            $contact=new Contact();
            $contact->setName($this->faker->name())
            ->setEmail($this->faker->email())

            ->setMessage($this->faker->text());

            $manager->persist($contact);
        }
        $manager->flush();
    }
}
