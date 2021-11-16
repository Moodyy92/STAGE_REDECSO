<?php

namespace App\Controller;

use App\Entity\Categorie;
use App\Form\CategorieType;
use App\Repository\CategorieRepository;
use App\Repository\DevisRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/categorie')]
class CategorieController extends AbstractController
{
    #[Route('/', name: 'categorie_index', methods: ['GET'])]
    public function index(CategorieRepository $categorieRepository): Response
    {
        return $this->render('categorie/index.html.twig', [
            'categories' => $categorieRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'categorie_new', methods: ['GET', 'POST'])]
    public function new(Request $request): Response
    {
        $categorie = new Categorie();
        $categorieForm = $this->createForm(CategorieType::class, $categorie,[
            'action'=>$this->generateUrl('categorie_new')
        ]);
        $categorieForm->handleRequest($request);

        if ($categorieForm->isSubmitted() && $categorieForm->isValid()) {

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($categorie);
            $entityManager->flush();

            $devis_id = $request->request->get('categorie_devis_id');

            $devis = $devisRepository->find($devis_id);
            $categorie->addDevi($devis);
            $entityManager->persist($categorie);
            $entityManager->flush();

            $categorie_array = $categorieRepository->findOneAsArray($categorie->getId());

            return new JsonResponse($categorie_array);
        }

        return $this->renderForm('categorie/_form.html.twig', [
            'categorie' => $categorie,
            'categorieForm' => $categorieForm,
        ]);
    }

    #[Route('/{id}', name: 'categorie_show', methods: ['GET'])]
    public function show(Categorie $categorie): Response
    {
        return $this->render('categorie/show.html.twig', [
            'categorie' => $categorie,
        ]);
    }

    #[Route('/{id}/edit', name: 'categorie_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, int $id, CategorieRepository $categorieRepository, EntityManagerInterface $em ): Response
    {
        $categorie = $categorieRepository->find($id);

        if (@$request->request->get('libelle') && $categorie){
            $categorie->setLibelle($request->request->get('libelle'));
            $em->persist($categorie);
            $em->flush();
            $categorieArray = $categorieRepository->findOneAsArray($categorie->getId());

            return new JsonResponse($categorieArray);
        }

        return $this->renderForm('categorie/edit.html.twig', [
            'categorie' => $categorie,
        ]);
    }

    #[Route('/{id}', name: 'categorie_delete', methods: ['POST'])]
    public function delete(Request $request, Categorie $categorie): Response
    {
        if ($this->isCsrfTokenValid('delete'.$categorie->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($categorie);
            $entityManager->flush();
        }

        return $this->redirectToRoute('categorie_index', [], Response::HTTP_SEE_OTHER);
    }
}
