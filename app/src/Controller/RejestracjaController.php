<?php
namespace App\Controller;

use App\Entity\User;
use App\Entity\Uzytkownicy;
use App\Form\DaneType;
use App\Form\RejestracjaType;
use App\Controller\SecurityController;
use App\Form\UzytkownicyType;
use App\Repository\UserRepository;
use App\Repository\UzytkownicyRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


/**
 * Class RejestracjaController.
 *
 * @Route("/rejestracja")
 */
class RejestracjaController extends Controller
{
    /**
     * Register action
     *
     * @param \Symfony\Component\HttpFoundation\Request $request    HTTP request
     * @param \App\Repository\UserRepository            $repository Repository
     * @param \Knp\Component\Pager\PaginatorInterface   $paginator  Paginator
     *
     * @return \Symfony\Component\HttpFoundation\Response HTTP response
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     *
     * @Route("/",
     *     name="registration",
     *       methods={"GET", "POST"},
   * )
     */

        public function registerAction(Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {
        // 1) build the form
        $user = new User();
        $name = new Uzytkownicy();
        $user->getUzytkownicy()->add($name);

        $form = $this->createForm(RejestracjaType::class, $user);

        // 2) handle the submit (will only happen on POST)
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            // 3) Encode the password (you could also do this via Doctrine listener)
            $password = $passwordEncoder->encodePassword($user, $user->getPassword());
            $user->setPassword($password);
            $user->setRoles(['ROLE_USER']);
            $user->setUzytkownicy($name);

            // 4) save the User!
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            // ... do any other work - like sending them an email, etc
            // maybe set a "flash" success message for the user
            $this->addFlash('success', 'message.register_successfully');

            return $this->redirectToRoute('security_login');
        }

        return $this->render(
            'rejestracja/register.html.twig',
            ['form' => $form->createView()]
        );
    }

  }