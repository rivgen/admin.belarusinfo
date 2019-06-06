<?php

namespace App\Admin;

use App\Entity\JosClientsKeywords;
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

class CopirClientsAdmin extends AbstractAdmin
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
            ->add('keywords', null, [
                'label' => 'Ключевые слова',
                'attr' => ['style' => 'height: 200px']
            ])
            ->add('keyss', CollectionType::class, [
                'by_reference' => false,
                'required' => false,
                'type_options' => [
                    'delete' => false,
                ],
                'btn_add' => 'Edit',
//                'allow_add' => true,
            ], [
                'edit' => 'inline',
                'inline' => 'table',
                'sortable' => 'position',
//                'limit' => 1,
                'allow_add' => true,

            ]);
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
            ->add('id', null, [
                'header_style' => 'width: 5%',
                'row_align' => 'left'
            ])
            ->addIdentifier('name', null, [
                'label' => 'Организация',
                'header_style' => 'width: 50%',
                'row_align' => 'left'
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
        return $object instanceof JosClientsKeywords
            ? $object->getName()
            : 'Организация'; // shown in the breadcrumb on the create view
    }

    protected function configureSideMenu(MenuItemInterface $menu, $action, AdminInterface $childAdmin = null)
    {
        if (!$childAdmin && !in_array($action, ['edit', 'show'])) {
            return;
        }

        $admin = $this->isChild() ? $this->getParent() : $this;
        $id = $admin->getRequest()->get('id');

//        $menu->addChild('View Playlist', [
//            'uri' => $admin->generateUrl('show', ['id' => $id])
//        ]);
        if ($this->isGranted('LIST')) {
            $menu->addChild('Все компании', [
                'uri' => $admin->generateUrl('list')
            ]);
        }

        if ($this->isGranted('EDIT')) {
            $menu->addChild('Ключевые слова (' . $id . ')', [
                'uri' => $admin->generateUrl('edit', ['id' => $id])
            ]);
        }

        if ($this->isGranted('LIST')) {
            $menu->addChild('О компании (' . $id . ')', [
                'uri' => $admin->generateUrl('admin.jos.content.list', ['id' => $id])
            ]);
        }

        if ($this->isGranted('LIST')) {
            $menu->addChild('Текст / ключевики ('.$id.')', [
                'uri' => $admin->generateUrl('admin.description.key.list', ['id' => $id])
            ]);
        }
    }

    public function configureExportFields(AdminInterface $admin, array $fields)
    {
        unset($fields['updatedAt']);

        return $fields;
    }
}