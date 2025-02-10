<?php

namespace App\Admin;

use App\Entity\JosAdminClients;
use App\Entity\JosCity;
use App\Entity\JosContent;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Admin\AdminInterface;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Route\RouteCollection;
use Sonata\Form\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Sonata\AdminBundle\Form\Type\ModelType;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Knp\Menu\ItemInterface as MenuItemInterface;
use Symfony\Component\Security\Core\Security;

class AdminClientsAdmin extends AbstractAdmin
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
        
        /** @var User $subject */
        $subject = $this->getSubject();
        
        $ms_metric = $subject->getMsmetric() ?? 1;
        $metric = $subject->getMetric() ?? 1;
        // get the current Image instance
//        $image = $this->getSubject();
//        $fileFormOptions = ['required' => false];
//        if ($image && ($webPath = $image->getWebPath())) {
//            $container = $this->getConfigurationPool()->getContainer();
//            $fullPath = $container->get('request_stack')->getCurrentRequest()->getBasePath().'/'.$webPath;
//            $fileFormOptions['help'] = '<img src="/public/'.$image->getImage().'" class="admin-preview" style="max-height: 150px;padding-top: 15px;"  />';
//        }

//        $username = $this->security->getUser()->getUsername();
        $formMapper
            ->with('Номер организации ' . $subject->getIdCompany(), ['class' => 'col-md-4'])
            ->add('idCompany', null, [
                'label' => 'Id Номер организации',
                
            ])
            ->add('name', null, [
                'label' => 'Название организации',
            ])
            ->add('address', null, [
                'label' => 'Адрес',
            ])
            ->add('city', EntityType::class, [
                'label' => 'Города',
                'class' => JosCity::class,
                'choice_label' => 'cityName',
            ])
            ->add('logo', ChoiceType::class, [
                'label' => 'Логотип',
//                'multiple' => true,
                'data' => true,
                'expanded' => true,
//                'required' => false,
                'choices' => [
                    'Есть' => 1,
                    'Нет' => 0,]])
            ->end()
            ->with('Информация', ['class' => 'col-md-4'])
            ->add('email')
            ->add('site', null, [
                'label' => 'Сайт',
            ])
            ->add('clientIndex', null, [
                'label' => 'Индекс почтовый',
            ])
            ->add('promo', null, [
                'label' => 'Ссылка на промо',
            ])
            ->add('ordering')
            ->end()
            ->with('Рубрики', ['class' => 'col-md-4'])
            ->add('rubric', null, [
                'label' => 'Номера',
            ])
            ->end()
            ->with('Посещения', ['class' => 'col-md-4'])
            ->add('metric', null, [
                'label' => 'Количество посещений',
                'data' => $metric
            ])
            ->add('ms_metric', null, [
                'label' => 'Количество посещений от Медиа Шарк',
                'data' => $ms_metric
            ])
//            ->end()
//            ->with('Фоновое изображение', ['class' => 'col-md-4'])
//            ->add('file', FileType::class, $fileFormOptions)

            ->end()
            ->with('Рекламная строка')
            ->add('reklama', null, [
                'label' => false,
            ])
            ->end()
//            ->add('keywords', null, [
//                'label' => 'Ключевые слова',
//                'attr' => ['style' => 'height: 200px']
//            ])
            ->with('Телефоны', ['class' => 'col-md-12'])
            ->add('tels', CollectionType::class, [
                'label' => false,
                'by_reference' => false,
                'required' => false,
                'type_options' => [
                    'delete' => false,
//                    'delete_options' => [
//                        // You may otherwise choose to put the field but hide it
//                        'type'         => HiddenType::class,
//                        // In that case, you need to fill in the options as well
//                        'type_options' => [
//                            'mapped'   => false,
//                            'required' => false,
//                        ]
//                    ]
                ],
                'btn_add' => false,
//                'allow_add' => true,
            ], [
                'edit' => 'inline',
                'inline' => 'table',
                'sortable' => 'position',
//                'limit' => 1,
                'allow_add' => true,

            ])
            ->end()
            ->with('РУбрики', ['class' => 'col-md-12'])
            ->add('rubrics', CollectionType::class, [
                'label' => false,
                'by_reference' => false,
                'required' => false,
                'type_options' => [
                    'delete' => false,
//                    'delete_options' => [
//                        // You may otherwise choose to put the field but hide it
//                        'type'         => HiddenType::class,
//                        // In that case, you need to fill in the options as well
//                        'type_options' => [
//                            'mapped'   => false,
//                            'required' => false,
//                        ]
//                    ]
                ],
                'btn_add' => false,
//                'allow_add' => true,
            ], [
                'edit' => 'inline',
                'inline' => 'table',
                'sortable' => 'position',
//                'limit' => 1,
                'allow_add' => true,

            ])
            ->end()
            ->with('Для поиска', ['class' => 'col-md-12'])
            ->add('all', null, [
                'label' => 'Фразы участвующие в поиске (для поискового индекса)',
            ])
            ->end()


        ;


    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
