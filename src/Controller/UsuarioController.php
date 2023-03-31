<?php

namespace App\Controller;

use App\Entity\Usuario;
use App\Form\UsuarioType;
use App\Repository\UsuarioRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\String\Slugger\SluggerInterface;

#[Route('/usuario')]
class UsuarioController extends AbstractController
{
    #[Route('/', name: 'app_usuario_index', methods: ['GET'])]
    public function index(UsuarioRepository $usuarioRepository): Response
    {
        return $this->render('usuario/index.html.twig', [
            'usuarios' => $usuarioRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_usuario_new', methods: ['GET', 'POST'])]
    public function new(Request $request, SluggerInterface $slugger, UsuarioRepository $usuarioRepository): Response
    {
        $usuario = new Usuario();
        $form = $this->createForm(UsuarioType::class, $usuario);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            /** @var UploadedFile $brochureFile */
            $fotoFile = $form->get('foto')->getData();
            // dump($form);
            // dump($form->get('foto'));
            // dump($form->get('foto'))->getData();
            //  $usuarioRepository->save($usuario, true);
            
            // this condition is needed because the 'brochure' field is not required
            // so the PDF file must be processed only when a file is uploaded
            if ($fotoFile) {
                $originalFilename = pathinfo($fotoFile->getClientOriginalName(), PATHINFO_FILENAME);
                // this is needed to safely include the file name as part of the URL
                $safeFilename = $slugger->slug($originalFilename);
                
                $newFilename = $safeFilename.'-'.uniqid().'.'.$fotoFile->guessExtension();

                // Move the file to the directory where brochures are stored
                try {
                    $fotoFile->move(
                        $this->getParameter('foto_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    throw new \Exception (message: 'UPs! ha courrido un error, sorry');
                    // ... handle exception if something happens during file upload
                }

                // updates the 'brochureFilename' property to store the PDF file name
                // instead of its contents
                $usuario->setFoto($newFilename);
                // dump($usuario);
                // die;
            }

            $usuarioRepository->save($usuario, true);
            // ... persist the $product variable or any other work

            return $this->redirectToRoute('app_usuario_index', [], Response::HTTP_SEE_OTHER);
        }
        return $this->renderForm('usuario/new.html.twig', [
            'usuario' => $usuario,
            'form' => $form,
        ]);
    }


    #[Route('/{id}', name: 'app_usuario_show', methods: ['GET'])]
    public function show(Usuario $usuario): Response
    {
        return $this->render('usuario/show.html.twig', [
            'usuario' => $usuario,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_usuario_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Usuario $usuario, UsuarioRepository $usuarioRepository): Response
    {
        $form = $this->createForm(UsuarioType::class, $usuario);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $usuarioRepository->save($usuario, true);

            return $this->redirectToRoute('app_usuario_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('usuario/edit.html.twig', [
            'usuario' => $usuario,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_usuario_delete', methods: ['POST'])]
    public function delete(Request $request, Usuario $usuario, UsuarioRepository $usuarioRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$usuario->getId(), $request->request->get('_token'))) {
            $usuarioRepository->remove($usuario, true);
        }

        return $this->redirectToRoute('app_usuario_index', [], Response::HTTP_SEE_OTHER);
    }
}
