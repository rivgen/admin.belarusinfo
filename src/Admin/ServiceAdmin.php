<?php

namespace App\Admin;

use App\Entity\JosAdminClients;
use App\Entity\JosContent;
use App\Entity\Tel;
use App\Entity\SaleAdmin as Sale;
use App\Entity\CategoryserviceAdmin;
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

class ServiceAdmin extends AbstractAdmin
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
        $image = $this->getSubject();

        // use $fileFormOptions so we can add other options to the field
        $fileFormOptions = ['required' => false];
        if ($image && ($webPath = $image->getWebPath())) {
            //var_dump($image->getImage());
            //$realPath = preg_replace('|public/uploads/news/uploads/news|' ,'public/uploads/news', $webPath);
            // get the container so the full path to the image can be set
            $container = $this->getConfigurationPool()->getContainer();
            $fullPath = $container->get('request_stack')->getCurrentRequest()->getBasePath().'/'.$webPath;
//            var_dump($container);
//            var_dump($fullPath);
            // var_dump($realPath);
            // add a 'help' option containing the preview's img tag
            $fileFormOptions['help'] = '<img src="/belarusinfo.by/ms_assets/'.$image->getImage().'" class="admin-preview" style="max-height: 150px;padding-top: 15px;"  />';
            //$fileFormOptions['help_html'] = true;
        }

//        $username = $this->security->getUser()->getUsername();
        $admin = $this->isChild() ? $this->getParent() : $this;
          $idParent = $admin->getRequest()->get('id');
          $josAdminClients = $this-> getConfigurationPool () -> getContainer () -> get ('doctrine') -> getRepository (JosAdminClients::class);
          $company = $josAdminClients->findOneBy(['idInc' => $idParent]);

        $formMapper
            ->add('client', HiddenType::class, [
                'data' => $company->getIdCompany(),
            ])
            ->add('published', ChoiceType::class, [
                'label' => 'Опубликовано',
                'attr' => ['style' => 'col-md-6'],
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
                'label' => 'Заголовок',
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Описание',
                'required' => false,
            ])

            ->add('category_id', EntityType::class, [
                'label' => 'Категория',
//                'required' => false,
                'class' => CategoryserviceAdmin::class,
                // 'data' => 0,
                'choice_label' => 'name',
                'query_builder' => function (EntityRepository $repo) {
                    return $repo->createQueryBuilder('r')->andWhere('r.published = 1')->orderBy('r.id');
                }
//                'class' => JosRubrisc::class,
//                'choice_label' => 'name',
//                'query_builder' => function (EntityRepository $repo) {
//                    return $repo->createQueryBuilder('r')->andWhere('r.level = 2')->andWhere('r.published = 1')->orderBy('r.name');
//                }
            ])

            ->add('meta_title', TextType::class, [
                'label' => 'Meta Title',
                'required' => false,
            ])
            ->add('meta_desc', TextareaType::class, [
                'label' => 'Meta Description',
                'required' => false,
            ])

//            ->add('content', TextareaType::class, [
//                'label' => 'Content',
//                'required' => false,
//            ])

//            ->add('file', FileType::class, [
////                'required' => false
////            ])

            ->add('file', FileType::class, $fileFormOptions)


            ->add('price', TextType::class, [
                'label' => 'Цена',
                'required' => false,
            ])

            ->add('link', TextType::class, [
                'label' => 'Ссылка',
                'required' => false,
            ])

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

    public function prePersist($newsletteradmin) {

//          var_dump( $this->saveFile($newsletteradmin));
//          exit();
//
//        $this->saveFile($newsletteradmin);
        $newsletteradmin->upload();
    }
//
    public function preUpdate($newsletteradmin) {

        $newsletteradmin->upload();

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
            ->add('category_id', EntityType::class, [
                'label' => 'Категория',
                'class' => CategoryserviceAdmin::class,
                'associated_property' => 'name',
//                'disabled' => true,
            ])
            ->add('price', TextType::class, [
                'label' => 'Цена',
                'required' => false,
            ])
            ->add('published', null, [
                'label' => 'Опубликовано',
                'row_align' => 'left',
                'editable' => true
            ])
//            ->add('ordering', null, [
//                'label' => 'Ordering',
//                'row_align' => 'left',
//                'editable' => true
//            ])
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
            ? 'Новость. '.$object->getTitle()
            : 'Новость.'; // shown in the breadcrumb on the create view
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