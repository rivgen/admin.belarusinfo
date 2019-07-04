<?php

namespace App\Admin;

use App\Entity\JosAdminClients;
use App\Entity\JosClientsKeywords;
use App\Entity\JosRubric;
use App\Entity\JosRubricClientTest;
use Doctrine\ORM\EntityRepository;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Admin\AdminInterface;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Route\RouteCollection;
use Sonata\Form\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Sonata\AdminBundle\Form\Type\ModelType;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Knp\Menu\ItemInterface as MenuItemInterface;
use Symfony\Component\Security\Core\Security;

class JosRubricClientTestAdmin extends AbstractAdmin
{

    protected $datagridValues = [

        // display the first page (default = 1)
//        '_page' => 1,

        // reverse order (default = 'ASC')
        '_sort_order' => 'ASC',

//         name of the ordered field (default = the model's id field, if any)
//        '_sort_by' => 'name',
    ];

    protected function configureFormFields(FormMapper $formMapper)
    {

//        $username = $this->security->getUser()->getUsername();
        $formMapper
//            ->add('id')
            ->add('newRubric', EntityType::class, [
                'label' => 'Название рубрики',
                'class' => JosRubric::class,
                'choice_label' => 'name',
                'query_builder' => function(EntityRepository $repo) {
                    return $repo->createQueryBuilder('r')->andWhere('r.level = 3')->orderBy('r.name');
                }
            ])
            ->add('published', ChoiceType::class, [
        'label' => 'Опубликовано',
//                'multiple' => true,
        'data' => true,
        'expanded' => true,
//                'required' => false,
        'choices' => [
            'Да' => 1,
            'Нет' => 0,]
    ])
            ->add('rubricDescription')
           ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('id', null, [
                'label' => 'Клиент',
                'show_filter' => true,
            ])
        ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        // удаляет ссылку на выбор плитки
        unset($this->listModes['mosaic']);
        $listMapper
//            ->add('id')
            ->addIdentifier('newRubric', EntityType::class, [
                'label' => 'Название рубрики',
                'class' => JosRubric::class,
                'associated_property' => 'name',
//                'query_builder' => function(EntityRepository $repo) {
//                    return $repo->createQueryBuilder('r')->andWhere('r.level = 3')->orderBy('r.name');
//                }
            ])
//            ->addIdentifier('newRubricId')
//            ->add('rubricId', null, [
//                'header_style' => 'width: 5%',
//                'row_align' => 'left'
//            ])
            ->add('published', 'choice', [
                'label' => 'Опубликовано',
//                'multiple' => true,
//                'data' => true,
//                'expanded' => true,
//                'required' => false,
                'choices' => [
                     1 => 'Да',
                     0 => 'Нет',]
            ])
            ->add('_action', null, [
                'actions' => [
//                    'show' => [],
                    'edit' => [],
                    'delete' => [],
                ]]);;
    }

// удаляет ссылку на создание "create"
    protected function configureRoutes(RouteCollection $collection)
    {
        if ($this->isChild()) {
            return;
        }

        // This is the route configuration as a parent
        $collection->clear();
        $collection->remove('create');
        $collection->remove('export');
        $collection->remove('delete');

    }

    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('keywords');
    }

    public function toString($object)
    {
        return $object instanceof JosRubricClientTest
            ? 'Организация'.$object->getId()
            : 'Организация'; // shown in the breadcrumb on the create view
    }

    public function configureExportFields(AdminInterface $admin, array $fields)
    {
        unset($fields['updatedAt']);

        return $fields;
    }

}