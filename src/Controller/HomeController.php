<?php

namespace App\Controller;

use App\Entity\Volunteer;
use App\Repository\VolunteerRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index()
    {
        return $this->render('index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    /**
     * @Route("/volunteers", name="volunteers", methods={"GET"})
     */
    public function volunteers(Request $request, PaginatorInterface $paginator)
    {
        $name = $request->query->get("country");
        if ($name!="") {
            $volunteers = $this->getDoctrine()->getRepository(Volunteer::class)->findBy(
                ['country' => $name]
            );
            
        }
        else {
        $volunteers = $this->getDoctrine()->getRepository(Volunteer::class)->findAll();
        }
        
        $entites = $paginator->paginate(
            $volunteers, // Requête contenant les données à paginer (ici nos articles)
            $request->query->getInt('page', 1), // Numéro de la page en cours, passé dans l'URL, 1 si aucune page
            5 // Nombre de résultats par page
        );
        return $this->render('Volunteer/volunteers.html.twig', [
            'volunteers' => $entites,
        ]);
    }
}
