<?php

namespace App\Admin;

use App\Entity\JosContent;
use App\Entity\Tel;
use App\Entity\FilialAdmin as Sale;
use App\Entity\JosAdminClients;
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

class FilialAdmin extends AbstractAdmin
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

        // get the current Image instance


//        $username = $this->security->getUser()->getUsername();



        $formMapper

//            ->add('filial', EntityType::class, [
//                'label' => 'Компании',
////                'required' => false,
//                'class' => JosAdminClients::class,
//                // 'data' => 0,
//                'choice_label' => 'name',
//                'query_builder' => function (EntityRepository $repo) {
//                    return $repo->createQueryBuilder('r')->orderBy('r.name');
//                }
////                'class' => JosRubrisc::class,
////                'choice_label' => 'name',
////                'query_builder' => function (EntityRepository $repo) {
////                    return $repo->createQueryBuilder('r')->andWhere('r.level = 2')->andWhere('r.published = 1')->orderBy('r.name');
////                }
//            ])
//            ->add('filial', 'sonata_type_model_list')

            ->add('filial_id', ModelListType::class, [
                'label' => 'Филиал',
                'class' => JosAdminClients::class,
                'required'  => true,
                'btn_add' => 'Create New',
                'btn_list' => "Selecting from List",
                'btn_edit' => 'Edit Details',
//                'choice_label' => 'id',
                'btn_delete' => false
            ])


//            ->add('content', TextareaType::class, [
//                'label' => 'Content',
//                'required' => false,
//            ])

//            ->add('file', FileType::class, [
////                'required' => false
////            ])

            ->end()
        ;
    }

    public function prePersist($newsletteradmin) {

    }
//
    public function preUpdate($newsletteradmin) {

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
            ->add('id', null, [
                'label' => 'ID',
                'row_align' => 'left',
                'editable' => false
            ])

            ->add('filial_id', EntityType::class, [
                'label' => 'Компания',
                'class' => JosAdminClients::class,
                'associated_property' => 'name',
//                'disabled' => true,
            ])
            ->add('_action', null, [
                'label' => 'Действия',
                'actions' => [
//                    'show' => [],
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

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Sale::class,
        ]);
    }


      protected function configureRoutes(RouteCollection $collection)
    {
       // $collection->remove('create');
        //$collection->remove('export');
        //$collection->remove('delete');

        if ($this->isChild()) {
            return;
        }

        // This is the route configuration as a parent
        $collection->clear();
    }

   

}