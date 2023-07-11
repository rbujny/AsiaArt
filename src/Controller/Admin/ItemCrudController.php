<?php

namespace App\Controller\Admin;

use App\Entity\Item;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ItemCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Item::class;
    }


    public function configureFields(string $pageName): iterable
    {
        yield IdField::new('ID')->hideOnForm();
        yield TextField::new("Name");
        yield NumberField::new("Price");
        yield Field::new("Vinted_Link")->hideOnIndex();
        yield Field::new("Olx_Link")->hideOnIndex();
        yield Field::new("Allegro_Link")->hideOnIndex();
        yield AssociationField::new("category")
            ->autocomplete();
        yield BooleanField::new("Reserved")->hideOnForm();
        yield BooleanField::new("Sold")->hideOnForm();
        yield ImageField::new('Image')
            ->setBasePath('img/')
            ->setUploadDir("public/img")
        ;
    }

}
