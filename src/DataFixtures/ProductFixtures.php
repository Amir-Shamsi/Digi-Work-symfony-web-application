<?php

namespace App\DataFixtures;

use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ProductFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
         $product0 = new Product();
         $product0->setSerial('111');
         $product0->setName('پکیج طلایی');
         $product0->setPrice('۱۰,۰۰۰,۰۰۰');
         $arr0 = array('تعداد دفعات مراجعه' => '12', 'زمان مراجعه'=>'تا 24 ساعت بعد');
         $product0->setDetails($arr0);
         $manager->persist($product0);


         $product1 = new Product();
         $product1->setSerial('222');
         $product1->setName('پکیج نقره ای');
         $product1->setPrice('۷,۰۰۰,۰۰۰');
         $arr1 = array('تعداد دفعات مراجعه' => '8', 'زمان مراجعه'=>'تا 48 ساعت بعد');
         $product1->setDetails($arr1);
         $manager->persist($product1);


         $product2 = new Product();
         $product2->setSerial('333');
         $product2->setName('پکیج برنزی');
         $product2->setPrice('۴,۰۰۰,۰۰۰');
         $arr2 = array('تعداد دفعات مراجعه' => '4', 'زمان مراجعه'=>'تا 72 ساعت بعد');
         $product2->setDetails($arr2);
         $manager->persist($product2);


         $manager->flush();
    }
}
