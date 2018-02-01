<?php
/**
 * Created by PhpStorm.
 * User: Kensaj
 * Date: 30.01.2018
 * Time: 14:02
 */

namespace AppBundle\DataFixtures\ORM;


use AppBundle;
use Doctrine\Bundle\FixturesBundle\ORMFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
//require_once '/path/to/Faker/src/autoload.php';

class LoadPostData implements ORMFixtureInterface
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */


    public function load(ObjectManager $manager)
    {
        // TODO: Implement load() method.
        $faker = \Faker\Factory::create();
        for($i=0; $i<=1000; $i++)
        {
            $post =new \AppBundle\Entity\Post();
            $post ->setTitle($faker->sentence);
            $post ->setLead($faker->text(100));
            $post ->setContent($faker->text(700));
            $post ->setCreatedAt($faker ->dateTimeThisMonth);

            $manager ->persist($post);
            }
            $manager ->flush();
    }
}