<?php

namespace App\Form;

use App\Entity\PrzepisySkladniki;
use App\Entity\Skladniki;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\PropertyAccess\PropertyAccess;


class SkladnikiType extends AbstractType
{
public function buildForm(FormBuilderInterface $builder, array $options)
{
$builder->add('nazwa');
}

public function configureOptions(OptionsResolver $resolver)
{
$resolver->setDefaults([
'data_class' => Skladniki::class,
]);
}
}
?>