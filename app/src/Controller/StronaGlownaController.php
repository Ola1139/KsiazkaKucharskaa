<?php
/**
 * StronaGlowna controller.
 */

namespace App\Controller;

use App\Entity\Kategorie;
use App\Entity\Komentarze;
use App\Entity\Przepisy;
use App\Entity\PrzepisySkladniki;
use App\Form\komentarzType;
use App\Form\PrzepisyType;
use App\Repository\KategorieRepository;
use App\Repository\KomentarzeRepository;
use App\Repository\PrzepisyRepository;
use Entity\Repository\CategoryRepository;
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
        $tytul = $przepis->getTytul();

        $nazwaKategorii = $przepis->getKategoria()->getNazwaKategorii();

        return $this->render(
            'przepis/view.html.twig',
            ['przepis' => $przepis, 'autor' => $autor, 'tytul' => $tytul,  'nazwaKategorii' => $nazwaKategorii]
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
     *      methods={"GET", "POST"},
     *     name="przepis_search",
     *
     * )
     *
     *
     *
     */
    public function searchForm( Request $request, PaginatorInterface $paginator, PrzepisyRepository $repository): Response
    {
        $form = $this->createForm(SearchType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $pagination = null;
            $tytul= $form->getData();
                $pagination = $paginator->paginate(
                    $repository->queryByTitle($tytul),
                    $request->query->getInt('page', 1),
                    Przepisy::NUMBER_OF_ITEMS
                );


            return $this->render(
                'przepis/searchView.html.twig',
                ['pagination' => $pagination]
            );
        }
        return $this->render(
            'przepis/search.html.twig',
            [
                'form' => $form->createView(),
            ]
        );
   }

    /**
     * View all kategorie.
     *
     * @param \Symfony\Component\HttpFoundation\Request $request    HTTP request
     * @param \App\Repository\KategorieRepository            $repository Repository
     * @param \Knp\Component\Pager\PaginatorInterface   $paginator  Paginator
     *
     * @return \Symfony\Component\HttpFoundation\Response HTTP response
     *
     * @Route("/kategorie", name="category_index")
     */
    public function kategorie(Request $request, KategorieRepository $repository, PaginatorInterface $paginator): Response
    {

        return $this->render(
            'kategorie/kategorie.html.twig',
            [
                'data' => $repository->findAll(),
            ]
        );
    }
    /**
     * Kategorie i przepisy
     *
     * @param \Symfony\Component\HttpFoundation\Request $request    HTTP request
     * @param \App\Entity\Kategorie kategorie Kategorie
     * @param \App\Repository\KategorieRepository $repository Type repository
     * @param \Knp\Component\Pager\PaginatorInterface   $paginator  Paginator
     *
     * @return \Symfony\Component\HttpFoundation\Response HTTP response
     *
     * @Route(
     *     "/{id}/kategorie",
     *     name="category_view",
     *     requirements={"id": "0*[1-9]\d*"},
     * )
     */
    public function viewKategorie(Request $request, Kategorie $category, PrzepisyRepository $repository, PaginatorInterface $paginator, $id): Response
    {
        $pagination = null;
        $pagination = $paginator->paginate(
            $repository->queryByKategoria($id),
            $request->query->getInt('page', 1),
            Przepisy::NUMBER_OF_ITEMS
        );


        return $this->render(
            'kategorie/kategorieView.html.twig',
            ['pagination' => $pagination]
        );
    }




}