<?php

namespace App\Admin;

use App\Entity\JosAdminClients;
use App\Entity\JosContent;
use App\Entity\Tel;
use App\Entity\ClientsettingAdmin as Sale;
use App\Entity\CategoryproductAdmin;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Admin\AdminInterface;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Route\RouteCollection;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Sonata\AdminBundle\Form\Type\ModelType;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Knp\Menu\ItemInterface as MenuItemInterface;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\OptionsResolver as OptionsResolver;
use Symfony\Component\Validator\Constraints\File;
use Sonata\AdminBundle\Form\Type\ModelListType;
use Doctrine\ORM\EntityRepository;

class ClientmetricAdmin extends AbstractAdmin
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

        $admin = $this->isChild() ? $this->getParent() : $this;
        $idParent = $admin->getRequest()->get('id');
        $josAdminClients = $this-> getConfigurationPool () -> getContainer () -> get ('doctrine') -> getRepository (JosAdminClients::class);
        $company = $josAdminClients->findOneBy(['idInc' => $idParent]);
        $formMapper
            ->add('client', HiddenType::class, [
                'data' => $company->getIdCompany(),
            ])
            ->add('msmetric', null, [
                'label' => 'Количество посещений',
            ])
            ->end()
        ;
    }

    public function prePersist($newsletteradmin) {

//          var_dump( $this->saveFile($newsletteradmin));
//          exit();
//
//        $this->saveFile($newsletteradmin);
//        $newsletteradmin->upload();
    }
//
    public function preUpdate($newsletteradmin) {

//        $newsletteradmin->upload();

//        var_dump($newsletteradmin->upload($newsletteradmin));
////        exit();
////
////        $this->saveFile($newsletteradmin);
    }
//
//    public function saveFile($product) {
//        $basepath = $this->getRequest()->getBasePath();
//        $product->upload($basepath);
//    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
//        $datagridMapper
//            ->add('id', null, [
//                'label' => 'Клиент',
//                'show_filter' => true,
//            ])
//        ;
    }


    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('client', null, [
                'label' => 'ID',
                'row_align' => 'left',
                'editable' => false
            ])
            ->add('msmetric', null, [
                'label' => 'кол. посещений',
            ])

            ->add('_action', null, [
                'label' => 'Действия',
                'actions' => [
//                    'show' => [],
                    'edit' => [],
                   // 'delete' => [],
                ]
            ]);
    }

    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('count');

//        var_dump($showMapper);
    }

    public function toString($object)
    {
        return $object instanceof Sale
            ? 'Дополнительно. '.$object->getId()
            : 'Дополнительно.'; // shown in the breadcrumb on the create view
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Sale::class,
        ]);
    }


      protected function configureRoutes(RouteCollection $collection)
    {
//var_dump($collection);

//            var_dump($this->getSubject());

//        $collection->remove('create');
        //$collection->remove('export');
//        $collection->remove('delete');

        if ($this->isChild()) {
            return;
        }

        // This is the route configuration as a parent
        $collection->clear();
    }

   

}