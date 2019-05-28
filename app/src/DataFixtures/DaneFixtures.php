<?php

namespace App\DataFixtures;

use App\Entity\Dane;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Class DaneFixtures
 */
class DaneFixtures extends AbstractBaseFixtures
{
    public function loadData(ObjectManager $manager):void
    {
        for ($i = 0; $i < 10; ++$i) {
            $dana = new Dane();
            $dana->setEmail($this->faker->email);
            $dana->setHaslo($this->faker->password);
            $dana->setTypKonta($this->faker->sentence);
            $this->manager->persist($dana);
        }


        $manager->flush();
    }
}
