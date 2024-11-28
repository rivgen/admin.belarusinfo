<?php

namespace App\Admin;

use App\Entity\JosAdminClients;
use App\Entity\JosContent;
use App\Entity\Tel;
use App\Entity\VacancyAdmin as Vacancy;
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
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Knp\Menu\ItemInterface as MenuItemInterface;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\OptionsResolver as OptionsResolver;
use Symfony\Component\Validator\Constraints\File;
use Sonata\AdminBundle\Form\Type\ModelListType;

class VacancyAdmin extends AbstractAdmin
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
            ->add('meta_title', TextType::class, [
                'label' => 'Meta Title',
                'required' => false,
            ])
            ->add('meta_desc', TextareaType::class, [
                'label' => 'Meta Description',
                'required' => false,
            ])
            ->add('file', FileType::class, $fileFormOptions)
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
        ;
    }

    public function prePersist($model) {
        $model->upload();
    }
//
    public function preUpdate($model) {
        $model->upload();
    }
//

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('published', null, [
                'label' => 'Опубликовано',
                'show_filter' => true,
            ])
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
                'label' => 'Published',
                'row_align' => 'left',
                'editable' => true
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
        return $object instanceof Vacancy
            ? 'Вакансии. '.$object->getTitle()
            : 'Вакансии.'; // shown in the breadcrumb on the create view
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Vacancy::class,
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