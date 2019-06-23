<?php
/**
 * Task controller.
 */

namespace App\Controller;

use App\Entity\Przepisy;
use App\Entity\Skladniki;
use App\Entity\Uzytkownicy;
use App\Entity\User;
use App\Entity\PrzepisySkladniki;
use App\Form\PrzepisyType;
use App\Repository\PrzepisyRepository;
use App\Repository\PrzepisySkladnikiRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\DBAL\Types\TextType;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\PropertyAccess\PropertyAccess;



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
//        $przepisy = $entityManager->getRepository(Przepisy::class)->find($id);
//        foreach ($przepisy as $skladniki) {
//            $skladniki = new Skladniki();
//            var_dump($przepisy->getSkladnik());
//            $skladniki->setNazwa($przepisy->getSkladnik());
//            $przepisy->getSkladnik()->add($skladniki->getNazwa());
//        }


//        $tag1 = new Skladniki();
//        $tag1->setNazwa('tag1');
//        $przepisy->getSkladnik()->add($tag1);
//        $tag2 = new Skladniki();
//        $tag2->setNazwa('tag2');
//        $przepisy->getSkladnik()->add($tag2);

        $form = $this->createForm(PrzepisyType::class, $przepisy);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $przepisy->setAutor($this->getUser()->getUzytkownicy());
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
     * @param \App\Repository\PrzepisyRepository            $repository Przepis repository
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
        if ($przepisy->getAutor() !== $this->getUser()->getUzytkownicy()) {
            $this->addFlash('warning', 'message.item_not_found');

            return $this->redirectToRoute('stronaglowna_index');
        }

        $originalSkladniki = new ArrayCollection();

        foreach ($przepisy->getSkladnik() as $skladnik) {
            $originalSkladniki->add($skladnik);
        }
        $form = $this->createForm(PrzepisyType::class, $przepisy, ['method' => 'PUT']);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $repository->save($przepisy);

            $this->addFlash('success', 'message.updated_successfully');

            return $this->redirectToRoute('stronaglowna_index');
        }

        return $this->render(
            'przepis/editData.html.twig',
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
     * @param \App\Entity\Przepisy                          $przepis       Przepisy entity
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
    public function delete(Request $request, Przepisy $przepisy, PrzepisyRepository $repository): Response
    {
        if ($przepisy->getAutor() !== $this->getUser()->getUzytkownicy() ) {
            $this->addFlash('warning', 'message.item_not_found');

            return $this->redirectToRoute('stronaglowna_index');
        }
        $form = $this->createForm(FormType::class, $przepisy, ['method' => 'DELETE']);
        $form->handleRequest($request);

        if ($request->isMethod('DELETE') && !$form->isSubmitted()) {
            $form->submit($request->request->get($form->getName()));
        }

        if ($form->isSubmitted() && $form->isValid()) {

            $repository->delete($przepisy);
            $this->addFlash('success', 'message.deleted_successfully');

            return $this->redirectToRoute('stronaglowna_index');
        }

        return $this->render(
            'przepis/delete.html.twig',
            [
                'form' => $form->createView(),
                'przepis' => $przepisy
            ]
        );
    }


}