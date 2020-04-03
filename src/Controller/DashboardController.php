<?php

namespace App\Controller;

use App\Entity\Volunteer;
use App\Repository\VolunteerRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractController
{
    /**
     * @Route("/admin/dashboard", name="dashboard")
     */
    public function dashboard()
    {
        $volunteers= $this->getDoctrine()->getRepository('App:Volunteer');
        $url = "https://api.kawalcorona.com/";
        $client = HttpClient::create();
        $response = $client->request('GET', $url);
        $results = json_decode($response->getContent(),true);

        return $this->render('dashboard/dashboard.html.twig', [
            'results'=>$results,
            'voluntaries' => $volunteers
        ]);
    }
}
