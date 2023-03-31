<?php

namespace App\Controller;

use App\Entity\Calendario;
use App\Form\CalendarioType;
use App\Repository\CalendarioRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/calendario')]
class CalendarioController extends AbstractController
{
    #[Route('/', name: 'app_calendario_index', methods: ['GET'])]
    public function index(CalendarioRepository $calendarioRepository): Response
    {
        return $this->render('calendario/index.html.twig', [
            'calendarios' => $calendarioRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_calendario_new', methods: ['GET', 'POST'])]
    public function new(Request $request, CalendarioRepository $calendarioRepository): Response
    {
        $calendario = new Calendario();
        $form = $this->createForm(CalendarioType::class, $calendario);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $calendarioRepository->save($calendario, true);

            return $this->redirectToRoute('app_calendario_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('calendario/new.html.twig', [
            'calendario' => $calendario,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_calendario_show', methods: ['GET'])]
    public function show(Calendario $calendario): Response
    {
        return $this->render('calendario/show.html.twig', [
            'calendario' => $calendario,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_calendario_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Calendario $calendario, CalendarioRepository $calendarioRepository): Response
    {
        $form = $this->createForm(CalendarioType::class, $calendario);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $calendarioRepository->save($calendario, true);

            return $this->redirectToRoute('app_calendario_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('calendario/edit.html.twig', [
            'calendario' => $calendario,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_calendario_delete', methods: ['POST'])]
    public function delete(Request $request, Calendario $calendario, CalendarioRepository $calendarioRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$calendario->getId(), $request->request->get('_token'))) {
            $calendarioRepository->remove($calendario, true);
        }

        return $this->redirectToRoute('app_calendario_index', [], Response::HTTP_SEE_OTHER);
    }
}
