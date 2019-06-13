<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Article;
use App\Entity\Category;
use App\Entity\Comment;

class ArticleFixtures extends Fixture
{
    /**
     * Load set of fake data to database for testing
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $faker = \Faker\Factory::create('en_US');

        // Create 3 fake categories
        for ($i = 1; $i <= 3; $i++) {
            $category = new Category();
            $category->setTitle($faker->sentence())
                    ->setDescription($faker->paragraph())
            ;

            $manager->persist($category);
            
            // Create 4 to 6 fake articles
            for ($j = 1; $j <= mt_rand(4, 6); $j++) {
                $content = '<p>' . join($faker->paragraphs(5), '</p><p>') . '<p>';

                $article = new Article();                
                $article->setTitle($faker->sentence())
                        ->setContent($content)
                        ->setImage($faker->imageUrl())
                        ->setCreatedAt($faker->dateTimeBetween('-6 months'))
                        ->setCategory($category)
                ;
    
                $manager->persist($article);            
                
                // Create 4 to 10 fake comments
                for ($k = 1; $k <= mt_rand(4, 10); $k++) {
                    $content = '<p>' . join($faker->paragraphs(2), '</p><p>') . '<p>';
                    $days = (new \DateTime())->diff($article->getCreatedAt())->days;
                    
                    $comment = new Comment();
                    $comment->setAuthor($faker->name)
                            ->setContent($content)
                            ->setCreatedAt($faker->dateTimeBetween('-' . $days . ' days'))
                            ->setArticle($article)
                    ;
        
                    $manager->persist($comment);
                }
            }
        }

        $manager->flush();
    }
}
