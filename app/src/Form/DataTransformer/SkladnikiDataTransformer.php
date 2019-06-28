<?php
/**
 * Skladniki data transformer.
 */

namespace App\Form\DataTransformer;

use App\Entity\Skladniki;
use App\Repository\SkladnikiRepository;
use Symfony\Component\Form\DataTransformerInterface;

/**
 * Class SkladnikiDataTransformer.
 */
class SkladnikiDataTransformer implements DataTransformerInterface
{
    /**
     * Tag repository.
     *
     * @var \App\Repository\SkladnikiRepository|null
     */
    private $repository = null;

    /**
     * SkladnikiDataTransformer constructor.
     *
     * @param \App\Repository\SkladnikiRepository $repository Skladniki repository
     */
    public function __construct(SkladnikiRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Transform array of tags to string of names.
     *
     * @param \Doctrine\Common\Collections\Collection $skladniki Skladniki entity collection
     *
     * @return string Result
     */
    public function transform($skladniki): string
    {
        if (null == $skladniki) {
            return '';
        }

        $skladnikNames = [];

        foreach ($skladniki as $skladnik) {
            $skladnikNames[] = $skladnik->getNazwa();
        }

        return implode(',', $skladnikNames);
    }

    /**
     * Transform string of tag names into array of Tag entities.
     *
     * @param string $value String of tag names
     *
     * @return array Result
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function reverseTransform($value): array
    {
        $skladnikTitles = explode(',', $value);

        $skladniki = [];

        foreach ($skladnikTitles as $skladnikTitle) {
            if ('' !== trim($skladnikTitle)) {
                $skladnik = $this->repository->queryByAuthor(strtolower($skladnikTitle));
                if (null == $skladnik) {
                    $skladnik = new Skladniki();
                    $skladnik->setNazwa($skladnikTitle);
                    $this->repository->save($skladnik);
                }
                $skladniki[] = $skladnik;
            }
        }

        return $skladniki;
    }
}