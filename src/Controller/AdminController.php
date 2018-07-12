<?php

namespace App\Controller;

use App\Entity\Answerchoice;
use App\Entity\Candidate;
use App\Entity\Level;
use App\Entity\Option;
use App\Entity\Question;
use App\Form\CandidateType;
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

    /**
     * @Route("/candidates", name="candidate_list")
     */
    public function candidates()
    {
        $candidates = $this->getDoctrine()->getRepository(Candidate::class)->findAll();

        return $this->render('admin/candidate/list.html.twig', ['candidates' => $candidates]);
    }

    /**
     * @Route("/candidate/new", name="candidate_new")
     */
    public function newCandidate(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $candidate = new Candidate();

        $form = $this->createForm(CandidateType::class, $candidate);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            /** @var Candidate $question */
            $candidate = $form->getData();
            $em->persist($candidate);
            $em->flush();

            return $this->redirectToRoute("admincandidate_list");
        }

        return $this->render('admin/candidate/edit.html.twig', ['form' => $form->createView()]);

    }

    /**
     * @Route("/candidate/edit/{id}", name="candidate_edit")
     * @param Request $request
     * @param         $id
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     */
    public function editCandidate(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $candidate = $this->getDoctrine()->getRepository(Candidate::class)->find($id);

        $form = $this->createForm(CandidateType::class, $candidate);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $em->flush();

            return $this->redirectToRoute("admincandidate_list");
        }

        return $this->render('admin/candidate/edit.html.twig', ['form' => $form->createView()]);
    }

    /**
     * @Route("/candidate/delete/{id}", name="candidate_delete")
     * @param $id
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function deleteCandidate($id)
    {
        $candidate = $this->getDoctrine()->getRepository(Candidate::class)->find($id);
        $em = $this->getDoctrine()->getManager();
        $em->remove($candidate);
        $em->flush();

        return $this->redirectToRoute("admincandidate_list");
    }
}
