<?php

namespace App\Controller;

use App\Controller\Api\ApiController;
use App\Entity\City;
use App\Entity\Company;
use App\Entity\News;
use App\Entity\Product;
use App\Entity\ProductRubric;
use App\Entity\Region;
use App\Entity\Rubric;
use App\Entity\Service;
use App\Entity\Tag;
use App\Form\CompanyType;
use App\Repository\JosClientsAddedRepository;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Tetranz\Select2EntityBundle\Form\Type\Select2EntityType;
use Tetranz\Select2EntityBundle\Service\AutocompleteService;
use EdSDK\FlmngrServer\FlmngrServer;

class IndexController extends ApiController
{
    /**
     * Create SearchForm
     *
     * @param $terms
     * @return mixed
     */
    public function createSearchForm($terms)
    {
        $em = $this->getDoctrine()->getManager();
        $regionChoices = $em->getRepository(Region::class)->getChoices();
        $city201 = $em->getRepository(City::class)->getCity201($terms);
        $city202 = $em->getRepository(City::class)->getCity202($terms);
        $city203 = $em->getRepository(City::class)->getCity203($terms);
        $city204 = $em->getRepository(City::class)->getCity204($terms);
        $city205 = $em->getRepository(City::class)->getCity205($terms);
        $city206 = $em->getRepository(City::class)->getCity206($terms);
        $form = $this->get('form.factory')->createNamedBuilder(null, 'Symfony\Component\Form\Extension\Core\Type\FormType', $terms, array('csrf_protection' => false))
            ->setMethod('GET')
            ->add('regions', ChoiceType::class, [
                'choices' => $regionChoices,
                'label' => 'Регионы',
                'attr' => [
                    'class' => 'search-regions'
                ],
                'multiple' => true,
                'data' => $terms['regions'],
                'expanded' => true,
                'mapped' => false,
                'required' => false,
            ])
            ->add('region201', ChoiceType::class, [
                'choices' => $city201,
                'label' => 'Города',
                'attr' => [
                    'class' => 'cityForm'
                ],
               'data' => $terms['region201'],
                'required' => false,
                'multiple' => true,
                'expanded' => true,
                'mapped' => false,
            ])
            ->add('region202', ChoiceType::class, [
                'choices' => $city202,
                'label' => 'Города',
                'attr' => [
                    'class' => 'cityForm'
                ],
                'data' => $terms['region202'],
                'required' => false,
                'multiple' => true,
                'expanded' => true,
                'mapped' => false,
            ])
            ->add('region203', ChoiceType::class, [
                'choices' => $city203,
                'label' => 'Города',
                'attr' => [
                    'class' => 'cityForm'
                ],
                'data' => $terms['region203'],
                'required' => false,
                'multiple' => true,
                'expanded' => true,
                'mapped' => false,
            ])
            ->add('region204', ChoiceType::class, [
                'choices' => $city204,
                'label' => 'Города',
                'attr' => [
                    'class' => 'cityForm'
                ],
                'data' => $terms['region204'],
                'required' => false,
                'multiple' => true,
                'expanded' => true,
                'mapped' => false,
            ])
            ->add('region205', ChoiceType::class, [
                'choices' => $city205,
                'label' => 'Города',
                'attr' => [
                    'class' => 'cityForm'
                ],
                'data' => $terms['region205'],
                'required' => false,
                'multiple' => true,
                'expanded' => true,
                'mapped' => false,
            ])
            ->add('region206', ChoiceType::class, [
                'choices' => $city206,
                'label' => 'Города',
                'attr' => [
                    'class' => 'cityForm'
                ],
                'data' => $terms['region206'],
                'required' => false,
                'multiple' => true,
                'expanded' => true,
                'mapped' => false,
            ])
            ->add('alias', HiddenType::class, array(
                'data' => $terms['alias'],
            ))
            ->add('tags', Select2EntityType::class, [
                'multiple' => true,
                'remote_route' =>'search_tags',
                'class' => Tag::class,
                'primary_key' => 'id',
                'text_property' => 'text',
                'minimum_input_length' => 2,
                'page_limit' => 10,
                'scroll' => true,
                'delay' => 500,
                'cache' => true,
                'cache_timeout' => 60000, // if 'cache' is true
                'language' => 'ru',
                'placeholder' => 'Выберите тэги',
            ])
            ->getForm();

        return $form;
    }

    public function createSearchTags($terms)
    {
        $em = $this->getDoctrine()->getManager();
        $tags = $em->getRepository(Tag::class)->getTags();
        $form = $this->get('form.factory')->createNamedBuilder(null, 'Symfony\Component\Form\Extension\Core\Type\FormType', $terms, array('csrf_protection' => false))
            ->setMethod('GET')
            ->add('tags', ChoiceType::class, [
                'choices' => $tags,
                'label' => 'Тэги',
                'attr' => [
                    'class' => 'search-regions'
                ],
                'required' => false,
                'multiple' => true,
                'expanded' => false,
                'mapped' => false,
            ])
            ->getForm();
        return $form;
    }

    public function createSearchForm3($terms)
    {
        $form = $this->get('form.factory')->createNamedBuilder(null, 'Symfony\Component\Form\Extension\Core\Type\FormType', $terms, array('csrf_protection' => false))
            ->setMethod('GET')
            ->add('regions2', EntityType::class, [
                'label' => 'Регион',
                'class' => Region::class,
                'choice_label' => 'regionName',
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('r');
                },
                'attr' => [
                    'class' => 'search-regions'
                ],
                'multiple' => true,
                'data' => $terms['regions'],
                'expanded' => false,
                'mapped' => false,
                'required' => false,
            ])
            ->getForm();
        return $form;
    }
    
    /**
     * @Route("/flmngr", name="flmngr")
     */
    public function flmngr()
    {
        FlmngrServer::flmngrRequest(
            array(
                'dirFiles' => $this->getParameter('kernel.project_dir') . '/public/belarusinfo.by/ru/images/stories/photo_gallery'
            )
        );
        die;
    }

    /**
     * @Route("/api_clients_added", name="api_clients_added")
     */
    public function apiClientsAdded(JosClientsAddedRepository $josClientsAddedRepository)
    {
        $clients = $josClientsAddedRepository->getCompanies();
        return $this->ApiResponse($clients, ['groups' => 'api']);
    }
}
