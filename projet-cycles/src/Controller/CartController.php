<?php

namespace App\Controller;

use App\Classe\Cart;
use App\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;
use phpDocumentor\Reflection\Types\String_;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CartController extends AbstractController
{
    private EntityManagerInterface $entityManager;

    /**
     * CartController constructor.
     * @param $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/mon-panier', name: 'cart')]
    public function index(Cart $cart): Response
    {
        if ($cart->get()){
            $cart->getFull();
        }

        return $this->render('cart/index.html.twig',[
            'cart'=> $cart->getFull()
        ]);
    }

    #[Route('/mon-panier/ajout/{id}', name: 'add_to_cart')]
    public function add(Cart $cart, $id): Response
    {
        $cart->add($id);
            return $this->redirectToRoute('cart');
    }

    #[Route('/mon-panier/effacer/{id}{', name: 'delete_to_cart')]
    public function delete(Cart $cart, $id): Response
    {
        $cart->delete($id);
        return $this->redirectToRoute('cart');
    }

    #[Route('/mon-panier/retirer/{id}{', name: 'decrease_to_cart')]
    public function decrease(Cart $cart, $id): Response
    {
        $cart->decrease($id);
        return $this->redirectToRoute('cart');
    }

    #[Route('mon-panier/vider/', name: 'remove_my_cart')]
    public function remove(Cart $cart): Response
    {
        $cart->remove();
        return $this->redirectToRoute('cart',[
            'cart'=> $cart ]);
    }
}
