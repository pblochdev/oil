<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class MeasureType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options) 
	{
		$builder
			
			->add('price', 'text', array(
				'label' => 'Cena za litr',
				'attr' => array(
					'placeholder' => '0.00'
				)
			))
			->add('totalPrice', 'text', array(
				'label' => 'Suma zł',
				'attr' => array(
					'placeholder' => '0.00'
				)
			))
			->add('liter', 'text', array(
				'label' => 'Ilość litrów',
				'attr' => array(
					'placeholder' => '0.00'
				)
			))
			->add('km', 'text', array(
				'label' => 'Ilość km',
				'attr' => array(
					'placeholder' => '0.00'
				)
			));
			
	}
	
	
	public function configureOptions(OptionsResolver $resolver) 
	{
		$resolver->setDefaults(array(
			'data_class' => 'AppBundle\Entity\Measure',
		));
	}
	
	
	public function getBlockPrefix() 
	{
		return 'appbundle_measure';
	}
}