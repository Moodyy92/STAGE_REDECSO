<?php

namespace App\Controller;

use App\Entity\Produit;
use App\Form\ProduitType;
use App\Repository\ProduitRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/produit')]
class ProduitController extends AbstractController
{
    #[Route('/', name: 'produit_index', methods: ['GET'])]
    public function index(ProduitRepository $produitRepository): Response
    {
        return $this->render('produit/index.html.twig', [
            'produits' => $produitRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'produit_new', methods: ['GET', 'POST'])]
    public function new(Request $request, ProduitRepository $produitRepository): Response
    {
        $produit = new Produit();
        $form = $this->createForm(ProduitType::class, $produit, [
            'action'=>$this->generateUrl('produit_new'),
        ]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($produit);
            $entityManager->flush();

            return $this->redirectToRoute('produit_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('/produit/new.html.twig', [
            'form'  =>  $form->createView()
        ]);
    }
    //Permet la recherche d'un produit par son libelle
    #[Route('/search', name: 'produit_search', methods: ['GET'])]
    public function getProduitDevis(Request $request, ProduitRepository $produitRepository): JsonResponse
    {
        $term = $request->get('term');
//        dd($term);
        $produits = $produitRepository->findByLibelleAsArray($term);

     return new JsonResponse($produits);
    }

    #[Route('/{id}', name: 'produit_show', methods: ['GET'])]
    public function show(Produit $produit): Response
    {
        return $this->render('produit/show.html.twig', [
            'produit' => $produit,
        ]);
    }

    #[Route('/{id}/edit', name: 'produit_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Produit $produit, ProduitRepository $produitRepository, EntityManagerInterface $em, int $id): Response
    {
        $form = $this->createForm(ProduitType::class, $produit,[
            'action'=>$this->generateUrl('produit_edit',['id'=>$produit->getId()]),
        ]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('produit_index', [], Response::HTTP_SEE_OTHER);
        }


        $produitEdit = $produitRepository->find($id);

        if (@$request->request->get('libelle') && $produitEdit){
            $produitEdit->setLibelle($request->request->get('libelle'));
            $em->persist($produit);
            $em->flush();
            $produitArray = $produitRepository->findBy0neAsArray($produitEdit->getId());

            return new JsonResponse($produitArray);
        }

        return $this->renderForm('produit/edit.html.twig', [
            'produit' => $produit,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'produit_delete', methods: ['POST'])]
    public function delete(Request $request, Produit $produit): Response
    {
        if ($this->isCsrfTokenValid('delete'.$produit->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($produit);
            $entityManager->flush();
        }

        return $this->redirectToRoute('produit_index', [], Response::HTTP_SEE_OTHER);
    }
}
