<?php
/**
 * StronaGlowna controller.
 */

namespace App\Controller;

use App\Entity\Komentarze;
use App\Entity\Przepisy;
use App\Entity\PrzepisySkladniki;
use App\Form\komentarzType;
use App\Form\PrzepisyType;
use App\Repository\KomentarzeRepository;
use App\Repository\PrzepisyRepository;
use Knp\Component\Pager\PaginatorInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\SearchType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class StronaGlownaController.
 *
 * @Route("/stronaglowna")
 */
class StronaGlownaController extends AbstractController
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
     *     name="stronaglowna_index",
     * )
     *
     *
     */
    public function index(Request $request, PrzepisyRepository $repository, PaginatorInterface $paginator): Response
    {
        $pagination = $paginator->paginate(
            $repository->queryAll(),
            $request->query->getInt('page', 1),
            Przepisy::NUMBER_OF_ITEMS
        );

        return $this->render(
            'stronaglowna/index.html.twig',
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
     *     name="przepis_view",
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
            'przepis/view.html.twig',
            ['przepis' => $przepis, 'autor' => $autor]
        );

    }

    /**
     * Search action.
     *
     * @param \App\Entity\Przepisy $przepis Przepis entity
     *
     *
     *
     * @return \Symfony\Component\HttpFoundation\Response HTTP response
     *
     * @Route(
     *     "/wyszukaj",
     *      methods={"GET", "PUT"},
     *     name="przepis_search",
     *
     * )
     *
     *
     *
     */
    public function search(Przepisy $przepisy, Request $request, PaginatorInterface $paginator, PrzepisyRepository $repository): Response
    {
        $przepisy = new Przepisy();

        $form = $this->createForm(SearchType::class, $przepisy, ['method' => 'GET']);

        // 2) handle the submit (will only happen on POST)
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $pagination = $paginator->paginate(
                $repository->queryByTitle($przepisy->getTytul()),
                $request->query->getInt('page', 1),
                Przepisy::NUMBER_OF_ITEMS
            );

            return $this->render(
                'stronaglowna/search.html.twig',
                ['pagination' => $pagination]
            );

        }

        return $this->render(
            'przepis/search.html.twig'
        );
    }


}