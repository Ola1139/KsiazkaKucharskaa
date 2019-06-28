<?php

namespace App\Form;

use App\Entity\JednostkiMiary;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\PropertyAccess\PropertyAccess;


class JednostkaMiaryType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add(
            'nazwaJednostkiMiary',
            EntityType::class,
            [
                'class' => JednostkiMiary::class,
                'choice_label' => function ($jednostkaMiary) {
                    return $jednostkaMiary->getNazwaJednostkiMiary();
                },
                'label' => 'label.skladnik',
                'required' => true,
            ]
        );
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Skladniki::class,
        ]);
    }
}
?>