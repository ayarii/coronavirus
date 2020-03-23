<?php

namespace App\Controller;

use App\Entity\Sickness;
use App\Form\SicknessType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/sickness")
 */
class SicknessController extends AbstractController
{
    /**
     * @Route("/", name="sickness_index", methods={"GET"})
     */
    public function index(): Response
    {
        $sicknesses = $this->getDoctrine()
            ->getRepository(Sickness::class)
            ->getall();

        return $this->render('sickness/index.html.twig', [
            'sicknesses' => $sicknesses,
        ]);
    }

    /**
     * @Route("/new", name="sickness_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $sickness = new Sickness();
        $form = $this->createForm(SicknessType::class, $sickness);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($sickness);
            $entityManager->flush();
            return $this->redirectToRoute('sickness_index');
        }

        return $this->render('sickness/new.html.twig', [
            'sickness' => $sickness,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="sickness_show", methods={"GET"})
     */
    public function show(Sickness $sickness): Response
    {
        return $this->render('sickness/show.html.twig', [
            'sickness' => $sickness,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="sickness_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Sickness $sickness): Response
    {
        $form = $this->createForm(SicknessType::class, $sickness);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('sickness_index');
        }

        return $this->render('sickness/edit.html.twig', [
            'sickness' => $sickness,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="sickness_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Sickness $sickness): Response
    {
        if ($this->isCsrfTokenValid('delete'.$sickness->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($sickness);
            $entityManager->flush();
        }
        return $this->redirectToRoute('sickness_index');
    }
}
