<?php

namespace App\Controller\Admin;

use App\Entity\Contact;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ContactCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Contact::class;

    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
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
