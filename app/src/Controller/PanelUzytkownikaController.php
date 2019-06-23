<?php
/**
 * Panel Uzytkownika controller.
 */

namespace App\Controller;

use App\Entity\Przepisy;
use App\Entity\Skladniki;
use App\Entity\Uzytkownicy;
use App\Entity\User;
use App\Entity\PrzepisySkladniki;
use App\Form\Model\ChangePassword;
use App\Form\PrzepisyType;
use App\Form\UzytkownicyType;
use App\Form\ZmianaHaslaType;
use App\Repository\UserRepository;
use App\Repository\PrzepisyRepository;
use App\Repository\PrzepisySkladnikiRepository;
use App\Repository\UzytkownicyRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\DBAL\Types\TextType;
use Knp\Component\Pager\PaginatorInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\PropertyAccess\PropertyAccess;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\Security;


/**
 * Class PanelUzytkownikaController.
 *
 * @Route("/profil")
 */
class PanelUzytkownikaController extends AbstractController
{

    /**
     * Index action.
     *
     * @param \Symfony\Component\HttpFoundation\Request $request    HTTP request
     * @param \App\Repository\PrzepisyRepository            $repository Repository
     * @param \Knp\Component\Pager\PaginatorInterface   $paginator  Paginator
     *
     * @return \Symfony\Component\HttpFoundation\Response HTTP response
     *
     * @Route(
     *     "/",
     *     name="profil_index",
     * )
     */
    public function index(Request $request, PrzepisyRepository $repository, PaginatorInterface $paginator): Response
    {
        $pagination = $paginator->paginate(
            $repository->queryAll(),
            $request->query->getInt('page', 1),
            Przepisy::NUMBER_OF_ITEMS
        );

        return $this->render(
            'panelUzytkownika/index.html.twig',
            ['pagination' => $pagination]
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

            return $this->redirectToRoute('przepis_view');
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
        if ($przepisy->getAutor() !== $this->getUser()->getUzytkownicy()) {
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

    /**
     * Preview action.
     *
     * @param \Symfony\Component\HttpFoundation\Request $request    HTTP request
     * @param \App\Repository\PrzepisyRepository            $repository Repository
     * @param \Knp\Component\Pager\PaginatorInterface   $paginator  Paginator
     *
     * @return \Symfony\Component\HttpFoundation\Response HTTP response
     *
     * @Route(
     *     "/mojprzepis",
     *     name="mojprzepis_preview",
     * )
     *
     *
     */
    public function preview(Request $request, PrzepisyRepository $repository, PaginatorInterface $paginator): Response
    {
        $pagination = null;

        if(!is_null($repository->queryByAuthor($this->getUser()->getUzytkownicy())))
        {
            $pagination = $paginator->paginate(
                $repository->queryByAuthor($this->getUser()->getUzytkownicy()),
                $request->query->getInt('page', 1),
                Przepisy::NUMBER_OF_ITEMS
            );
        }

        return $this->render(
            'panelUzytkownika/preview.html.twig',
            ['pagination' => $pagination]
        );
    }
    /**
     * View action.
     *
     * @param \App\Entity\Przepisy $przepis Przepis entity
     *
     *
     *
     * @return \Symfony\Component\HttpFoundation\Response HTTP response
     *
     * @Route(
     *     "/{id}",
     *     name="mojprzepis_view",
     *     requirements={"id": "[1-9]\d*"},
     * )
     *
     *
     *
     */
    public function view(Przepisy $przepisy): Response
    {

        $przepis = $this->getDoctrine()
            ->getRepository(Przepisy::class)
            ->find($przepisy);


        $autor = $przepis->getAutor()->getImie();

        return $this->render(
            'panelUzytkownika/view.html.twig',
            ['przepis' => $przepis, 'autor' => $autor]
        );

    }

    /**
     * View Data action.
     *
     * @param \App\Entity\User $user User
     * @param \App\Entity\User $user User
     * @param \Symfony\Component\HttpFoundation\Request $request    HTTP request
     * @param \App\Repository\UzytkownicyRepository            $repository Repository
     * @param \Knp\Component\Pager\PaginatorInterface   $paginator  Paginator
     *
     * @return \Symfony\Component\HttpFoundation\Response HTTP response
     *
     * @Route(
     *     "/mojedane",
     *     name="mojedane_view",
     * )
     *
     *
     */
    public function viewData(): Response
    {
        $uzytkownik = $this->getUser()->getUzytkownicy();
        return $this->render(
            'panelUzytkownika/viewDane.html.twig',
            [
                'uzytkownik' => $uzytkownik,
            ]
        );

    }

    /**
     * Edit Data action.
     *
     * @param \Symfony\Component\HttpFoundation\Request $request    HTTP request
     * @param \App\Entity\Uzytkownicy                         $przepisy       Przepis entity
     * @param \App\Repository\UzytkownicyRepository            $repository Przepis repository
     *
     * @return \Symfony\Component\HttpFoundation\Response HTTP response
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     *
     * @Route(
     *     "/editData",
     *     methods={"GET", "PUT"},
     *     name="data_edit",
     * )
     */
    public function editData(UzytkownicyRepository $repository, Request $request): Response
    {
        $uzytkownicy = $this->getUser()->getUzytkownicy();
        $form = $this->createForm(UzytkownicyType::class, $uzytkownicy, ['method' => 'PUT']);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $repository->save($uzytkownicy);

           $this->addFlash('success', 'message.updated_successfully');

            return $this->redirectToRoute('mojedane_view');
        }

        return $this->render(
            'panelUzytkownika/editData.html.twig',
            [
                'form' => $form->createView(),
                'uzytkownicy' => $uzytkownicy,
            ]
        );
    }

    /**
     * Change password action.
     *
     * @param \Symfony\Component\HttpFoundation\Request $request    HTTP request
     * @param \App\Repository\UserRepository $repository User repository
     * @param \Symfony\Component\Security\Core\Security $security Security
     * @param \Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface $passwordEncoder Password encoder
     *
     * @return \Symfony\Component\HttpFoundation\Response HTTP response
     *
     * @Route(
     *      "/zmiana_hasla",
     *      name="change_password",
     *      methods={"GET", "PUT"},
     * )
     *
     */
    public function zmianaHasla(Request $request, UserRepository $repository, Security $security, UserPasswordEncoderInterface $passwordEncoder)
    {
        $user = $security->getUser();
        $changePassword = new ChangePassword();
        $form = $this->createForm(ZmianaHaslaType::class, $changePassword, [ 'method' => 'PUT' ]);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $password = $passwordEncoder->encodePassword($user, $changePassword->getPassword());
            $user->setPassword($password);
            $repository->save($user);
            $this->addFlash('success', 'Change password');
            return $this->redirectToRoute('data_edit');
        }
        return $this->render(
            'panelUzytkownika/changePassword.html.twig',
            [
                'form' => $form->createView(),
            ]
        );
    }
}