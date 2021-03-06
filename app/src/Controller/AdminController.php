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
 * @Route("/admin")
 *
 * @IsGranted("ROLE_ADMIN")
 *
 */
class AdminController extends AbstractController
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
     *     name="admin_index",
     * )
     *
     * @IsGranted("ROLE_ADMIN")
     *
     */
    public function index(Request $request, PrzepisyRepository $repository, PaginatorInterface $paginator): Response
    {

        return $this->render(
            'admin/index.html.twig'
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
     *     "/usuwaniePrzepisu",
     *     name="przepis_admin_delete",
     * )
     *
     * @IsGranted("ROLE_ADMIN")
     *
     */
    public function delete(Request $request, Przepisy $przepisy, PrzepisyRepository $repository): Response
    {

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
            'admin/delete.html.twig',
            [
                'form' => $form->createView(),
                'przepis' => $przepisy
            ]
        );
    }

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
     *     "/przepisyAdmin",
     *     name="przepisy_admin",
     * )
     *
     *
     */
    public function przepisyAdmin(Request $request, PrzepisyRepository $repository, PaginatorInterface $paginator): Response
    {
        $pagination = $paginator->paginate(
            $repository->queryAll(),
            $request->query->getInt('page', 1),
            Przepisy::NUMBER_OF_ITEMS
        );

        return $this->render(
            'admin/showPrzepisy.html.twig',
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
     *     name="przepis_view_admin",
     *     requirements={"id": "[1-9]\d*"},
     * )
     *
     * @IsGranted(
     *     "ROLE_ADMIN",
     *     subject="przepisy",
     *     message="You can not view"
     * )
     *
     */
    public function view(Przepisy $przepisy): Response
    {

        $przepis = $this->getDoctrine()
            ->getRepository(Przepisy::class)
            ->find($przepisy);


        $autor = $przepis->getAutor()->getImie();
        $tytul = $przepis->getTytul();

        $nazwaKategorii = $przepis->getKategoria()->getNazwaKategorii();


        return $this->render(
            'admin/view.html.twig',
            ['przepis' => $przepis, 'autor' => $autor, 'tytul' => $tytul,  'nazwaKategorii' => $nazwaKategorii]
        );

    }

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
     *     "/userAdmin",
     *     name="users_admin",
     * )
     *
     *
     */
    public function showUser(Request $request, UserRepository $repository, PaginatorInterface $paginator): Response
    {
        $pagination = $paginator->paginate(
            $repository->queryAll(),
            $request->query->getInt('page', 1),
            Przepisy::NUMBER_OF_ITEMS
        );

        return $this->render(
            'admin/showUser.html.twig',
            ['pagination' => $pagination]
        );
    }

    /**
     * Delete action.
     *
     * @param \Symfony\Component\HttpFoundation\Request $request    HTTP request
     * @param \App\Entity\User                         $przepis       Przepisy entity
     * @param \App\Repository\UserRepository            $repository Przepisy repository
     *
     * @return \Symfony\Component\HttpFoundation\Response HTTP response
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     *
     * @Route(
     *     "/{id}/deleteUser",
     *     methods={"GET", "DELETE"},
     *     requirements={"id": "[1-9]\d*"},
     *     name="user_delete",
     * )
     *
     * @IsGranted(
     *     "ROLE_ADMIN",
     *     message="You can not delete"
     * )
     *
     *
     */
    public function deleteUser(Request $request, User $user, UserRepository $repository): Response
    {
        $form = $this->createForm(FormType::class, $user, ['method' => 'DELETE']);
        $form->handleRequest($request);

        if ($request->isMethod('DELETE') && !$form->isSubmitted()) {
            $form->submit($request->request->get($form->getName()));
        }

        if ($form->isSubmitted() && $form->isValid()) {

            $repository->delete($user);
            $this->addFlash('success', 'message.deleted_successfully');

            return $this->redirectToRoute('users_admin');
        }

        return $this->render(
            'admin/deleteUser.html.twig',
            [
                'form' => $form->createView(),
                'user' => $user
            ]
        );
    }

    /**
     * Add Admin action.
     *
     * @param \Symfony\Component\HttpFoundation\Request $request    HTTP request
     * @param \App\Entity\User                         $przepis       Przepisy entity
     * @param \App\Repository\UserRepository            $repository Przepisy repository
     *
     * @return \Symfony\Component\HttpFoundation\Response HTTP response
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     *
     * @Route(
     *     "/{id}/AddAdmin",
     *     methods={"GET", "PUT"},
     *     requirements={"id": "[1-9]\d*"},
     *     name="add_admin",
     * )
     *
     * @IsGranted(
     *     "ROLE_ADMIN",
     *     message="You can not delete"
     * )
     *
     *
     */
    public function AddAdmin(Request $request, User $user, UserRepository $repository): Response
    {
        $form = $this->createForm(FormType::class, $user, ['method' => 'PUT']);
        $form->handleRequest($request);

        if ($request->isMethod('PUT') && !$form->isSubmitted()) {
            $form->submit($request->request->get($form->getName()));
        }

        if ($form->isSubmitted() && $form->isValid()) {

            $user->setRoles(['ROLE_USER', 'ROLE_ADMIN']);
            $repository->save($user);
            $this->addFlash('success', 'message.add_Admin_successfully');

            return $this->redirectToRoute('users_admin');
        }

        return $this->render(
            'admin/AddAdmin.html.twig',
            [
                'form' => $form->createView(),
                'user' => $user
            ]
        );
    }
}