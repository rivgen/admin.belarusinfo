<?php

namespace App\Admin;

use App\Entity\Link;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Admin\AdminInterface;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Form\Type\ChoiceFieldMaskType;
use Sonata\AdminBundle\Route\RouteCollection;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;

class LinkClientsAdmin extends AbstractAdmin
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

        $id = $this->getRoot()->getSubject()->getId();
        $count = $this->getRoot()->getSubject()->getCount();
        $updateData = date_format($this->getRoot()->getSubject()->getUpdateData(), 'Y-m-d H:m');
        $updateData2 = date_format($this->getRoot()->getSubject()->getUpdateDataTwo(), 'Y-m-d H:m');
        $countTwo = $this->getRoot()->getSubject()->getCountTwo();
        $role = $this->getConfigurationPool()->getContainer()->get('security.token_storage')->getToken()->getUser()->getRoles()[0];
//        dump($role);
        $formMapper
            ->with('Клиент', ['class' => 'col-md-12'])
            ->add('id', null, [
                'label' => 'Id клиента ',
                'disabled' => true,
                'help' => '<a href="https://www.belarusinfo.by/ru/poisk/' . $id . '.html" target="_blank"> www.belarusinfo.by/ru/poisk/' . $id . '.html </a>'
            ])
            ->end();
        if ($role == 'ROLE_SUPER_ADMIN' or $role == 'ROLE_LINK') {
            $formMapper
                ->with('№1', ['class' => 'col-md-6']);
        }
        if ($role == 'ROLE_LINK_1' or $role == 'ROLE_SUPER_ADMIN' or $role == 'ROLE_LINK') {
            $formMapper
                ->add('count', null, [
                    'label' => 'счетчик - ' . $count,
//                'disabled' => true,
                    'data' => $count + 1,
                    'attr' => ['style' => 'display: none']
                ])
                ->add('updateData', DateTimeType::class, [
                    'required' => false,
                    'label' => 'последние изменения -' . $updateData,
                    'widget' => 'single_text',
                    'format' => 'dd-MM-yyyy HH:mm:ss',
                    'data' => new \DateTime(),
                    'attr' => ['style' => 'display: none']
                ]);
        }
        if ($role == 'ROLE_SUPER_ADMIN' or $role == 'ROLE_LINK') {
            $formMapper
                ->end()
                ->with('№2', ['class' => 'col-md-6']);
        }
        if ($role == 'ROLE_LINK_2' or $role == 'ROLE_SUPER_ADMIN' or $role == 'ROLE_LINK') {
            $formMapper
                ->add('countTwo', null, [
                    'label' => 'счетчик - ' . $countTwo,
//                'disabled' => true,
                    'data' => $countTwo + 1,
                    'attr' => ['style' => 'display: none']
                ])
                ->add('updateDataTwo', DateTimeType::class, [
                    'required' => false,
                    'label' => 'последние изменения -' . $updateData2,
                    'widget' => 'single_text',
                    'format' => 'dd-MM-yyyy HH:mm:ss',
                    'data' => new \DateTime(),
                    'attr' => ['style' => 'display: none']
                ]);
        }
        if ($role == 'ROLE_SUPER_ADMIN' or $role == 'ROLE_LINK') {
            $formMapper
                ->end();
        };
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
//            ->add('id')
            ->add('id', null, [
                'label' => 'Клиент',
                'show_filter' => true,
            ]);
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        // удаляет ссылку на выбор плитки
        unset($this->listModes['mosaic']);
        $role = $this->getConfigurationPool()->getContainer()->get('security.token_storage')->getToken()->getUser()->getRoles()[0];
        $listMapper
            ->addIdentifier('id');
        if ($role == 'ROLE_LINK_1' or $role == 'ROLE_SUPER_ADMIN' or $role == 'ROLE_LINK') {
            $listMapper
                ->add('count', null, [
                    'label' => 'счетчик'
                ])
                ->add('updateData', null, [
                    'label' => 'изменения'
                ]);
        };
        if ($role == 'ROLE_LINK_2' or $role == 'ROLE_SUPER_ADMIN' or $role == 'ROLE_LINK') {
            $listMapper
                ->add('countTwo', null, [
                    'label' => 'счетчик'
                ])
                ->add('updateDataTwo', null, [
                    'label' => 'изменения'
                ]);
        };
        $listMapper
            ->add('_action', null, [
                'label' => 'Действия',
                'actions' => [
//                    'show' => [],
                    'edit' => [],
//                    'delete' => [],
                ]]);
    }

// удаляет ссылку на создание "create"
    protected function configureRoutes(RouteCollection $collection)
    {
        $collection->remove('create');
        $collection->remove('export');
        $collection->remove('delete');
    }

    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('id');
    }

    public function toString($object)
    {
        return $object instanceof Link
            ? 'Id клиента ' . $object->getId()
            : 'Id клиента'; // shown in the breadcrumb on the create view
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
////        $menu->addChild('View Playlist', [
////            'uri' => $admin->generateUrl('show', ['id' => $id])
////        ]);
//        if ($this->isGranted('LIST')) {
//            $menu->addChild('Все компании', [
//                'uri' => $admin->generateUrl('list')
//            ]);
//        }
//
//        if ($this->isGranted('EDIT')) {
//            $menu->addChild('Ключевые слова (' . $id . ')', [
//                'uri' => $admin->generateUrl('edit', ['id' => $id])
//            ]);
//        }
//
//        if ($this->isGranted('LIST')) {
//            $menu->addChild('О компании (' . $id . ')', [
//                'uri' => $admin->generateUrl('admin.jos.content.list', ['id' => $id])
//            ]);
//        }
//
//        if ($this->isGranted('LIST')) {
//            $menu->addChild('Текст / ключевики ('.$id.')', [
//                'uri' => $admin->generateUrl('admin.description.key.list', ['id' => $id])
//            ]);
//        }
//    }

    public function configureExportFields(AdminInterface $admin, array $fields)
    {
        unset($fields['updatedAt']);

        return $fields;
    }
}