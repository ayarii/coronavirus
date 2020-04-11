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
     * @Route("/hospital/dashboard", name="dashboard")
     */
    public function dashboard()
    {
        $volunteers = $this->getDoctrine()->getRepository('App:Volunteer')->findAll();
        $testByMen = $this->getDoctrine()->getRepository("App:Information")->findByGender("men");
        $testByWomen = $this->getDoctrine()->getRepository("App:Information")->findByGender("women");
        $tests= $this->getDoctrine()->getRepository("App:Information")->testByDay();
        $url = "https://api.kawalcorona.com/";
        $client = HttpClient::create();
        $response = $client->request('GET', $url);
        $results = json_decode($response->getContent(), true);
        return $this->render('dashboard/dashboard.html.twig', [
            'results' => $results,
            'voluntaries' => $volunteers,
            'testByMen' => $testByMen,
            'testByWomen' => $testByWomen,
            'test'=>$tests
        ]);
    }

    /**
     * @Route("/admin/notification", name="notification")
     */
    public function notification()
    {
        return $this->render("dashboard/notification.html.twig");
    }
}
