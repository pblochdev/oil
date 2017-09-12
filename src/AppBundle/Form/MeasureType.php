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
			->add('liter', 'text', array(
				'attr' => array(
					'placeholder' => '0.00'
				)
			))
			->add('price', 'text', array(
				'attr' => array(
					'placeholder' => '0.00'
				)
			))
			->add('totalPrice', 'text', array(
				'attr' => array(
					'placeholder' => '0.00'
				)
			))
			->add('km', 'text', array(
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