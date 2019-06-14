<?php
/**
 * Task controller.
 */

namespace App\Controller;

use App\Entity\Przepisy;
use App\Entity\PrzepisySkladniki;
use App\Form\PrzepisyType;
use App\Repository\PrzepisyRepository;
use App\Repository\PrzepisySkladnikiRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class PrzepisController.
 *
 * @Route("/przepis")
 */
class PrzepisController extends AbstractController
{

    /**
     * New action.
     *
     * @param \Symfony\Component\HttpFoundation\Request $request    HTTP request
     * @param \App\Repository\PrzepisyRepository           $repository Task repository
     *
     * @return \Symfony\Component\HttpFoundation\Response HTTP response
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     *
     * @Route(
     *     "/new",
     *     methods={"GET", "POST"},
     *     name="przepis_new",
     * )
     */
    public function new(Request $request, PrzepisyRepository $repository): Response
    {
        $przepisy = new Przepisy();
        $form = $this->createForm(PrzepisyType::class, $przepisy);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $repository->save($przepisy);

            $this->addFlash('success', 'message.created_successfully');

            return $this->redirectToRoute('stronaglowna_index');
        }

        return $this->render(
            'przepis/new.html.twig',
            ['form' => $form->createView()]
        );
    }

    /**
     * Edit action.
     *
     * @param \Symfony\Component\HttpFoundation\Request $request    HTTP request
     * @param \App\Entity\Przepisy                          $przepisy       Przepis entity
     * @param \App\Repository\PrzepisyRepository            $repository Przepisy repository
     *
     * @return \Symfony\Component\HttpFoundation\Response HTTP response
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     *
     * @Route(
     *     "/{id}/edit",
     *     methods={"GET", "PUT"},
     *     requirements={"id": "[1-9]\d*"},
     *     name="przepis_edit",
     * )
     */
    public function edit(Request $request, Przepisy $przepisy, PrzepisyRepository $repository): Response
    {
        $form = $this->createForm(PrzepisyType::class, $przepisy, ['method' => 'PUT']);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $repository->save($przepisy);

            $this->addFlash('success', 'message.updated_successfully');

            return $this->redirectToRoute('stronaglowna_index');
        }

        return $this->render(
            'przepis/edit.html.twig',
            [
                'form' => $form->createView(),
                'przepis' => $przepisy,
            ]
        );
    }

    /**
     * Delete action.
     *
     * @param \Symfony\Component\HttpFoundation\Request $request    HTTP request
     * @param \App\Entity\Przepisy                          $przepisy       Przepisy entity
     * @param \App\Repository\PrzepisyRepository            $repository Przepisy repository
     *
     * @return \Symfony\Component\HttpFoundation\Response HTTP response
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     *
     * @Route(
     *     "/{id}/delete",
     *     methods={"GET", "DELETE"},
     *     requirements={"id": "[1-9]\d*"},
     *     name="przepis_delete",
     * )
     */
    public function delete(Request $request, Przepisy $przepisy, PrzepisyRepository $repository, PrzepisySkladniki $przepisySkladniki, PrzepisySkladnikiRepository $przepisySkladnikiRepository): Response
    {

        $form = $this->createForm(FormType::class, $przepisy, ['method' => 'DELETE']);
        $form->handleRequest($request);

        if ($request->isMethod('DELETE') && !$form->isSubmitted()) {
            $form->submit($request->request->get($form->getName()));
        }
//zle
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $przepisy = $entityManager->getRepository(Przepisy::class)->find($request);
            $repository->delete($przepisy);
            $przepisySkladnikiRepository->delete($przepisy);
            $this->addFlash('success', 'message.deleted_successfully');

            return $this->redirectToRoute('stronaglowna_index');
        }

        return $this->render(
            'przepis/delete.html.twig',
            [
                'form' => $form->createView(),
                'przepis' => $przepisy,
            ]
        );
    }
}