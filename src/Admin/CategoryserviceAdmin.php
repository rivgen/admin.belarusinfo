<?php

namespace App\Admin;


use Sonata\AdminBundle\Admin\AbstractAdmin;
use App\Entity\CategoryserviceAdmin as Categoryservice;
use Sonata\AdminBundle\Admin\AdminInterface;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Knp\Menu\ItemInterface as MenuItemInterface;
use Sonata\AdminBundle\Route\RouteCollection;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Doctrine\ORM\EntityRepository;


class CategoryserviceAdmin extends AbstractAdmin
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
               // 'data' => true,
                'expanded' => true,
//                'required' => false,
                'choices' => [
                    'Да' => 1,
                    'Нет' => 0,
                ]
            ])
            ->add('name', TextType::class, [
                'label' => 'Name',
            ])
            ->add('slug', TextType::class, [
                'label' => 'Slug',
                'required' => false,
            ])

            ->add('parent', EntityType::class, [
                'required' => false,
                'class' => Categoryservice::class,
                // 'data' => 0,
                'choice_label' => 'name',
                'query_builder' => function (EntityRepository $repo) {
                    return $repo->createQueryBuilder('r')->andWhere('r.published = 1')->orderBy('r.name');
                }
            ])

            ->add('meta_title', TextType::class, [
                'label' => 'Meta Title',
                'required' => false,
            ])
            ->add('meta_desc', TextareaType::class, [
                'label' => 'Meta Description',
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
            ->add('name', null, [
                'label' => 'Название',
                'row_align' => 'left',
                'editable' => true
            ])
//            ->add('parent', EntityType::class, [
//                'class' => Categoryservice::class,
//                'associated_property' => 'name',
////                'disabled' => true,
//            ])
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

    public function prePersist($model) {

        $model->convertslug();
    }
//
    public function preUpdate($model) {

//        $model->convertslug();

    }

//    protected function configureShowFields(ShowMapper $showMapper)
//    {
//        $showMapper
//            ->add('count');
//    }
//
//    public function toString($object)
//    {
//        return $object instanceof Categoryservice
//            ? 'Вакансии. '.$object->getTitle()
//            : 'Вакансии.'; // shown in the breadcrumb on the create view
//    }
//
    public function configureOptions(OptionsResolver $resolver)
{
    $resolver->setDefaults([
        'data_class' => Categoryservice::class,
    ]);
}

//    public function translit($s) {
//        $s = (string) $s; // преобразуем в строковое значение
//        $s = strip_tags($s); // убираем HTML-теги
//        $s = str_replace(array("\n", "\r"), " ", $s); // убираем перевод каретки
//        $s = preg_replace("/\s+/", ' ', $s); // удаляем повторяющие пробелы
//        $s = trim($s); // убираем пробелы в начале и конце строки
//        $s = function_exists('mb_strtolower') ? mb_strtolower($s) : strtolower($s); // переводим строку в нижний регистр (иногда надо задать локаль)
//        $s = strtr($s, array('а'=>'a','б'=>'b','в'=>'v','г'=>'g','д'=>'d','е'=>'e','ё'=>'e','ж'=>'j','з'=>'z','и'=>'i','й'=>'y','к'=>'k','л'=>'l','м'=>'m','н'=>'n','о'=>'o','п'=>'p','р'=>'r','с'=>'s','т'=>'t','у'=>'u','ф'=>'f','х'=>'h','ц'=>'c','ч'=>'ch','ш'=>'sh','щ'=>'shch','ы'=>'y','э'=>'e','ю'=>'yu','я'=>'ya','ъ'=>'','ь'=>''));
//        $s = preg_replace("/[^0-9a-z-_ ]/i", "", $s); // очищаем строку от недопустимых символов
//        $s = str_replace(" ", "-", $s); // заменяем пробелы знаком минус
//        return $s; // возвращаем результат
//    }

   

}