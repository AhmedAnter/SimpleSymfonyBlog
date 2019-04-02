<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Article;

class ArticleFixtures extends Fixture
{
    /**
     * Load set of fake articles to database for testing
     *
     * @param ObjectManager $manager
    */
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);
        for ($i = 1; $i <= 10; $i++) {
            // create a new article and fill its fields
            $article = new Article();
            $article->setTitle("article $i title")
                    ->setContent("<p>article $i content</p>")
                    ->setImage("http://placehold.it/350x0150")
                    ->setCreatedAt(new \DateTime())
            ;

            $manager->persist($article);
        }

        $manager->flush();
    }
}
