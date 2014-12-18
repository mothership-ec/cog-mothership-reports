<?php

namespace Message\Mothership\Report\Filter\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class DateForm extends AbstractType
{
	/**
	 * Gets the filter name.
	 *
	 * @return string name of the filter
	 */
	public function getName()
	{
		return 'date_form';
	}

	/**
	 * {@inheritdoc}
	 */
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder->add('datechoice', 'date', [
			'label' => 'Date'
		]);
	}
}