//            ->add('id')
            ->add('idCompany', null, [
                'label' => 'Клиент',
                'show_filter' => true,
            ])
            ->add('name', null, [
                'label' => 'Название организации',
            ]);
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        // удаляет ссылку на выбор плитки
        unset($this->listModes['mosaic']);
        $listMapper
            ->add('idCompany', null, [
                'header_style' => 'width: 5%',
                'row_align' => 'left'
            ])
            ->addIdentifier('name', null, [
                'label' => 'Название организации',
                'header_style' => 'width: 50%',
                'row_align' => 'left'
            ])
            ->add('rubric', null, [
                'label' => 'Номер рубрики',
            ])
            ->add('_action', null, [
                'actions' => [
//                    'show' => [],
                    'edit' => [],
                    'delete' => [],
                ]]);;
    }


    public function prePersist($model) {

        //$model->upload();
    }
//
    public function preUpdate($model) {

        //$model->upload();
    }


// удаляет ссылку на создание "create"
    protected function configureRoutes(RouteCollection $collection)
    {
        //$collection->remove('create');
        $collection->remove('export');
        //$collection->remove('delete');
    }

    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('name');
    }

    public function toString($object)
    {
        return $object instanceof JosAdminClients
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
        $josAdminClients = $this-> getConfigurationPool () -> getContainer () -> get ('doctrine') -> getRepository (JosAdminClients::class);
        $company = $josAdminClients->findOneBy(['idInc' => $id]);
//        $menu->addChild('View Playlist', [
//            'uri' => $admin->generateUrl('show', ['id' => $id])
//        ]);
        if ($this->isGranted('LIST')) {
            $menu->addChild('Все компании', [
                'uri' => $admin->generateUrl('list')
            ]);
        }

        if ($this->isGranted('EDIT')) {
            $menu->addChild('Компания (' . $company->getIdCompany() . ')', [
                'uri' => $admin->generateUrl('edit', ['id' => $id])
            ]);
        }

        if ($this->isGranted('LIST')) {
            $menu->addChild('О компании (' . $company->getIdCompany() . ')', [
                'uri' => $admin->getChild('admin.clients')->generateUrl('admin.jos.content.list', ['id' => $id, 'childId' => $id])
            ]);
        }

        if ($this->isGranted('LIST')) {
            $menu->addChild('Телефоны (' . $company->getIdCompany() . ')', [
                'uri' => $admin->generateUrl('admin.tels.list', ['id' => $id])
            ]);
        }

        if ($this->isGranted('LIST')) {
            $menu->addChild('Рубрики (' . $company->getIdCompany() . ')', [
                'uri' => $admin->generateUrl('admin.jos.rubric.client.list', ['id' => $id])
            ]);
        }

        if ($this->isGranted('LIST')) {
            $menu->addChild('Новости (' . $company->getIdCompany() . ')', [
                'uri' => $admin->generateUrl('admin.newsletteradmin.list', ['id' => $id])
            ]);
        }

        /*if ($this->isGranted('LIST')) {
            $menu->addChild('Акции (' . $company->getIdCompany() . ')', [
                'uri' => $admin->generateUrl('admin.sale.list', ['id' => $id])
            ]);
        }

        if ($this->isGranted('LIST')) {
            $menu->addChild('Отзывы (' . $company->getIdCompany() . ')', [
                'uri' => $admin->generateUrl('admin.review.list', ['id' => $id])
            ]);
        }*/

        if ($this->isGranted('LIST')) {
            $menu->addChild('Вакансии (' . $company->getIdCompany() . ')', [
                'uri' => $admin->generateUrl('admin.vacancy.list', ['id' => $id])
            ]);
        }

        if ($this->isGranted('LIST')) {
            $menu->addChild('Товары (' . $company->getIdCompany() . ')', [
                'uri' => $admin->generateUrl('admin.product.list', ['id' => $id])
            ]);
        }

        if ($this->isGranted('LIST')) {
            $menu->addChild('Услуги (' . $company->getIdCompany() . ')', [
                'uri' => $admin->generateUrl('admin.service.list', ['id' => $id])
            ]);
        }

        /*if ($this->isGranted('LIST')) {
            $menu->addChild('Филиалы (' . $company->getIdCompany() . ')', [
                'uri' => $admin->generateUrl('admin.filial.list', ['id' => $id])
            ]);
        }*/

        if ($this->isGranted('LIST')) {
            $menu->addChild('Дополнительно (' . $company->getIdCompany() . ')', [
                'uri' => $admin->generateUrl('admin.clientsetting.list', ['id' => $id])
            ]);
        }

        if ($this->isGranted('LIST')) {
            $menu->addChild('Метрика (' . $company->getIdCompany() . ')', [
                'uri' => $admin->generateUrl('admin.clientmetric.list', ['id' => $id])
            ]);
        }


//        if ($this->isGranted('LIST')) {
//            $menu->addChild('Текст / ключевики ('.$id.')', [
//                'uri' => $admin->generateUrl('admin.description.key.list', ['id' => $id])
//            ]);
//        }
    }

    public function configureExportFields(AdminInterface $admin, array $fields)
    {
        unset($fields['updatedAt']);

        return $fields;
    }
}