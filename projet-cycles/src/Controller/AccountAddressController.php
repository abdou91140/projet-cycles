<?php

namespace App\Controller;

use App\Classe\Cart;
use App\Entity\Address;
use App\Form\AddressType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AccountAddressController extends AbstractController
{
    /**
     * @var EntityManagerInterface
     */
    private EntityManagerInterface $entityManager;

    /**
     * RegisterController constructor.
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {

        $this->entityManager = $entityManager;
    }
    #[Route('/mon-compte/adresses/', name: 'account_address')]
    public function index(): Response
    {
//      $addresses=  $this->entityManager->getRepository(Address::class)->findAll();
        return $this->render('account/address.html.twig', [
        ]);
    }
    #[Route('/mon-compte/adresse/ajout', name: 'account_add_address')]
    public function add(Cart $cart,Request $request): Response
    {
        $address = new Address();
        $form=$this->createForm(AddressType::class,$address);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $address->setUser($this->getUser());
            $this->entityManager->persist($address);
            $this->entityManager->flush();
            if ($cart->get()){
                return $this->redirectToRoute('order');
            }else{
                return $this->redirectToRoute('account_address');

            }
        }

        return $this->render('account/address.form.html.twig', [
            'form'=> $form->createView()
        ]);
    }

    #[Route('/mon-compte/adresse/modifier/{id}', name: 'account_edit_address')]
    public function edit(Request $request,$id): Response
    {

        $address=  $this->entityManager->getRepository(Address::class)->findOneById($id);
        if(!$address || $address->getUser() != $this->getUser() ){
            return  $this->redirectToRoute('account_address');
        }
        $form=$this->createForm(AddressType::class,$address);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->entityManager->flush();

            return $this->redirectToRoute('account_address');
        }

        return $this->render('account/address.form.html.twig', [
            'form'=> $form->createView()
        ]);
    }

    #[Route('/mon-compte/adresse/supprimer/{id}', name: 'account_delete_address')]
    public function delete($id): Response
    {

        $address = $this->entityManager->getRepository(Address::class)->findOneById($id);
        if($address || $address->getUser() == $this->getUser() ){
            $this->entityManager->remove($address);
            $this->entityManager->flush();
        }

        return  $this->redirectToRoute('account_address');

    }
}
