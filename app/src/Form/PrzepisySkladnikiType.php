<?php

namespace App\Form;

use App\Entity\JednostkiMiary;
use App\Entity\Kategorie;
use App\Entity\PrzepisySkladniki;
use App\Entity\Skladniki;
use Doctrine\DBAL\Types\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use \Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\PropertyAccess\PropertyAccess;


class PrzepisySkladnikiType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
//        $builder->add('przepis', CollectionType::class, [
//            'entry_type' => PrzepisyType::class,
//            'entry_options' => ['label' => false],
//            'by_reference' => false,
//            'allow_add' => true,
//            'allow_delete' => true
//        ]);

//        $builder->add('skladnik', CollectionType::class, [
//                'entry_type' => SkladnikiType::class,
//                'entry_options' => ['label' => false],
//                'by_reference' => false,
//                'allow_add' => true,
//                'allow_delete' => true
//        ]);
//
        $builder->add(
            'jednostkaMiary',
            EntityType::class,
            [
                'class' => JednostkiMiary::class,
                'choice_label' => function ($jednostkaMiary) {
                    return $jednostkaMiary->getNazwaJednostkiMiary();
                },

            ]
        );

        $builder->add(
            'iloscSkladnika',
            \Symfony\Component\Form\Extension\Core\Type\IntegerType::class,
            [
                'label' => 'label.iloscskladnika',
                'required' => false,

                'attr' => ['max_length' => 255],
            ]
        );

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' =>PrzepisySkladniki::class,
        ]);
    }
}


?>