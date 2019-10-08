<?php

namespace App\DataFixtures;

use App\Entity\CodePostal;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;

class CodePostalFixtures extends Fixture
{
    //Sharing Objects between Fixtures
    public const CODE_POSTAL_REFERENCE = 'CodePostal';

    public const NBR_CODE_POSTAL = 50;

    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_BE');

        for ($i = 0; $i < self::NBR_CODE_POSTAL; $i++){
            $codePostal = new CodePostal();
            $codePostal->setCodePostal($faker->postcode);
            $manager->persist($codePostal);

            //Sharing Objects between Fixtures
            $this->addReference(self::CODE_POSTAL_REFERENCE.$i, $codePostal);
        }
        $manager->flush();
    }
}
