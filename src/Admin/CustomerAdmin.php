<?php

namespace App\Admin;

use App\Entity\City;
use App\Entity\Customer;
use App\Entity\JosContent;
use App\Entity\Product;
use App\Entity\Company;
use App\Entity\ProductRubric;
use App\Entity\Region;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Sonata\AdminBundle\Form\Type\ModelType;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class CustomerAdmin extends AbstractAdmin
{
    protected $datagridValues = [

        // display the first page (default = 1)
//        '_page' => 1,

        // reverse order (default = 'ASC')
        '_sort_order' => 'DESC',

        // name of the ordered field (default = the model's id field, if any)
//        '_sort_by' => 'updatedAt',
    ];

    protected function configureFormFields(FormMapper $formMapper)
    {
        $role = $this->getRoot()->getSubject()->getRoles();
        $formMapper
//            ->tab('Основные данные')
            ->with('Id', ['class' => 'col-md-2'])
//            ->add('id')
            ->end()
            ->with('Номер организации', ['class' => 'col-md-4'])
            ->add('email', EmailType::class)
            ->end()
            ->with('Раздел', ['class' => 'col-md-4'])
            ->add('username', TextType::class, [
                'required' => false,
//                'label' => 'Рубрика'
                ])
            ->add('roles')
            ->add('password', null, [
                'required' => false,
            ])
//            ->add('roles', ChoiceType::class, [
//                'multiple' => true,
////                'data' => 'roles',
//                'expanded' => true,
//                'required' => true,
////                'mapped' => false,
//                'choices' => [
//                    'Супер администратор' => 'ROLE_SUPER_ADMIN',
//                    'Администратор' => 'ROLE_ADMIN',
//                    'Копирайтер' => 'ROLE_CUSTOMER',
//                ],
//            ])
            ->end()
                ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('id');
//            ->add('title', null, [
//                'label' => 'id организации',
//                'show_filter' => true
//            ]);
//            ->add('categoryProduct', null, ['show_filter' => true], EntityType::class, [
//                'class'    => ProductRubric::class,
//                'choice_label' => 'title',
//            ]);
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('id')
            ->addIdentifier('email', null, [
                'label' => 'Id организации',
            ])
//            ->add('companies.id')
            ->add('_action', null, [
                'label' => 'Действия',
                'actions' => [
                    'show' => [],
                    'edit' => [],
                    'delete' => [],
                ]]);
//            ->add('companyId');
    }

    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
//            ->add('id')
            ->add('email');
    }

    public function toString($object)
    {
        return $object instanceof Customer
            ? $object->getId()
            : 'Компания'; // shown in the breadcrumb on the create view
    }
}