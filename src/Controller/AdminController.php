<?php

namespace App\Controller;

use App\Entity\Answerchoice;
use App\Entity\Level;
use App\Entity\Option;
use App\Entity\Question;
use App\Form\QuestionType;
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
     * @Route("/questions", name="question_list")
     */
    public function questions(Request $request)
    {
        $questions = $this->getDoctrine()->getRepository(Question::class)->findAll();

        return $this->render('admin/question/list.html.twig', ['questions' => $questions]);
    }

    /**
     * @Route("/question/new", name="question_new")
     */
    public function newQuestion(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $question = new Question();

        $form = $this->createForm(QuestionType::class, $question);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            /** @var Question $question */
            $question = $form->getData();
            $em->persist($question);
            $em->flush();

            return $this->redirectToRoute("adminquestion_list");
        }

        return $this->render('admin/question/new.html.twig', ['form' => $form->createView()]);
    }

    /**
     * @Route("/question/edit/{id}", name="question_edit")
     */
    public function editQuestion(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $question = $this->getDoctrine()->getRepository(Question::class)->find($id);

        $form = $this->createForm(QuestionType::class, $question);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $em->flush();

            return $this->redirectToRoute("adminquestion_list");
        }

        return $this->render('admin/question/new.html.twig', ['form' => $form->createView()]);
    }

    /**
     * @Route("/question/delete/{id}", name="question_delete")
     */
    public function deleteQuestion($id)
    {
        $question = $this->getDoctrine()->getRepository(Question::class)->find($id);
        $em = $this->getDoctrine()->getManager();
        $em->remove($question);
        $em->flush();

        return $this->redirectToRoute("adminquestion_list");
    }
}
