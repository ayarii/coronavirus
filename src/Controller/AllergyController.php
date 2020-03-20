<?php

namespace App\Controller;

use App\Entity\Allergy;
use App\Form\AllergyType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/allergy")
 */
class AllergyController extends AbstractController
{
    /**
     * @Route("/", name="allergy_index", methods={"GET"})
     */
    public function index(): Response
    {
        $allergies = $this->getDoctrine()
            ->getRepository(Allergy::class)
            ->findAll();

        return $this->render('allergy/index.html.twig', [
            'allergies' => $allergies,
        ]);
    }

    /**
     * @Route("/new", name="allergy_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $allergy = new Allergy();
        $form = $this->createForm(AllergyType::class, $allergy);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($allergy);
            $entityManager->flush();

            return $this->redirectToRoute('allergy_index');
        }

        return $this->render('allergy/new.html.twig', [
            'allergy' => $allergy,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="allergy_show", methods={"GET"})
     */
    public function show(Allergy $allergy): Response
    {
        return $this->render('allergy/show.html.twig', [
            'allergy' => $allergy,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="allergy_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Allergy $allergy): Response
    {
        $form = $this->createForm(AllergyType::class, $allergy);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('allergy_index');
        }

        return $this->render('allergy/edit.html.twig', [
            'allergy' => $allergy,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="allergy_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Allergy $allergy): Response
    {
        if ($this->isCsrfTokenValid('delete'.$allergy->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($allergy);
            $entityManager->flush();
        }

        return $this->redirectToRoute('allergy_index');
    }
}
