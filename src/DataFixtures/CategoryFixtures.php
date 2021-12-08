<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;
use App\Entity\Category;
use Faker\Factory;

class CategoryFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

    for ($i = 1; $i <= 3; $i++)
    {
        $category = new Category();

        $sentence = $faker->sentence(4);
        $name = substr($sentence, 0, strlen($sentence) - 1);
        $category->setName($name)
                ->setDescription($faker->text(1500));

        $manager->persist($category);
    }

    $manager->flush();
}

}
