<?php

namespace App\Admin;

use App\Entity\JosClients;
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
            ->add('name', null, [
                'label' => 'Название организации',
            ]);
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('id', null, [
                'header_style' => 'width: 5%',
                'row_align' => 'left'
            ])
            ->add('name', null, [
                'label' => 'Название организации',
                'header_style' => 'width: 5%',
                'row_align' => 'left'
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
            ->add('name');
    }

    public function toString($object)
    {
        return $object instanceof JosClients
            ? $object->getName()
            : 'счетчик'; // shown in the breadcrumb on the create view
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

//        if ($this->isGranted('EDIT')) {
//            $menu->addChild('Edit Playlist', [
//                'uri' => $admin->generateUrl('edit', ['id' => $id])
//            ]);
//        }

        if ($this->isGranted('LIST')) {
            $menu->addChild('О компании', [
                'uri' => $admin->generateUrl('admin.jos.content.list', ['id' => $id])
            ]);
        }
    }
}