<?php

namespace App\Admin;

use App\Entity\City;
use App\Entity\JosContent;
use App\Entity\Product;
use App\Entity\Company;
use App\Entity\ProductRubric;
use App\Entity\Region;
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

class JosContentAdmin extends AbstractAdmin
{
    protected $security;
    public function __construct(Security $security)
    {
        $this->security = $security;
    }

//    public function parse(string $source)
//    {
//        if (stripos($source, 'bacon') !== false) {
//            $this->logger->info('They are talking about bacon again!', [
//                'user' => $this->security->getUser()
//            ]);
//        }
//    }

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

        $username = $this->security->getUser()->getUsername();
        $formMapper
            ->tab('Основные данные')
//            ->with('Id', ['class' => 'col-md-2'])
//            ->add('id', NumberType::class)
//            ->end()
            ->with('Номер организации', ['class' => 'col-md-4'])
            ->add('title', TextType::class, [
                'label' => 'id организации',
            ])
            ->add('state', ChoiceType::class, [
                'label' => 'Опубликовано',
//                'multiple' => true,
                'expanded' => true,
//                'required' => false,
                'choices'  => [
                    'Да' => true,
                    'Нет' => false,]
            ])
            ->end()
//            ->with('Адрес', ['class' => 'col-md-3'])
//            ->add('introtext', TextType::class, ['required' => false])
//            ->end()
//            ->with('Область', ['class' => 'col-md-3'])
//            ->add('region', EntityType::class, [
//                'class' => Region::class,
//                'choice_label' => 'regionName',
//            ])
//            ->end()
//            ->with('Город', ['class' => 'col-md-3'])
//            ->add('city', EntityType::class, [
//                'class' => City::class,
//                'choice_label' => 'cityName',
//            ])
//            ->end()
//            ->with('Логотип', ['class' => 'col-md-3'])
//            ->add('logo', ChoiceType::class, [
//                'choices'  => [
//                    'Yes' => true,
//                    'No' => false,]
//            ])
//            ->end()
            ->with('Раздел', ['class' => 'col-md-4'])
            ->add('sectionid', NumberType::class, [
                'required' => false,
                'label' => 'Рубрика'
                ])
            ->add('catid', NumberType::class, [
                'required' => false,
                'label' => 'Категория'
                ])
            ->end();
        if ($this->getRoot()->getSubject()->getCreated() == null) {
            $formMapper
                ->with('Дата', ['class' => 'col-md-4'])
                ->add('created', DateTimeType::class, [
                    'required' => false,
                    'label' => 'создания',
                    'widget' => 'single_text',
                    'format' => 'dd-MM-yyyy hh:mm:ss',
                    'data' => new \DateTime()
                ])
                ->end();
        } else
            $formMapper
                ->with('Дата', ['class' => 'col-md-4'])
                ->add('created', DateTimeType::class, [
                    'required' => false,
                    'label' => 'создания',
                    'widget' => 'single_text',
                    'format' => 'dd-MM-yyyy hh:mm:ss',
                    'disabled' => true,
//                    'data' => new \DateTime()
                ])
                ->add('createdId', ChoiceType::class, [
                    'data' => 222,
                    'choices' =>[  $username => 333, ],
                    'expanded' => true,
                    'mapped' => false,
                    'required' => true,
                    'label' => 'user',
                ])
                ->add('modifiedId', NumberType::class)
                ->add('modified', DateTimeType::class, [
                    'label' => 'изменения',
                    'widget' => 'single_text',
                    'format' => 'dd-MM-yyyy hh:mm:ss',
                    'data' => new \DateTime(),
                    'required' => false
                ])
                ->end();
        $formMapper
//            ->with('admin', ['class' => 'col-md-4'])
//            ->add('adminCreated', null, [
//                'data' => ''
//            ])
//            ->end()
            ->end()
            ->tab('О компании')
//            ->add('shot_description', TextareaType::class, ['required' => false])
            ->add('introtext', TextareaType::class, [
                'required' => false,
                'attr' => [
                    'class' => 'mytextarea',
                ]
            ])
            ->end()
            ->end()
//            ->tab('Категория')
//            ->add('categoryProduct', ModelType::class, [
//                'class' => ProductRubric::class,
//                'property' => 'title',
//            ])
//            ->end()
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
//            ->add('id')
            ->add('title', null, [
                'label' => 'id организации',
                'show_filter' => true,
                'type' => 3,
//                'operator_type' => 'sonata_type_boolean',
//                'advanced_filter' => false
            ]);
//            ->add('categoryProduct', null, ['show_filter' => true], EntityType::class, [
//                'class'    => ProductRubric::class,
//                'choice_label' => 'title',
//            ]);
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('id')
            ->addIdentifier('title', null, [
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
            ->add('title');
    }

    public function toString($object)
    {
        return $object instanceof JosContent
            ? $object->getTitle()
            : 'Компания'; // shown in the breadcrumb on the create view
    }

    protected function configureSideMenu(MenuItemInterface $menu, $action, AdminInterface $childAdmin = null)
    {
        if (!$childAdmin && !in_array($action, ['edit', 'show'])) {
            return;
        }

        $admin = $this->isChild() ? $this->getParent() : $this;
        $id = $admin->getRequest()->get('id');

//        $menu->addChild('View BlogPost', [
//        'uri' => $admin->generateUrl('show', ['id' => $id])
//    ]);
if ($this->getRoot()->getSubject()->getCatid() == 53) {
        if ($this->isGranted('EDIT')) {
            $menu->addChild('Редактирование контента', [
                'uri' => $admin->generateUrl('edit', ['id' => $id])
            ]);
        }

    if ($this->isGranted('LIST')) {
        $menu->addChild('список ключей', [
            'uri' => $admin->generateUrl('admin.description.key.list', ['id' => $id])
        ]);
    }

    if ($this->isGranted('create')) {
        $menu->addChild('добавить ключ', [
            'uri' => $admin->generateUrl('admin.description.key.create', ['id' => $id])
        ]);
    }
}
    }
}