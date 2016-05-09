<?php
/**
 * Created by PhpStorm.
 * User: Virginie
 */
namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;


class TarifType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('libelle', TextType::class,array('label' => 'Nom','required' => true,'attr' => array('class'=>'form-control')))
            ->add('description', TextareaType::class,array('label' => 'Descritption','required' => true,'attr' => array('class'=>'form-control')))
            ->add('prix', MoneyType::class,array('label' => 'Prix ','required' => true,'attr' => array('class'=>'form-control')));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Tarif',
        ));
    }
}