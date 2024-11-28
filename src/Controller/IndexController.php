<?php

namespace App\Controller;

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
use Doctrine\DBAL\Types\TextType;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Tetranz\Select2EntityBundle\Form\Type\Select2EntityType;
use Tetranz\Select2EntityBundle\Service\AutocompleteService;
use EdSDK\FlmngrServer\FlmngrServer;

class IndexController extends Controller
{
    ///**
     //* @Route("/", name="index_index", methods="GET")
    // */
    //public function index(Request $request): Response
    //{
    //    $em = $this->getDoctrine()->getManager();
//        $companyRepository = $em->getRepository(Company::class);
//        $rubricsRepository = $em->getRepository(Rubric::class);
//        $regionRepository = $em->getRepository(Region::class);
//        $cityRepository = $em->getRepository(City::class);
       // $newsRepository = $em->getRepository(News::class);
//        $productRubricRepository = $em->getRepository(ProductRubric::class);
//        $terms = $request->query->all();
//        $terms['tagName'] =  $request->query->get('tags');
//        $terms['tagName'] = $request->query->get('tags', 0);;
//        if (!empty($terms['search-btn'])){
//            return $this->redirectToRoute('companies_by_tag', $terms);
//        }
//        $terms['rubricAlias'] = $request->query->get('rubricAlias');
//        $defaultRegionIds = $regionRepository->getDefaultRegionIdes();
//        $defaultCityIds = $em->getRepository(City::class)->getDefaultCityIdes();
//        $rubricCompanies =  $rubricsRepository->getRubricCompany();
//        $productASC = $em->getRepository(Product::class)->searchAllProduct();
//        $serviceASC = $em->getRepository(Service::class)->searchAllProduct();
//        $searchCompanyInTags = $em->getRepository(Company::class)->searchCompanyInTags();
//        $setRubrics = $em->getRepository(Rubrics::class)->searchRubricCompany();
//        $arr = ['rubric0' => $rubricCompanies, 'rubric1' =>$setRubrics];
//        dump($productASC);
//        $terms['regions'] = $request->query->get('regions');
//        $terms['region201'] = $request->query->get('region201', null);
//        $terms['region202'] = $request->query->get('region202', null);
//        $terms['region203'] = $request->query->get('region203', null);
//        $terms['region204'] = $request->query->get('region204', null);
//        $terms['region205'] = $request->query->get('region205', null);
//        $terms['region206'] = $request->query->get('region206', null);
//        $terms['cites'] = $request->query->get('cites', $defaultCityIds );
//        $terms['alias'] = $request->query->get('alias');
//        $tagIds = $request->query->get('tags');
//        $terms['tags'] = $em->getRepository(Tag::class)->searchByIds($tagIds);
//        $search_form = $this->createSearchForm($terms);
//        $search_form = $this->container->get('search_form_helper')->createSearchTag($terms);
//        $search_form = $this->get('search_form_helper')->getSiteCompany($terms);
//        dump($terms);
//        $searchTags = $this->createSearchTags($terms);
//        $search_form2 = $this->createSearchForm2($terms);
//        dump($search_form->createView());
//        $terms['tags'] = $tagIds;
//        $countRegionId = $companyRepository->searchByRegionId($terms);
//        $showCites = $cityRepository->showCites($terms);
//        $countRegionIdes = count($countRegionId);
//        $showRegions = $regionRepository->showRegions($terms);
       // $showNewsTop = $newsRepository->showNewsTop();
        //$showNews = $newsRepository->showNews();
//        $rubricProduct = $productRubricRepository->getRubricProduct();
//        $countRubricProduct = $productRubricRepository->countRubricProduct();
//        dump($terms);
//        if ($tagIds){$tagIds};
//        else $tagIds = $terms['tags'];
//        dump($showCites);


       // return $this->render('index/index.html.twig', [
//            'search_form' => $search_form->createView(),
//            'search_form2' => $search_form->createView(),
//            'searchTags' => $searchTags->createView(),
//            'countRegions' => $countRegionId,
//            'rubricCompanies' => $rubricCompanies,
//            'setRubrics' => $setRubrics,
//            'productsAll' => $productASC,
//            'serviceAll' => $serviceASC,
//            'showRegions' => $showRegions,
//            'showCites' => $showCites,
        //    'showNewsTop' => $showNewsTop,
        //    'showNews' => $showNews,
//            'terms' => $terms,
//            'tagIds' => $tagIds,
//            'rubricProduct' => $rubricProduct,
//            'countRubricProduct' => $countRubricProduct,
      //  ]);
    //}

