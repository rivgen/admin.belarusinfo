<?php

namespace App\Admin;

use App\Entity\BannersKey;
use App\Entity\JosBanners;
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

class BannersKeyAdmin extends AbstractAdmin
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
            ->add('tag', TextType::class)
//            ->add('josBanners', EntityType::class, [
////                'label' => 'Клиент',
//                'class' => JosBanners::class,
//                'choice_label' => 'id',
////                'data' => '301'
//            ])
            ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('id')
        ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
//            ->addIdentifier('id')
            ->addIdentifier('tag')
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
            ->add('rubricId');
    }

    public function toString($object)
    {
        return $object instanceof BannersKey
            ? 'Ключи '.$object->getId()
            : 'Ключи'; // shown in the breadcrumb on the create view
    }

}