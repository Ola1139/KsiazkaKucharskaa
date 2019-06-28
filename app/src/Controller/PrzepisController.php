<?php
/**
 * Task controller.
 */

namespace App\Controller;

use App\Entity\Komentarze;
use App\Entity\Przepisy;
use App\Entity\Skladniki;
use App\Entity\Uzytkownicy;
use App\Entity\User;
use App\Entity\PrzepisySkladniki;
use App\Form\PrzepisySkladnikiType;
use App\Form\PrzepisyType;
use App\Form\SkladnikiType;
use App\Repository\PrzepisyRepository;
use App\Repository\PrzepisySkladnikiRepository;
use App\Repository\SkladnikiRepository;
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
     *
     *  @IsGranted(
     *     "IS_AUTHENTICATED_REMEMBERED",
     *     message="You can not add"
     * )
     */
    public function new(Request $request, PrzepisyRepository $repository): Response
    {
            $przepis = new Przepisy();
//            $przepis = new Przepisy();
//            $skladnik = new Skladniki();
//            $przepis->setTresc("lalalal");
//            $skladnik->setNazwa('aaaaa');
//            $przepis->setTytul('tytul');
//            $przepisySkladniki->setPrzepis($przepis);
//            //$przepisySkladniki->setSkladnik($skladnik);

        $form = $this->createForm(PrzepisyType::class, $przepis);

        $form->handleRequest($request);

             if ($form->isSubmitted() && $form->isValid()) {
            $przepis->setAutor($this->getUser()->getUzytkownicy());


           // $przepisySkladniki->setIloscSkladnika('3');

           // $przepisy->getSkladnik($skladniki->getPrzepisy());
             $repository->save($przepis);
                 $this->addFlash('success', 'Przepis dodany');

            return $this->redirectToRoute('stronaglowna_index');
        }

       return $this->render(
           'przepis/new.html.twig',
           ['form' => $form->createView()]
        );



 }

    /**
     * New Skladnik action.
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
     *     "/newSkladniki/{idPrzepisu}",
     *     methods={"GET", "POST"},
     *     requirements={"idPrzepisu": "[1-9]\d*"},
     *     name="skladniki_new",
     * )
     *
     *  @IsGranted(
     *     "IS_AUTHENTICATED_REMEMBERED",
     *     message="You can not add"
     * )
     */
    public function newSkladnik(Request $request, SkladnikiRepository $repository, $idPrzepisu): Response
    {
        $skladnik = new Skladniki();

        $form = $this->createForm(SkladnikiType::class, $skladnik);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $repository->save($skladnik);

            return $this->redirectToRoute('skladniki_add',['id'=>$skladnik->getId()],['idPrzepisu'=>$idPrzepisu]);
        }

        return $this->render(
            'przepis/newPrzepis.html.twig',
            ['form' => $form->createView()]
        );



    }

    /**
     * Add Skladnik action.
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
     *     "/addSkladniki/{id}/{idPrzepisu}",
     *     methods={"GET", "POST"},
     *     requirements={"id": "[1-9]\d*"},
     *     name="skladniki_add",
     * )
     *
     *  @IsGranted(
     *     "IS_AUTHENTICATED_REMEMBERED",
     *     message="You can not add"
     * )
     */
    public function addSkladnik(Request $request, PrzepisySkladnikiRepository $repository, $id, $idPrzepisu): Response
    {
        $Pzepisyskladniki = new PrzepisySkladniki();
        $form = $this->createForm(PrzepisySkladnikiType::class, $Pzepisyskladniki);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $Pzepisyskladniki->setSkladnik($id);
            $Pzepisyskladniki->setPrzepis($idPrzepisu);
            $repository->save($Pzepisyskladniki);


            $this->addFlash('success', 'message.created_successfully');

            return $this->redirectToRoute('skladniki_new');
        }

        return $this->render(
            'przepis/addSkladnik.html.twig',
            ['form' => $form->createView(), 'id'=>$request->get('id')]
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
     *
     * @IsGranted(
     *     "MANAGE",
     *     subject="przepisy",
     *     message="You can not edit"
     * )
     */
    public function edit(Request $request, Przepisy $przepisy, PrzepisyRepository $repository, $id): Response
    {
//        if ($przepisy->getAutor() !== $this->getUser()->getUzytkownicy()) {
//            $this->addFlash('warning', 'message.item_not_found');
//
//            return $this->redirectToRoute('stronaglowna_index');
//        }
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
     *
     * @IsGranted(
     *     "MANAGE",
     *     subject="przepisy",
     *     message="You can not delete"
     * )
     *
     *
     */
    public function delete(Request $request, Przepisy $przepisy, PrzepisyRepository $repository): Response
    {
//        if ($przepisy->getAutor() !== $this->getUser()->getUzytkownicy() ) {
//            $this->addFlash('warning', 'message.item_not_found');
//
//            return $this->redirectToRoute('stronaglowna_index');
//        }
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