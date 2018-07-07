<?php

namespace App\Controller;

use App\Entity\Level;
use App\Entity\Question;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * @Route("/admin", name="admin")
 */
class AdminController extends Controller
{
    /**
     * @Route("/", name="index")
     */
    public function index()
    {
        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }

    /**
     * @Route("/init-level", name="init-level")
     */
    public function initLevel()
    {
        $levelList = ['débutant', 'intermédiaire', 'avancé'];
        $em = $this->getDoctrine()->getManager();

        foreach ($levelList as $levelName) {
            $level = new Level();
            $level->setName($levelName);
            $em->persist($level);
            $em->flush();
        }

        return new JsonResponse(['initLevel' => 'ok']);
    }

    /**
     * @Route("/questions", name="question_list")
     */
    public function questions(Request $request)
    {
        $questions = $this->getDoctrine()->getRepository(Question::class)->findAll();
    }
}
