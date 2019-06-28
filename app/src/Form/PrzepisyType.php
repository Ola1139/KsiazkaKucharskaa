<?php
/**
 * Przepis type.
 */

namespace App\Form;

use App\Entity\JednostkiMiary;
use App\Entity\Kategorie;
use App\Entity\Przepisy;
use App\Entity\PrzepisySkladniki;
use App\Entity\Skladniki;
use App\Form\DataTransformer\SkladnikiDataTransformer;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\SubmitButton;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\PropertyAccess\PropertyAccess;



/**
 * Class PrzepisyType.
 */
class PrzepisyType extends AbstractType
{

    /**
     * Tags data transformer.
     *
     * @var \App\Form\DataTransformer\SkladnikiDataTransformer|null
     */
    private $skladnikiDataTransformer = null;

    /**
     * TaskType constructor.
     *
     * @param \App\Form\DataTransformer\SkladnikiDataTransformer $skladnikiDataTransformer Tags data transformer
     */
    public function __construct(SkladnikiDataTransformer $skladnikiDataTransformer)
    {
        $this->skladnikiDataTransformer = $skladnikiDataTransformer;
    }

    /**
     * Builds the form.
     *
     * This method is called for each type in the hierarchy starting from the
     * top most type. Type extensions can further modify the form.
     *
     * @see FormTypeExtensionInterface::buildForm()
     *
     * @param FormBuilderInterface $builder The form builder
     * @param array                $options The options
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {

        $builder->add(
            'tytul',
            TextType::class,
            [
                'label' => 'Tytuł',
                'required' => true,
                'attr' => ['max_length' => 255],
            ]
        );
        $builder->add(
            'tresc',
            TextareaType::class,
            [
                'label' => 'Treść',
                'required' => true,
                'attr' => ['max_length' => 255],
            ]
        );
        $builder->add(
            'kategoria',
            EntityType::class,
            [
                'class' => Kategorie::class,
                'choice_label' => function ($kategoria) {
                    return $kategoria->getNazwaKategorii();
                },
                'label' => 'Kategoria',
                'required' => true,
            ]
        );





    }
    /**
     * Configures the options for this type.
     *
     * @param OptionsResolver $resolver The resolver for the options
     */
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults(['data_class' => Przepisy::class]);
    }

    /**
     * Returns the prefix of the template block name for this type.
     *
     * The block prefix defaults to the underscored short class name with
     * the "Type" suffix removed (e.g. "UserProfileType" => "user_profile").
     *
     * @return string The prefix of the template block name
     */
    public function getBlockPrefix():string
    {
        return 'przepisy';
    }
}