   // /**
   //  * @Route("/search/tags", name="search_tags", methods="GET")
   //  */
   // public function searchTagsAjax(Request $request)
    //{
    //    $em = $this->getDoctrine()->getManager();
    //    $terms = $request->query->all();
    //    $terms['q'] = $request->query->get('q');
    //    $result =  $em->getRepository(Tag::class)->searchTags($terms);
//        return new JsonResponse([
//            'results' => $result,
////            'code'    => $exception->getCode(),
////            'message' => $exception->getMessage(),
//        'more' => true,
//
//        ]);
     //   return new JsonResponse($result);
    //}

    ///**
    // * @Route("/search/regions", name="search_regions", methods="GET")
    // */
    //public function searchRegionsAjax(Request $request)
    //{
    //    $em = $this->getDoctrine()->getManager();
    //    $terms = $request->query->all();
    //    $terms['r'] = $request->query->get('r');
    //    $result =  $em->getRepository(Region::class)->searchRegions($terms);

    //    return new JsonResponse($result);
    //}

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
//        dump($city201);
//        dump($regionChoices);
        $form = $this->get('form.factory')->createNamedBuilder(null, 'Symfony\Component\Form\Extension\Core\Type\FormType', $terms, array('csrf_protection' => false))
//        $form = $this->get('form.factory')->createNamedBuilder(null)
            ->setMethod('GET')
            ->add('regions', ChoiceType::class, [
                'choices' => $regionChoices,
//                    [
//                    'Минская обл.' => 205,
//                    'Гомельская обл.' => 203,
//                    'Брестская обл.' => 201,
//                    'Гродненская обл.' => 204,
//                    'Витебская обл.' => 202,
//                    'Могилевская обл.' => 206,
//                ],
                'label' => 'Регионы',
                'attr' => [
                    'class' => 'search-regions'
                ],
                'multiple' => true,
                'data' => $terms['regions'],
//                'choice_value' => true,
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
//                'remote_path' => '/search/tags',
                'class' => Tag::class,
                'primary_key' => 'id',
                'text_property' => 'text',
//                'property' => 'name2',
                'minimum_input_length' => 2,
                'page_limit' => 10,
                'scroll' => true,
//                'allow_clear' => false,
//                'allow_clear' => true,
//                'required' => true,
                'delay' => 500,
                'cache' => true,
                'cache_timeout' => 60000, // if 'cache' is true
                'language' => 'ru',
                'placeholder' => 'Выберите тэги',
                // 'object_manager' => $objectManager, // inject a custom object / entity manager
            ])
//            ->add('tags', ChoiceType::class, [
////                'choices' => $tags,
//                'label' => 'Тэги',
//                'attr' => [
//                    'class' => 'search-regions'
//                ],
////                'data' => $terms['cites'],
//                'required' => false,
//                'multiple' => true,
//            ])
//            ->add('city', null, array('label' => 'Название содержит', 'attr' => array('size' => 50), 'required' => false))
            ->getForm();
//        $form->add('submit', 'submit', array('label' => 'Искать'));

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
//                'data' => $terms['cites'],
                'required' => false,
                'multiple' => true,
                'expanded' => false,
                'mapped' => false,
            ])
//            ->add('qwer', EntityType::class, [
////                'choices' => $regionChoices2,
//                'label' => 'Регион',
//                'class' => Region::class,
//                'choice_label' => 'regionName',
//                'query_builder' => function (EntityRepository $er) {
//                    return $er->createQueryBuilder('r');
//                },
////                'data' => $em->getReference(Region::class, 201),
//                'attr' => [
//                    'class' => 'search-regions'
//                ],
//                'multiple' => true,
//                'data' => $terms['regions'],
//                'expanded' => false,
//                'mapped' => false,
//                'required' => false,
//            ])
            ->getForm();
        return $form;
    }

    public function createSearchForm3($terms)
    {
//        $em = $this->getDoctrine()->getManager();
//        $regionChoices2 = $em->getRepository(Region::class)->getChoices();
        $form = $this->get('form.factory')->createNamedBuilder(null, 'Symfony\Component\Form\Extension\Core\Type\FormType', $terms, array('csrf_protection' => false))
            ->setMethod('GET')
            ->add('regions2', EntityType::class, [
//                'choices' => $regionChoices2,
                'label' => 'Регион',
                'class' => Region::class,
                'choice_label' => 'regionName',
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('r');
                },
//                'data' => $em->getReference(Region::class, 201),
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

        // As far Flmngr returns a response itself,
        // you must use "die" here to prevent a error.
        die;
    }
}
