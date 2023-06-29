<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Item;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\String\Slugger\AsciiSlugger;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        $slugger = new AsciiSlugger();
        $categories = ["My Little Pony", "Spongebob", "Hello Kitty", "Winx",
            "Animals"];
        $items = [
            "My Little Pony" => ["PINKY PONY", "HEART PONY", "TREE CUTE PONIES",
                "PURPLE PONY", "ORANGE PONY WITH FANCY HAIR"],
            "Spongebob" => ["HAPPY SPONGE", "LOVELY SPONGE", "CUTE SPONGE", "PATRICK STAR"],
            "Hello Kitty" => ["FIRST PRETTY KITTY", "SECOND PRETTY KITTY", "THIRD PRETTY KITTY",
                "FOURTH PRETTY KITTY", "FIFTH PRETTY KITTY", "SIXTH PRETTY KITTY"],
            "Winx" => ["NICE ONE", "EVEN BETTER", "SEXY CHICK", "CUTE GIRL","NOT BAD CHICK",
                "SAD CHICK"],
            "Animals" => ["BIRD IS A WORD", "DEFINITELY NOT ASIA'S DOGGY", "SHEEP MAKE MEEEEEEEE"],
        ];

        foreach ($categories as $category)
        {
            $product = new Category();
            $product->setName($category);
            $product->setSlug($slugger->slug(strtolower($category)));
            $manager->persist($product);
            $categoryItems = $items[$category];
            for($i=0; $i<count($categoryItems); $i++)
            {
                $item = new Item();
                $item->setName($categoryItems[$i]);
                $item->setPrice(35.00);
                $item->setVintedLink("https://www.vinted.pl/member/92136012-asiastasiak123");
                $item->setAllegroLink("https://allegro.pl");
                $item->setOlxLink("https://www.olx.pl");
                $item->setCategory($product);
                $manager->persist($item);
            }

        }

        $manager->flush();
    }
}
