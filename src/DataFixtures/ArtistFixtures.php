<?php


namespace App\DataFixtures;

use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Faker;
use App\Entity\Artist;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ArtistFixtures extends Fixture implements DependentFixtureInterface
{
    /**
     * @inheritDoc
     */
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('en_US');
        for ($i = 0; $i < 10; $i++) {
            $artist = new Artist();
            $artist->setName($faker->name);
            $artist->setPresentation($faker->paragraph);
            $manager->persist($artist);
            $this->addReference('artist_' . $i, $artist);
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return [ShowFixtures::class];
    }
}