<?php

namespace App\Admin;

use App\Entity\JosContent;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Admin\AdminInterface;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Route\RouteCollection;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
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

        $userId = $this->getConfigurationPool()->getContainer()->get('security.token_storage')->getToken()->getUser()->getId();
        $admin = $this->isChild() ? $this->getParent() : $this;
        $idParent = $admin->getRequest()->get('id');
        $content = $this->getRoot()->getSubject();
        $update = !empty ($this -> getRoot() -> getSubject() -> getModified())?date_format($this -> getRoot() -> getSubject() -> getModified(), 'Y-m-d H:m'):null;
        if ($update == '1991-01-01 00:00' or $update == null){
            $updateData = 'не было изменений';
        }else
            $updateData = $update;

//        $username = $this->getUser();
//          dump($update);
        $formMapper
            ->with('Номер организации ' . $idParent, ['class' => 'col-md-4'])
            ->add('title', HiddenType::class, [
                'label' => 'id организации',
                'data' => $idParent,
            ])
            ->add('alias', HiddenType::class, [
                'label' => 'alias',
                'data' => 'alias-' . $idParent,
            ])
            ->add('state', ChoiceType::class, [
                'label' => 'Опубликовано',
//                'multiple' => true,
                'data' => true,
                'expanded' => true,
//                'required' => false,
                'choices' => [
                    'Да' => true,
                    'Нет' => false,]
            ])
            ->end()
            ->with('Раздел', ['class' => 'col-md-4'])
            ->add('sectionid', ChoiceType::class, [
//                'required' => false,
                'attr' => ['style' => 'width: 100%'],
                'choices' => [
                    'AV 24' => 14,
                ],
                'label' => 'Рубрика',
                'data' => 14
            ])
            ->add('catid', ChoiceType::class, [
//                'required' => false,
//                'editable' => true,
                'label' => 'Категория',
                'attr' => ['style' => 'width: 100%'],
                'choices' => [
                    'О компании' => 54,
                    'Продукция' => 53,
                    'Фотогалерея' => 55,
                    'Вакансии' => 58,
                ]
            ])
            ->end();
        if ($this->getRoot()->getSubject()->getCreated() == null) {
            $formMapper
                ->with('Дата', ['class' => 'col-md-4'])
                ->add('created', DateTimeType::class, [
                    'required' => false,
                    'label' => 'создания',
                    'widget' => 'single_text',
                    'format' => 'dd-MM-yyyy HH:mm:ss',
                    'data' => new \DateTime()
                ])
                ->add('publishUp', DateTimeType::class, [
//                    'required' => false,
                    'label' => 'публикации',
                    'widget' => 'single_text',
                    'format' => 'yyyy-MM-dd HH:mm:ss',
                    'data' => new \DateTime()
                ])
                ->add('createdBy', HiddenType::class, [
                    'data' => $userId,
//                    'choices' =>[  111 => 333, ],
//                    'expanded' => true,
//                    'mapped' => false,
//                    'required' => true,
                    'label' => 'user',
                ])
                ->end();
        } else
            $formMapper
                ->with('Дата', ['class' => 'col-md-4'])
                ->add('created', DateTimeType::class, [
                    'required' => false,
                    'label' => 'создания',
                    'widget' => 'single_text',
                    'format' => 'dd-MM-yyyy HH:mm:ss',
                    'disabled' => true,
//                    'data' => new \DateTime()
                ])
                ->add('modifiedBy', HiddenType::class, [
                    'data' => $userId,
                    'label' => 'user',
                ])
//                ->add('modifiedId', NumberType::class)
                ->add('modified', DateTimeType::class, [
                    'label' => 'изменения - '.$updateData,
                    'widget' => 'single_text',
                    'format' => 'dd-MM-yyyy HH:mm:ss',
                    'data' => new \DateTime(),
                    'required' => false
                ])
//                ->add('publishUp', DateTimeType::class, [
//                    'required' => false,
//                    'label' => 'публикации',
//                    'widget' => 'single_text',
//                    'format' => 'dd-MM-yyyy HH:mm:ss',
//                    'disabled' => true,
//                ])
                ->end();
        $formMapper
//            ->with('admin', ['class' => 'col-md-4'])
//            ->add('adminCreated', null, [
//                'data' => ''
//            ])
//            ->end()
//            ->end()
            ->with('О компании')
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

//        $em = $this-> getConfigurationPool () -> getContainer () -> get ('doctrine') -> getRepository (JosContent::class);
//        $login = $em->loginUser('6');
//        dump($login);
//        unset($this->listModes['mosaic']);
        $listMapper
            ->add('id')
            ->addIdentifier('title', null, [
                'label' => 'Id организации',
            ])
            ->add('catid', 'choice', [
//                'required' => false,
//                'editable' => true,
//                'class' => 'App\Entity\JosCategories',
                'label' => 'Категория',
//                'attr' => ['style' => 'width: 100%'],
                'choices' => [
                    54 => 'О компании',
                    53 => 'Продукция',
                    55 => 'Фотогалерея',
                    58 => 'Вакансии' ,
                ]
            ])
//            ->add('created')
//            ->add('createdBy')
//            ->add('companies.id')
            ->add('_action', null, [
                'label' => 'Действия',
                'actions' => [
//                    'show' => [],
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
            ? 'Компания ' . $object->getTitle()
            : 'Компания'; // shown in the breadcrumb on the create view
    }

//    protected function configureSideMenu(MenuItemInterface $menu, $action, AdminInterface $childAdmin = null)
//    {
//        if (!$childAdmin && !in_array($action, ['edit', 'show'])) {
//            return;
//        }
//
//        $admin = $this->isChild() ? $this->getParent() : $this;
//        $id = $admin->getRequest()->get('id');
//
////        $menu->addChild('View BlogPost', [
////        'uri' => $admin->generateUrl('show', ['id' => $id])
////    ]);
//        if ($this->getRoot()->getSubject()->getCatid() == 53) {
//            if ($this->isGranted('EDIT')) {
//                $menu->addChild('Редактирование контента', [
//                    'uri' => $admin->generateUrl('edit', ['id' => $id])
//                ]);
//            }
//
//            if ($this->isGranted('LIST')) {
//                $menu->addChild('список ключей', [
//                    'uri' => $admin->generateUrl('admin.description.key.list', ['id' => $id])
//                ]);
//            }
//
//            if ($this->isGranted('create')) {
//                $menu->addChild('добавить ключ', [
//                    'uri' => $admin->generateUrl('admin.description.key.create', ['id' => $id])
//                ]);
//            }
//        }
//    }

    protected function configureRoutes(RouteCollection $collection)
    {
        if ($this->isChild()) {
            return;
        }

        // This is the route configuration as a parent
        $collection->clear();

    }
}