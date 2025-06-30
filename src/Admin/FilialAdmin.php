<?php

namespace App\Admin;

use App\Entity\FilialAdmin as Sale;
use App\Entity\JosAdminClients;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Route\RouteCollection;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Sonata\AdminBundle\Form\Type\ModelListType;

class FilialAdmin extends AbstractAdmin
{

    protected $datagridValues = [
        '_sort_order' => 'DESC',
    ];

    protected function configureFormFields(FormMapper $formMapper)
    {
        $admin = $this->isChild() ? $this->getParent() : $this;
        $idParent = $admin->getRequest()->get('id');
        $josAdminClients = $this-> getConfigurationPool () -> getContainer () -> get ('doctrine') -> getRepository (JosAdminClients::class);
        $company = $josAdminClients->findOneBy(['idInc' => $idParent]);

        $formMapper
            ->add('client', HiddenType::class, [
                'data' => $company->getIdCompany(),
            ])
            ->add('filial_id', ModelListType::class, [
                'label' => 'Филиал',
                'class' => JosAdminClients::class,
                'required'  => true,
                'btn_add' => 'Create New',
                'btn_list' => "Selecting from List",
                'btn_edit' => 'Edit Details',
                'btn_delete' => false
            ])
            ->end()
        ;
    }

    public function prePersist($newsletteradmin) {

    }

    public function preUpdate($newsletteradmin) {

    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
    }


    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('id', null, [
                'label' => 'ID',
                'row_align' => 'left',
                'editable' => false
            ])

            ->add('filial_id', EntityType::class, [
                'label' => 'Компания',
                'class' => JosAdminClients::class,
                'associated_property' => 'name',
            ])
            ->add('_action', null, [
                'label' => 'Действия',
                'actions' => [
                    'edit' => [],
                    'delete' => [],
                ]
            ]);
    }

    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('count');
    }

    public function toString($object)
    {
        return $object instanceof Sale
            ? 'Филиал. '.$object->getId()
            : 'Филиал.'; // shown in the breadcrumb on the create view
    }

      protected function configureRoutes(RouteCollection $collection)
    {
        if ($this->isChild()) {
            return;
        }

        // This is the route configuration as a parent
        $collection->clear();
    }
}