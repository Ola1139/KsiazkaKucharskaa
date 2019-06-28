<?php
/**
 * Uzytkownicy type.
 */

namespace App\Form;

use App\Entity\Kategorie;
use App\Entity\Przepisy;
use App\Entity\Uzytkownicy;
use App\Entity\PrzepisySkladniki;
use App\Entity\Skladniki;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\PropertyAccess\PropertyAccess;



/**
 * Class UzytkownicyType.
 */
class UzytkownicyType extends AbstractType
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
        'imie',
        TextType::class,
        [
            'label' => 'Imie',
            'required' => true,
            'attr' => ['max_length' => 255],
        ]
    );


        $builder->add(
            'nazwisko',
            TextType::class,
            [
                'label' => 'Nazwisko',
                'required' => true,
                'attr' => ['max_length' => 255],
            ]
        );
        $builder->add(
            'zainteresowania',
            TextType::class,
            [
                'label' => 'Hobby',
                'required' => false,
                'attr' => ['max_length' => 255],
            ]
        );
        $builder->add(
            'ulubionaKuchnia',
            TextType::class,
            [
                'label' => 'Ulubiona Kuchnia',
                'required' => false,
                'attr' => ['max_length' => 255],
            ]
        );
        $builder->add(
            'ulubionaPotrawa',
            TextType::class,
            [
                'label' => 'Ulubione danie',
                'required' => false,

                'attr' => ['max_length' => 255],
            ]
        );

        $builder->add(
            'OSobie',
            TextareaType::class,
            [
                'label' => 'O sobie',
                'required' => false,

                'attr' => ['max_length' => 255],
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
        $resolver->setDefaults(['data_class' => Uzytkownicy::class]);
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
        return 'uzytkownicy';
    }
}