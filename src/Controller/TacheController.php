<?php

namespace App\Controller;

use App\Entity\Tache;
use App\Form\TacheType;
use App\Repository\CategorieRepository;
use App\Repository\TacheRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/tache')]
class TacheController extends AbstractController
{
    #[Route('/', name: 'tache_index', methods: ['GET'])]
    public function index(TacheRepository $tacheRepository): Response
    {
        return $this->render('tache/index.html.twig', [
            'taches' => $tacheRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'tache_new', methods: ['GET', 'POST'])]
    public function new(Request $request, TacheRepository $tacheRepository, CategorieRepository $categorieRepository): Response
    {
        $tache = new Tache();
        $form = $this->createForm(TacheType::class, $tache);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $categorie = $categorieRepository->find($request->request->get('categorie_id'));
            $tache->addCategory($categorie);
            $entityManager->persist($tache);

            $entityManager->flush();

            $tache_array = $tacheRepository->find0neAsArray($tache->getId());
            if($tache_array){
                return new JsonResponse($tache_array);
            } else{
                return new JsonResponse([
                   'error' => true,
                   'message' => 'Produit déjà lié à la categorie.'
                ]
                    ,500);
            }
        }

        return $this->renderForm('tache/new.html.twig', [
            'tache' => $tache,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'tache_show', methods: ['GET'])]
    public function show(Tache $tache): Response
    {
        return $this->render('tache/show.html.twig', [
            'tache' => $tache,
        ]);
    }

    #[Route('/{id}/edit', name: 'tache_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Tache $tache, TacheRepository $tacheRepository, EntityManagerInterface $em, int $id): Response
    {
//        $form = $this->createForm(TacheType::class, $tache);
//        $form->handleRequest($request);
//
//        if ($form->isSubmitted() && $form->isValid()) {
//            $this->getDoctrine()->getManager()->flush();
//
//            return $this->redirectToRoute('tache_index', [], Response::HTTP_SEE_OTHER);
//        }

        $tacheEdit = $tacheRepository->find($id);

        if (@$request->request->get('libelle') && $tacheEdit){
            $tacheEdit->setLibelle($request->request->get('libelle'));
            $em->persist($tache);
            $em->flush();
            $tacheArray = $tacheRepository->find0neAsArray($tacheEdit->getId());

            return new JsonResponse($tacheArray);
        }


        return $this->renderForm('tache/edit.html.twig', [
            'tache' => $tache,
//            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'tache_delete', methods: ['POST'])]
    public function delete(Request $request, Tache $tache): Response
    {
        if ($this->isCsrfTokenValid('delete'.$tache->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($tache);
            $entityManager->flush();
        }

        return $this->redirectToRoute('tache_index', [], Response::HTTP_SEE_OTHER);
    }
}
