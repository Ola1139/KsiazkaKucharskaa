<?php
/**
 * Przepis type.
 */

namespace App\Form;

use App\Entity\Przepisy;
use App\Entity\PrzepisySkladniki;
use App\Entity\Skladniki;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class PrzepisyType.
 */
class PrzepisyType extends AbstractType
{
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
            'tresc',
            TextType::class,
            [
                'label' => 'label.tresc',
                'required' => true,
                'attr' => ['max_length' => 255],
                'allow_delete' => true,
            ]
        );


//        $builder->add(
//            'skladnik',
//            EntityType::class,
//            [
//                'class' => PrzepisySkladniki::class,
//                'choice_label' => function ($skladnik) {
//                    return $skladnik->getSkladnik();
//                },
//                'label' => 'label.skladnik',
//                'placeholder' => 'label.none',
//                'required' => true,
//            ]
//        );


//        $builder->add(
//            'iloscSkladnika',
//            IntegerType::class,
//            [
//                'label' => 'label.iloscSkladnika',
//                'required' => true,
//                'attr' => ['max_length' => 255],
//            ]
//        );
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
    public function getBlockPrefix(): string
    {
        return 'przepisy';
    }
}