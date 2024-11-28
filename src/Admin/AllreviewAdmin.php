<?php

namespace App\Admin;

use App\Entity\JosContent;
use App\Entity\Tel;
use App\Entity\AllreviewAdmin as Review;
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
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Knp\Menu\ItemInterface as MenuItemInterface;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\OptionsResolver as OptionsResolver;
use Symfony\Component\Validator\Constraints\File;
use Sonata\AdminBundle\Form\Type\ModelListType;

class AllreviewAdmin extends AbstractAdmin
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
            ->add('published', ChoiceType::class, [
                'label' => 'Опубликовано',
                'attr' => ['class' => 'c_inline_choice'],
//                'multiple' => true,
                'data' => true,
                'expanded' => true,
//                'required' => false,
                'choices' => [
                    'Да' => 1,
                    'Нет' => 0,
                ]
            ])
            ->add('showonindex', ChoiceType::class, [
                'label' => 'Показать на главной',
                // 'choice_attr' => ['class' => 'col-md-6'],
                'attr' => ['class' => 'c_inline_choice'],
                //  'attr' => ['class' => 'col-md-6'],
//                'multiple' => true,
                'data' => 0,
                // 'data' => true,
                'expanded' => true,
//                'required' => false,
                'choices' => [
                    'Да' => 1,
                    'Нет' => 0,
                ]
            ])
            ->add('title', TextType::class, [
                'label' => 'Title',
            ])

            ->add('date', TextType::class, [
                'required' => false,
                'label' => 'Дата создания',
                //'widget' => 'single_text',
                //'format' => 'dd-MM-yyyy',
                //'disabled' => true,
                'data' => date('d-m-Y')
            ])

            ->add('rating', ChoiceType::class, [
                'label' => 'Рейтинг',
                // 'choice_attr' => ['class' => 'col-md-6'],
                  'attr' => ['class' => 'c_inline_radio'],
//                'multiple' => true,
               // 'data' => 5,
                // 'data' => true,
                'expanded' => true,
//                'required' => false,
                'choices' => [
                    '1' => 1,
                    '2' => 2,
                    '3' => 3,
                    '4' => 4,
                    '5' => 5,
                ]
            ])


//            ->add('content', TextareaType::class, [
//                'label' => 'Content',
//                'required' => false,
//            ])

//            ->add('file', FileType::class, [
////                'required' => false
////            ])



            ->end()


            ->with('Content')
//            ->add('shot_description', TextareaType::class, ['required' => false])
            ->add('content', TextareaType::class, [
                'required' => false,
                'attr' => [
                    'class' => 'mytextarea',
                ]
            ])
            ->end()
//            ->add('ordering', NumberType::class, [
//                'label' => 'порядок сортировки',
//                'type' => 'number',
//            ])

//            ->add('ordering', NumberType::class, [
//                'label' => 'Ordering',
//                'required' => false,
//                'empty_data' => '0',
//            ])


//            ->add('image', FileType::class, array(
//                'required' => false,
//                'label' => 'image',
//                'mapped' => false,
//            ))


//            ->add('image', FileType::class, [
//                'label' => 'image',
//
//                // unmapped means that this field is not associated to any entity property
//                'mapped' => false,
//
//                // make it optional so you don't have to re-upload the PDF file
//                // every time you edit the Product details
//                'required' => false,
//
//                // unmapped fields can't define their validation using annotations
//                // in the associated entity, so you can use the PHP constraint classes
//                'constraints' => [
//                    new File([
//                        'maxSize' => '1024k',
//                       /*'mimeTypes' => [
//                            'application/pdf',
//                            'application/x-pdf',
//                        ],*/
//                        'mimeTypesMessage' => 'Please upload a valid image file',
//                    ])
//                ],
//            ])
            /* ->add('phone', TextType::class, [
                 'label' => 'Тел.',
             ])

             /*->add('ordering', null, [
                 'label' => 'сортировка',
             ])*/
        ;
    }

    public function prePersist($model) {

    }
//
    public function preUpdate($model) {

    }
//

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
//        $datagridMapper
//            ->add('client', EntityType::class, [
//                'class' => AdminClientsAdmin::class,
//                'associated_property' => 'name',
//                'show_filter' => true,
//            ])
//
//        ;

        $datagridMapper
            ->add('published')
//            ->add('client')
        ;
    }


    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('id', null, [
                'label' => 'ID',
                'row_align' => 'left',
                'editable' => false
            ])
            ->add('title', null, [
                'label' => 'Название',
                'row_align' => 'left',
                'editable' => true
            ])
            ->add('published', null, [
                'label' => 'Опубликовано',
                'row_align' => 'left',
                'editable' => true
            ])
            ->add('client', EntityType::class, [
                'label' => 'Клиент',
                'class' => AdminClientsAdmin::class,
                'associated_property' => 'name',
//                'disabled' => true,
            ])
//            ->add('ordering', null, [
//                'label' => 'Ordering',
//                'row_align' => 'left',
//                'editable' => true
//            ])
            ->add('_action', null, [
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
        return $object instanceof Review
            ? 'Отзыв. '.$object->getTitle()
            : 'Отзыв.'; // shown in the breadcrumb on the create view
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Review::class,
        ]);
    }


      protected function configureRoutes(RouteCollection $collection)
    {
        $collection->remove('create');
        //$collection->remove('export');
        //$collection->remove('delete');
//
//        if ($this->isChild()) {
//            return;
//        }

        // This is the route configuration as a parent
       // $collection->clear();
    }

   

}