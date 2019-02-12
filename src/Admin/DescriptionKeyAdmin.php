<?php

namespace App\Admin;

use App\Entity\City;
use App\Entity\DescriptionKey;
use App\Entity\JosContent;
use App\Entity\Product;
use App\Entity\Company;
use App\Entity\ProductRubric;
use App\Entity\Region;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Route\RouteCollection;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Sonata\AdminBundle\Form\Type\ModelType;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class DescriptionKeyAdmin extends AbstractAdmin
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
        $id = $this->getRequest()->get('id');
        $formMapper
            ->tab('Основные данные')
            ->with('Номер организации', ['class' => 'col-md-4'])
            ->add('content',ChoiceType::class, [
                'data' => $id,
                'choices' =>[  $id => $id, ],
                'expanded' => true,
                'mapped' => false,
                'required' => true,
                'label' => 'контент id '.$id,
            ])
            ->add('companyId', NumberType::class, [
                'label' => 'id организации',
            ])
            ->end()
            ->with('Раздел', ['class' => 'col-md-4'])
            ->add('key', TextType::class, [
                'required' => false,
                'label' => 'Ключ'
                ])
            ->add('description', TextType::class, [
                'required' => false,
                'label' => 'Описание'
                ])
            ->end();
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
//            ->add('id')
            ->add('companyId', null, [
                'label' => 'id организации',
                'show_filter' => true
            ]);
//            ->add('categoryProduct', null, ['show_filter' => true], EntityType::class, [
//                'class'    => ProductRubric::class,
//                'choice_label' => 'title',
//            ]);
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
//            ->add('id')
            ->addIdentifier('companyId', null, [
                'label' => 'Id организации',
            ])
            ->add('key', null, [
                'label' => 'Ключ'
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
            ->add('companyId');
    }

    public function toString($object)
    {
        return $object instanceof DescriptionKey
            ? $object->getCompanyId()
            : 'ID Компании'; // shown in the breadcrumb on the create view
    }

    protected function configureRoutes(RouteCollection $collection)
    {
        if ($this->isChild()) {
            return;
        }

        // This is the route configuration as a parent
        $collection->clear();

    }
}