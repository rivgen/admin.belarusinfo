<?php

namespace App\Admin;

use App\Entity\JosContent;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Admin\AdminInterface;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
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

class StatAdmin extends AbstractAdmin
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

//        $username = $this->security->getUser()->getUsername();
        $formMapper
            ->add('count', null, [
                'label' => 'счетчик',
            ]);
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
//            ->add('id')
            ->add('id', null, [
                'label' => 'Клиент',
                'show_filter' => true,
            ])
            ->add('count', null, [
                'label' => 'счетчик',
            ]);
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('id', null, [
                'header_style' => 'width: 5%',
                'row_align' => 'left'
            ])
            ->add('count', null, [
                'label' => 'счетчик',
                'header_style' => 'width: 5%',
                'row_align' => 'left',
                'editable' => true
            ])
            ->add('_action', null, [
                'actions' => [
//                    'show' => [],
                    'edit' => [],
                    'delete' => [],
                ]]);;
    }

    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('count');
    }

    public function toString($object)
    {
        return $object instanceof JosContent
            ? $object->getC()
            : 'счетчик'; // shown in the breadcrumb on the create view
    }

}