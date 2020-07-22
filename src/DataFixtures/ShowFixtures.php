<?php


namespace App\DataFixtures;

use Faker;
use App\Entity\Show;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ShowFixtures extends Fixture
{
    /**
     * @inheritDoc
     */
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('en_US');
        for ($i = 0; $i < 10; $i++) {
            $show = new Show();
            $show->setTitle($faker->text($maxNbChars = 50));
            $show->setSummary($faker->paragraph);
            $manager->persist($show);
            $this->addReference('show_' . $i, $show);
        }
        $manager->flush();
    }
}