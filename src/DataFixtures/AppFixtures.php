<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Item;
use App\Entity\Review;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\String\Slugger\AsciiSlugger;

class AppFixtures extends Fixture
{

    private $hasher;

    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->hasher = $hasher;
    }

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
            "Winx" => ["PARTY WINX", "BLASE WINX", "PRETTY ONE", "CUTE WINX","ANOTHER WINX",
                "SAD WINX"],
            "Animals" => ["BIRD IS A WORD", "DEFINITELY NOT ASIA'S DOGGY", "SHEEP MAKE MEEEEEEEE"],
        ];
        $reviews = [
            ["Natalie2003", 5, "Amazing painting of my favourite animated character - Spongebob. 
                This little, cute sponge gives meaning to my life! 
                Thanks to Asia's Art, I can admire it every day ❤️."],
            [
                "FattyFat", 3, "BIRD IS THE WORD"
            ],
            [
                "Definitely not Asia", 4, "It's okay..."
            ],
            [
                "RadekB", 5, "Just one word... WOW
                    I didn't assume she could paint so nicely!
                    Her painting are wonderful and if I have a lot of unnecessary I will buy everything that she'll paint
                    And yes I'm her bf so my opinion about her artworks is biased."
            ]
        ];
        $photos = ['1.jpg', '2.jpg', '3.jpg', '4.jpg', '5.jpg', '6.jpg', '7.jpg',
            '8.jpg', '9.jpg', '10.jpg', '11.jpg', '12.jpg', '13.jpg', '14.jpg',
            '15.jpg', '16.jpg', '17.jpg', '18.jpg', '19.jpg', '20.jpg', '21.jpg',
            '22.jpg', '23.jpg', '24.jpg'];


        $realItems = [];
        $realUsers = [];
        for($i=1; $i<=4; $i++)
        {
            $user = new User();
            $user->setEmail('example'.$i.'@example.com');
            $password = $this->hasher->hashPassword($user, 'example123');
            $user->setPassword($password);
            $user->setIsVerified(true);
            $realUsers[] = $user;
            $manager->persist($user);
        }

        $counter = 0;
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
                $item->setPrice(rand(25,50));
                $item->setVintedLink("https://www.vinted.pl/member/92136012-asiastasiak123");
                $item->setAllegroLink("https://allegro.pl");
                $item->setOlxLink("https://www.olx.pl");
                $item->setCategory($product);
                $item->setImage($photos[$counter]);
                $counter++;
                if($i%3==0)
                {
                    $item->setReserved(true);
                    $item->setCustomer($user);
                }
                if ($i%4==0)
                {
                    $item->setReserved(true);
                    $item->setSold(true);
                    $item->setCustomer($user);
                    $realItems[] = $item;
                }
                $manager->persist($item);
            }
        }
        $a = 0;
        foreach ($reviews as $review)
        {
            $rev = new Review();
            $rev->setUsername($review[0]);
            $rev->setRating($review[1]);
            $rev->setReview($review[2]);
            $rev->setUser($realUsers[$a]);
            $a++;
            $rev->setItem($realItems[$a]);
            $manager->persist($rev);
        }

        $admin = new User();
        $admin->setEmail("admin@admin.com");
        $password = $this->hasher->hashPassword($admin, "admin");
        $admin->setPassword($password);
        $admin->setRoles((array)"ROLE_ADMIN");
        $admin->setIsVerified(true);
        $manager->persist($admin);

        $manager->flush();
    }
}
