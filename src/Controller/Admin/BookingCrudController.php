<?php

namespace App\Controller\Admin;

use App\Entity\Booking;
use App\Entity\User;
use Doctrine\DBAL\Types\TextType;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class BookingCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Booking::class;


    }


/*
        public function configureFields(string $pageName): iterable
        {
            return [
                IdField::new('id'),
               TextField::new('title'),
              TextEditorField::new('description'),
    TextField::new('client')->hideOnForm(),
            ];
        }

*/
    public function configureActions(Actions $actions): Actions
    {

        $detail = Action::new('detail', 'Detail', 'fa fa-book')
            ->linkToCrudAction(Crud::PAGE_DETAIL)
            ->addCssClass('btn btn-info')
        ;



        return $actions ->disable(Action::EDIT)

            ->add(Crud::PAGE_INDEX, $detail);

    }
}
