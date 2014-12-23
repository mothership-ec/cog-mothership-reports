<?php

namespace Message\Mothership\Report\Filter\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Message\Mothership\Report\Filter\Form\DataTransformer;

class FilterForm extends AbstractType
{
	private $_transformer;

	/**
	 * Constructor.
	 *
	 * @param DataTransformer   $transformer
	 */
	public function __construct(DataTransformer $transformer)
	{
		$this->_transformer = $transformer;
	}

	/**
	 * Gets the filter name.
	 *
	 * @return string name of the filter
	 */
	public function getName()
	{
		return 'filter_form';
	}

	/**
	 * {@inheritdoc}
	 */
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		foreach($options['filters'] as $filter) {
			$form = $filter->getForm();
			$builder->add($form->getName(), $form, ['label' => false] );
		}

		$builder->addModelTransformer($this->_transformer);
	}

	/**
	 * {@inheritDoc}
	 */
	public function setDefaultOptions(OptionsResolverInterface $resolver)
	{
		$resolver->setRequired([
			'filters',
		]);
	}
}