<?php

namespace App\Admin;

use App\Entity\JosClientFields;
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

class JosClientFieldsAdmin extends AbstractAdmin
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
            ->add('client', NumberType::class, [
                'label' => 'Клиент',
            ])
            ->add('fb', null, [
                'label' => 'Facebook',
                'required' => false
            ])
            ->add('instagram', null, [
                'label' => 'Instagram',
                'required' => false
            ])
            ->add('ok', null, [
                'label' => 'Одноклассники',
                'required' => false
            ])
            ->add('vk', null, [
                'label' => 'В контакте',
                'required' => false
            ])
            ->add('tripadvisor', null, [
                'label' => 'Tripadvisor',
                'required' => false
            ])
            ->add('youtube', null, [
                'label' => 'Youtube',
                'required' => false
            ])
            ->add('gps', null, [
                'label' => 'GPS координаты',
                'required' => false
            ])
            ->add('action', null, [
                'label' => 'Акции и скидки',
                'required' => false
            ])
            ->add('news', null, [
                'label' => 'Новости',
                'required' => false
            ]);
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
//            ->add('id')
            ->add('client', null, [
                'label' => 'Клиент',
                'show_filter' => true,
            ]);
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('client', null, [
                'label' => 'Клиент',
                'header_style' => 'width: 5%',
                'row_align' => 'left'
            ])
//            ->add('fb', TextType::class, [
//                'label' => 'Facebook',
//                'header_style' => 'width: 25%',
////                'header_class' => 'fbAdmin',
//                'collapse' => [
//                    // height in px
//                    'height' => 1,
//
//                    // content of the "read more" link
//                    'more' => 'I want to see the full description',
//
//                    // content of the "read less" link
//                    'less' => 'This text is too long, reduce the size',
//                ],
////                'label_icon' => 'fa fa-thumbs-o-up',
//            ])
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
            ->add('fb', null, [
                'label' => 'Facebook',
                'required' => false
            ])
            ->add('instagram', null, [
                'label' => 'Instagram',
                'required' => false
            ])
            ->add('ok', null, [
                'label' => 'Одноклассники',
                'required' => false
            ])
            ->add('vk', null, [
                'label' => 'В контакте',
                'required' => false
            ])
            ->add('tripadvisor', null, [
                'label' => 'Tripadvisor',
                'required' => false
            ])
            ->add('youtube', null, [
                'label' => 'Youtube',
                'required' => false
            ])
            ->add('gps', null, [
                'label' => 'GPS координаты',
                'required' => false
            ])
            ->add('action', null, [
                'label' => 'Акции и скидки',
                'required' => false
            ])
            ->add('news', null, [
                'label' => 'Новости',
                'required' => false
            ]);
    }

    public function toString($object)
    {
        return $object instanceof JosClientFields
            ? 'клиент ' . $object->getClient()
            : 'номер клиента'; // shown in the breadcrumb on the create view
    }

}