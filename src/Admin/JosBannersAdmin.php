<?php

namespace App\Admin;

use App\Entity\JosBanners;
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

class JosBannersAdmin extends AbstractAdmin
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
            ->add('rubricId', null, [
                'label' => 'рубрика',
            ])
            ->add('clientId', null, [
                'label' => 'Клиент',
            ])
            ->add('img', null, [
                'label' => 'Изображение',
            ])
            ->add('title', null, [
                'label' => 'title',
            ])
            ->add('url', null, [
                'label' => 'url',
            ]);
        if ($this->getRoot()->getSubject()->getDateEnd() == null) {
            $formMapper
                ->add('dateEnd', DateTimeType::class, [
                    'label' => 'дата создания',
                    'format' => 'dd-MM-yyyy HH:mm:ss',
                    'widget' => 'single_text',
                    'data' => new \DateTime()
                ]);
        } else
            $formMapper
                ->add('dateEnd', DateTimeType::class, [
//                    'required' => false,
                    'label' => 'дата создания',
                    'format' => 'dd-MM-yyyy HH:mm:ss',
                    'widget' => 'single_text',
                    'disabled' => true,
                ]);
        $formMapper
            ->add('ordering', null, [
                'label' => 'порядок сортировки',
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
            ->add('rubricId', null, [
                'label' => 'рубрика',
                'show_filter' => true,
            ])
            ->add('clientId', null, [
                'label' => 'клиент',
            ])
            ->add('title', null, [
                'label' => 'title',
            ])
            ->add('ordering', null, [
                'label' => 'порядок сортировки',
            ]);
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('id', null, [
                'header_style' => 'width: 5%',
                'row_align' => 'left'
            ])
            ->add('rubricId', null, [
                'label' => 'рубрика',
                'header_style' => 'width: 5%',
                'row_align' => 'left'
            ])
            ->add('ordering', null, [
                'label' => 'порядок сортировки',
                'editable' => true
            ])
            ->add('clientId', null, [
                'label' => 'клиент',
            ])
            ->add('title', null, [
                'label' => 'title',
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
            ->add('rubricId');
    }

    public function toString($object)
    {
        return $object instanceof JosBanners
            ? 'баннер '.$object->getId()
            : 'баннер'; // shown in the breadcrumb on the create view
    }

}