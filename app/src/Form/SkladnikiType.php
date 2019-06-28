<?php

namespace App\Form;

use App\Entity\JednostkiMiary;
use App\Entity\Kategorie;
use App\Entity\PrzepisySkladniki;
use App\Entity\Skladniki;
use App\Entity\User;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use \Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\PropertyAccess\PropertyAccess;


class SkladnikiType extends AbstractType
{
public function buildForm(FormBuilderInterface $builder, array $options)
{

    $builder->add(
        'nazwa',
        TextType::class,
        [
            'label' => 'label.name',
            'required' => true,
            'attr' => ['max_length' => 255],
        ]
    );

//    $builder->add('przepisy', CollectionType::class, [
//        'entry_type' => PrzepisySkladnikiType::class,
//        'entry_options' => ['label' => false],
//    ]);

}
/**
 * Configures the options for this type.
 *
 * @param OptionsResolver $resolver The resolver for the options
 */
public function configureOptions(OptionsResolver $resolver): void
{
    $resolver->setDefaults(['data_class' => Skladniki::class]);
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
    return 'skladnik';
}
}

?>