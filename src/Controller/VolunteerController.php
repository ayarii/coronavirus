<?php

namespace App\Controller;

use App\Entity\Volunteer;
use App\Form\VolunteerType;
use App\Repository\VolunteerRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Omines\DataTablesBundle\Column\TextColumn;
use Omines\DataTablesBundle\DataTableFactory;
use Omines\DataTablesBundle\Adapter\Doctrine\ORMAdapter;

/**
 * @Route("/admin/volunteer")
 */
class VolunteerController extends AbstractController
{

     /**
     * @Route("/", name="Volunteer_All")
     */
    public function showVolunteers(Request $request, DataTableFactory $dataTableFactory): Response
    {
        $table = $dataTableFactory->create()
                    ->add('firstName', TextColumn::class, ['label' => 'First Name', 'searchable' => true, 'className' => 'bold'])
                    ->add('lastName', TextColumn::class, ['label' => 'LastName', 'searchable' => true, 'className' => 'bold'])
                    ->add('country', TextColumn::class, ['label' => 'Country', 'searchable' => true, 'className' => 'bold'])
                    ->add('phoneNumber', TextColumn::class, ['label' => 'PhoneNumber', 'searchable' => true, 'className' => 'bold'])
                    ->add('picture', TextColumn::class, ['label' => 'Picture', 'searchable' => true, 'className' => 'bold'])
                    ->add('specialty', TextColumn::class, ['label' => 'Specialty', 'searchable' => true, 'field' => 'specialty.name', 'className' => 'bold'])
                    ->add('id', TextColumn::class, ['label' => 'Actions', 'orderable' => false, 'searchable' => false,
                        'render' => function($id, $context) {
                        return sprintf('<a href="%s"class="btn btn-outline-dark dataTableLink">Modifiy</a><a href="%s"class="btn btn-outline-dark dataTableLink">Delete</a>',
                                $this->generateUrl('Volunteer_edit', ['id' => $id]), $this->generateUrl('Volunteer_delete', ['id' => $id])
                            );
                        }])
                    ->createAdapter(ORMAdapter::class, [
                        'entity' => Volunteer::class,
                    ])
                    ->handleRequest($request);

        if ($table->isCallback()) {
            return $table->getResponse();
        }

        return $this->render('Volunteer/index1.html.twig', [
            'datatable' => $table,
        ]);
    }

    /**
     * @Route("/list", name="Volunteer_index", methods={"GET"})
     */
    public function index(Request $request,VolunteerRepository $VolunteerRepository): Response
    {
        
        $name = $request->query->get("country");
        if ($name!="") {
            $volunteers = $VolunteerRepository->findBy(
                ['country' => $name]
            );
            return $this->render('Volunteer/index.html.twig', [
                'voluntaries' => $volunteers,
                'country' => $name,
            ]);
        }
        else {
        return $this->render('Volunteer/index.html.twig', [
            'voluntaries' => $VolunteerRepository->findAll(),
            'country' => $name,
        ]);
        }
        
    }

    /**
     * @Route("/new", name="Volunteer_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $Volunteer = new Volunteer();
        $form = $this->createForm(VolunteerType::class, $Volunteer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $file = $Volunteer->getPicture(); 
            // $fileName = $this->generateUniqueFileName().'.'.$file->guessExtension();
            $fileName = md5(uniqid()).'.'.$file->guessExtension();
            // moves the file to the directory where brochures are stored
            $file->move($this->getParameter('pictures_directory'), $fileName);
            $Volunteer->setPicture($fileName);
            $entityManager->persist($Volunteer);
            $entityManager->flush();
            return $this->redirectToRoute('Volunteer_All');
        }

        return $this->render('Volunteer/new.html.twig', [
            'Volunteer' => $Volunteer,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="Volunteer_show", methods={"GET"})
     */
    public function show(Volunteer $Volunteer): Response
    {
        return $this->render('Volunteer/show.html.twig', [
            'Volunteer' => $Volunteer,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="Volunteer_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Volunteer $Volunteer): Response
    {
        $form = $this->createForm(VolunteerType::class, $Volunteer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $file = $Volunteer->getPicture();
            // $fileName = $this->generateUniqueFileName().'.'.$file->guessExtension();
            $fileName = md5(uniqid()).'.'.$file->guessExtension();
            // moves the file to the directory where brochures are stored
            $file->move($this->getParameter('pictures_directory'), $fileName);
            $Volunteer->setPicture($fileName);
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('Volunteer_All');
        }

        return $this->render('Volunteer/edit.html.twig', [
            'Volunteer' => $Volunteer,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="Volunteer_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Volunteer $Volunteer): Response
    {
        if ($this->isCsrfTokenValid('delete'.$Volunteer->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($Volunteer);
            $entityManager->flush();
        }

        return $this->redirectToRoute('Volunteer_All');
    }

    /**
     * @return string
     */
    private function generateUniqueFileName()
    {
        // md5() reduces the similarity of the file names generated by
        // uniqid(), which is based on timestamps
        return md5(uniqid());
    }
}
