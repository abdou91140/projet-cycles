<?php

namespace App\Controller;

use App\Classe\Search;
use App\Entity\Product;
use App\Form\SearchType;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @property EntityManagerInterface entityManager
 */
class ProductController extends AbstractController
{

    /**
     * ProductController constructor.
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @return Response
     */
    #[Route('/nos-vélos', name: 'products')]
    public function index(Request $request): Response
    {

        $search = new Search();
        $form = $this->createForm(SearchType::class, $search);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid() ){
            $products = $this->entityManager->getRepository(Product::class)->findWithSearch($search);
        }else{
            $products = $this->entityManager->getRepository(Product::class)->findAll();

        }
        return $this->render('product/index.html.twig', [
            'products' => $products, 'form' => $form->createView()
        ]);
    }

    /**
     * @param $slug
     * @return Response
     */
    #[Route('/le-vélo/{slug}', name: 'product')]
    public function show($slug): Response
    {
        $product = $this->entityManager->getRepository(Product::class)->findOneBy(['slug'=>$slug]);
        if (!$product){
            return  $this->redirectToRoute('product');
        }

        return $this->render('product/show.html.twig', [
            'product' => $product
        ]);
    }
}
