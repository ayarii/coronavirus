<?php

namespace App\Controller;

use App\Entity\Voluntary;
use App\Form\VoluntaryType;
use App\Repository\VoluntaryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/voluntary")
 */
class VoluntaryController extends AbstractController
{
    /**
     * @Route("/", name="voluntary_index", methods={"GET"})
     */
    public function index(VoluntaryRepository $voluntaryRepository): Response
    {
        return $this->render('voluntary/index.html.twig', [
            'voluntaries' => $voluntaryRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="voluntary_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $voluntary = new Voluntary();
        $form = $this->createForm(VoluntaryType::class, $voluntary);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($voluntary);
            $entityManager->flush();

            return $this->redirectToRoute('voluntary_index');
        }

        return $this->render('voluntary/new.html.twig', [
            'voluntary' => $voluntary,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="voluntary_show", methods={"GET"})
     */
    public function show(Voluntary $voluntary): Response
    {
        return $this->render('voluntary/show.html.twig', [
            'voluntary' => $voluntary,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="voluntary_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Voluntary $voluntary): Response
    {
        $form = $this->createForm(VoluntaryType::class, $voluntary);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('voluntary_index');
        }

        return $this->render('voluntary/edit.html.twig', [
            'voluntary' => $voluntary,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="voluntary_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Voluntary $voluntary): Response
    {
        if ($this->isCsrfTokenValid('delete'.$voluntary->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($voluntary);
            $entityManager->flush();
        }

        return $this->redirectToRoute('voluntary_index');
    }
}
