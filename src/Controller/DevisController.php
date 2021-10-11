<?php

namespace App\Controller;

use App\Entity\Categorie;
use App\Entity\Devis;
use App\Entity\Produit;
use App\Entity\Tache;
use App\Form\CategorieType;
use App\Form\DevisType;
use App\Form\ProduitType;
use App\Form\TacheType;
use App\Repository\CategorieRepository;
use App\Repository\ClientRepository;
use App\Repository\DevisRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

#[Route('/devis')]
class DevisController extends AbstractController
{
    #[Route('/', name: 'devis_index', methods: ['GET'])]
    public function index(DevisRepository $devisRepository, CategorieRepository $categorieRepository): Response
    {
        return $this->render('devis/index.html.twig', [
            'devis' => $devisRepository->findAll(),
            'categorie' => $categorieRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'devis_new', methods: ['GET', 'POST'])]
    public function new(Request $request, DevisRepository $devisRepository, ClientRepository $clientRepository): Response
    {
        $devis = new Devis();
        $categorie = new Categorie();
        $tache = new Tache();
        $produit = new Produit();
        //----------------------------------------FORM DEVIS-----------------------------------------//
        $form = $this->createForm(DevisType::class, $devis);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($devis);
            $entityManager->flush();
            $devis_array = $devisRepository->findOneAsArray($devis->getId());
//            dd($devis_array);
            $client_array = $clientRepository->findOneAsArray($devis->getClient()->getId());
            $devis_array['client'] = $client_array;

            return new JsonResponse($devis_array);
        }

        //----------------------------------------FORM CATEGORIE--------------------------------------//
        $categorieForm = $this->createForm(CategorieType::class, $categorie,[
            'action'=>$this->generateUrl('categorie_new')
        ]);

        //----------------------------------------FORM TACHE-----------------------------------------//
        $tacheForm = $this->createForm(TacheType::class, $tache, [
            'action'=>$this->generateUrl('tache_new')
        ]);

        //----------------------------------------FORM PRODUIT-----------------------------------------//

        $produitForm = $this->createForm(ProduitType::class, $produit, [
            'action'=>$this->generateUrl('produit_new')
        ]);

        return $this->renderForm('devis/new.html.twig', [
            'devi' => $devis,
            'form' => $form,
            'categorieForm' => $categorieForm,
            'tacheForm' => $tacheForm,
            'produitForm' => $produitForm,
        ]);
    }

    #[Route('/{id}', name: 'devis_show', methods: ['GET'])]
    public function show(Devis $devis): Response
    {
        return $this->render('devis/show.html.twig', [
            'devi' => $devis,
        ]);
    }

    #[Route('/{id}/edit', name: 'devis_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Devis $devis): Response
    {
        $form = $this->createForm(DevisType::class, $devis);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('devis_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('devis/edit.html.twig', [
            'devi' => $devis,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'devis_delete', methods: ['POST'])]
    public function delete(Request $request, Devis $devis): Response
    {
        if ($this->isCsrfTokenValid('delete'.$devis->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($devis);
            $entityManager->flush();
        }

        return $this->redirectToRoute('devis_index', [], Response::HTTP_SEE_OTHER);
    }
}
