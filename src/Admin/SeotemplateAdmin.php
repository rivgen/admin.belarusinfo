<?php

namespace App\Admin;


use Sonata\AdminBundle\Admin\AbstractAdmin;
use App\Entity\SeotemplateAdmin as Seotemplate;
use Sonata\AdminBundle\Admin\AdminInterface;
use App\Entity\JosRubric;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Doctrine\ORM\EntityRepository;
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


class SeotemplateAdmin extends AbstractAdmin
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

        $subject = $this->getSubject();
        if (null === $subject->getId()) {
            $id = 0;
        }
        else {
            $id = $subject->getId();
        }
//        var_dump($subject->getParent());
//        var_dump($id);

        /*
         * help  special tags
         *
         * 3 - Тег
         * 2 - Рубрика
         * 1 - Карточка организации
         * 5 - Карточка товара
         * 4 - Карточка вакансии
         * 12 - Карточка акции
         * 14 - Карточка акции
         */
        if(isset($id) && $id > 0){
            switch ($id){
                case (3) :
                    $help_text = '<span style="border-bottom: 1px solid red;">Можно использовать специальный тег </span> &nbsp <br/>
                            <b>{tag__name}</b> &nbsp - для вставки названия Тега  <br>
                            <b>{company__total}</b> &nbsp - для вставки Количества найденных компаний по тегу  <br>';
                    $name = 'Тег';
                    break;
                case (2) :
                    $help_text = '<span style="border-bottom: 1px solid red;">Можно использовать специальный тег </span> &nbsp <br/>
                            <b>{rubric__name}</b> &nbsp - для вставки названия Рубрики (в шаблон рубрики ) <br>';
                    $name = 'Рубрика';
                    break;
                case (1) :
                    $help_text = '<span style="border-bottom: 1px solid red;">Можно использовать специальный тег </span> &nbsp <br/>
                            <b>{company__name}</b> &nbsp - для вставки названия Компании (в шаблон компании )<br>';
                    $name = 'Карточка организации';
                    break;
                case (5) :
                    $help_text = '<span style="border-bottom: 1px solid red;">Можно использовать специальный тег </span> &nbsp <br/>
                            <b>{company__name}</b> &nbsp - для вставки названия Компании (в шаблон Товара )<br>
                            <b>{product__title}</b> &nbsp - для вставки названия Товара (в шаблон Товара )<br>';
                    $name = 'Карточка организации';
                    break;
                case (7) :
                    $help_text = '<span style="border-bottom: 1px solid red;">Можно использовать специальный тег </span> &nbsp <br/>
                            <b>{company__name}</b> &nbsp - для вставки названия Услуги (в шаблон Услуги )<br>
                            <b>{service__title}</b> &nbsp - для вставки названия Услуги (в шаблон Услуги )<br>';
                    $name = 'Карточка организации';
                    break;
                case (4) :
                    $help_text = '<span style="border-bottom: 1px solid red;">Можно использовать специальный тег </span> &nbsp <br/>
                            <b>{company__name}</b> &nbsp - для вставки названия Вакансии (в шаблон Вакансии )<br>
                            <b>{vacancy__title}</b> &nbsp - для вставки названия Вакансии (в шаблон Вакансии )<br>';
                    $name = 'Карточка организации';
                    break;
                case (12) :
                    $help_text = '<span style="border-bottom: 1px solid red;">Можно использовать специальный тег </span> &nbsp <br/>
                            <b>{company__name}</b> &nbsp - для вставки названия Акции (в шаблон Акции )<br>
                            <b>{sale__title}</b> &nbsp - для вставки названия Акции (в шаблон Акции )<br>';
                    $name = 'Карточка организации';
                    break;
                case (14) :
                    $help_text = '<span style="border-bottom: 1px solid red;">Можно использовать специальный тег </span> &nbsp <br/>
                            <b>{company__name}</b> &nbsp - для вставки названия Новости (в шаблон Новости )<br>
                            <b>{news__title}</b> &nbsp - для вставки названия Новости (в шаблон Новости )<br>';
                    $name = 'Карточка организации';
                    break;
                default :
                    $help_text = '<span style="border-bottom: 1px solid red;">Можно использовать специальный тег </span> &nbsp <br/>
                            <b>{company__name}</b> &nbsp - для вставки названия Компании <br>';
                   // $name = 'Карточка организации';
                    $name = $subject->getName();
                    break;
            }
            $disabled = true;
        }
        else{
            $help_text = '';
           // $name = '';
            $disabled = false;
        }


//        $username = $this->security->getUser()->getUsername();
        $formMapper
            ->add('published', ChoiceType::class, [
                'label' => 'Опубликовано',
                'attr' => ['class' => 'c_inline_choice'],
//                'multiple' => true,
//                'data' => true,
                'expanded' => true,
//                'required' => false,
                'choices' => [
                    'Да' => 1,
                    'Нет' => 0,
                ]
            ])

            ->add('name', TextType::class, [
                'label' => 'Название',
                //'data' => $name,
                'attr' => [
                   // 'readonly' => 'readonly',
                    'style' => 'pointer-events: none!important;',
                ]
            ])

            ->add('title', TextType::class, [
                'label' => 'Шаблон Мета title',
                'help' => $help_text,
                'required' => false,
            ])


            ->add('description', TextareaType::class, [
                'label' => 'Шаблон Мета Description',
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
                'editable' => false
            ])
            ->add('published', null, [
                'label' => 'Published',
                'row_align' => 'left',
                'editable' => false
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

        //$model->convertslug();
    }
//
    public function preUpdate($model) {

       // $model->convertslug();

    }



//    protected function configureShowFields(ShowMapper $showMapper)
//    {
//        $showMapper
//            ->add('count');
//    }
//
    public function toString($object)
    {
        return $object instanceof Seotemplate
            ? 'Шаблоны. '.$object->getName()
            : 'Шаблоны.'; // shown in the breadcrumb on the create view
    }
//
    public function configureOptions(OptionsResolver $resolver)
{
    $resolver->setDefaults([
        'data_class' => Seotemplate::class,
    ]);
}


    protected function configureRoutes(RouteCollection $collection)
    {
        $collection->remove('create');
        $collection->remove('delete');
        $collection->remove('export');


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