<?php

namespace App\Admin;

use App\Entity\JosModules;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Route\RouteCollection;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class JosModulesAdmin extends AbstractAdmin
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

        $formMapper
            ->add('title', TextType::class)
            ->add('content', TextareaType::class, [
                'required' => false,
                'attr' => [
                    'class' => 'mytextarea',
                ]
            ])
            ->add('published', ChoiceType::class, [
                'label' => 'Модуль включен',
                'expanded' => true,
                'choices' => [
                    'Да' => 1,
                    'Нет' => 0,]])
            ;
    }

    protected function configureDefaultFilterValues(array &$filterValues): void
    {
        $filterValues['title'] = [
//            'type' => StringFilter::CONDITION_AND, // Или TYPE_EXACT для точного совпадения
            'value' => 'Сквозной баннер',
        ];
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('title',null,[
//                'show_filter' => true,
//                'default' => [
//                    'value' => 'Сквозной баннер',
//                    'type' => null, // или 'exact', 'like', 'not_like' и т.д.
//                ],
            ])
        ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
//            ->addIdentifier('id')
            ->addIdentifier('title')
            ->addIdentifier('position')
            ->add('_action', null, [
                'actions' => [
//                    'show' => [],
                    'edit' => [],
//                    'delete' => [],
                ]]);;
    }

    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('title');
    }

    public function toString($object)
    {
        return $object instanceof JosModules
            ? 'Модуль '.$object->getId()
            : 'Модуль'; // shown in the breadcrumb on the create view
    }

    protected function configureRoutes(RouteCollection $collection)
    {
        $collection->remove('create');
        $collection->remove('export');
        $collection->remove('delete');
    }

}