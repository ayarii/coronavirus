<?php

namespace App\Controller;

use App\Entity\Voluntary;
use App\Repository\VoluntaryRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index()
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    /**
     * @Route("/admin/dashboard", name="dashboard")
     */
    public function dashboard()
    {
        return $this->render('home/dashboard.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    /**
     * @Route("/admin/map", name="map")
     */
    public function map()
    {
        return $this->render('home/map.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    /**
     * @Route("/volunteers", name="volunteers", methods={"GET"})
     */
    public function volunteers(Request $request, PaginatorInterface $paginator)
    {
        $voluntaryRepository = $this->getDoctrine()->getRepository(Voluntary::class)->findAll();
        $entites = $paginator->paginate(
            $voluntaryRepository, // Requête contenant les données à paginer (ici nos articles)
            $request->query->getInt('page', 1), // Numéro de la page en cours, passé dans l'URL, 1 si aucune page
            2 // Nombre de résultats par page
        );
        return $this->render('voluntary/volunteers.html.twig', [
            'volunteers' => $entites,
        ]);
    }
}
