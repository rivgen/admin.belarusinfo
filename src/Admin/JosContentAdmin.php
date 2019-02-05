<?php

namespace App\Admin;

use App\Entity\City;
use App\Entity\JosContent;
use App\Entity\Product;
use App\Entity\Company;
use App\Entity\ProductRubric;
use App\Entity\Region;
use Sonata\AdminBundle\Admin\AbstractAdmin;
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
        $formMapper
            ->tab('Основные данные')
//            ->with('Id', ['class' => 'col-md-2'])
//            ->add('id', NumberType::class)
//            ->end()
            ->with('Номер организации', ['class' => 'col-md-4'])
            ->add('title', TextType::class)
            ->end()
//            ->with('Адрес', ['class' => 'col-md-3'])
//            ->add('introtext', TextType::class, ['required' => false])
//            ->end()
//            ->with('Область', ['class' => 'col-md-3'])
//            ->add('region', EntityType::class, [
//                'class' => Region::class,
//                'choice_label' => 'regionName',
//            ])
//            ->end()
//            ->with('Город', ['class' => 'col-md-3'])
//            ->add('city', EntityType::class, [
//                'class' => City::class,
//                'choice_label' => 'cityName',
//            ])
//            ->end()
//            ->with('Логотип', ['class' => 'col-md-3'])
//            ->add('logo', ChoiceType::class, [
//                'choices'  => [
//                    'Yes' => true,
//                    'No' => false,]
//            ])
//            ->end()
            ->with('Раздел', ['class' => 'col-md-4'])
            ->add('sectionid', NumberType::class, [
                'required' => false,
                'label' => 'Рубрика'
                ])
            ->add('catid', NumberType::class, [
                'required' => false,
                'label' => 'Категория'
                ])
            ->end();
        if ($this->getRoot()->getSubject()->getCreated() == null) {
            $formMapper
                ->with('Дата', ['class' => 'col-md-4'])
                ->add('created', DateTimeType::class, [
                    'required' => false,
                    'label' => 'создания',
                    'widget' => 'single_text',
                    'format' => 'dd-MM-yyyy hh:mm:ss',
                    'data' => new \DateTime()
                ])
                ->end();
        } else
            $formMapper
                ->with('Дата', ['class' => 'col-md-4'])
                ->add('created', DateTimeType::class, [
                    'required' => false,
                    'label' => 'создания',
                    'widget' => 'single_text',
                    'format' => 'dd-MM-yyyy hh:mm:ss',
                    'disabled' => true,
//                    'data' => new \DateTime()
                ])
                ->add('modified', DateTimeType::class, [
                    'label' => 'изменения',
                    'widget' => 'single_text',
                    'format' => 'dd-MM-yyyy hh:mm:ss',
                    'data' => new \DateTime(),
                    'required' => false
                ])
                ->end();
        $formMapper
            ->end()
            ->tab('О компании')
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
            ->add('title', null, ['show_filter' => true]);
//            ->add('categoryProduct', null, ['show_filter' => true], EntityType::class, [
//                'class'    => ProductRubric::class,
//                'choice_label' => 'title',
//            ]);
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
//            ->add('id')
            ->addIdentifier('title')
//            ->add('companies.id')
            ->add('_action', null, [
                'actions' => [
                    'show' => [],
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
            ? $object->getTitle()
            : 'Компания'; // shown in the breadcrumb on the create view
    }
}