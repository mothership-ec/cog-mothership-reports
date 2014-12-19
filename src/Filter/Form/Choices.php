<?php

namespace Message\Mothership\Report\Filter\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class Choices extends AbstractType
{
	/**
	 * Constructor.
	 *
	 * @param String  $filterName    The unique filter name.
	 * @param String  $label         The label for the form field.
	 * @param Array   $choices       The choices for the form field.
	 * @param Bool    $multichoice   If the form is multiple choice.
	 */
	public function __construct($label, $choices, $multichoice, $filterName)
    {
    	$this->label = $label;
        $this->choices = $choices;
        $this->multichoice = $multichoice;
        $this->filterName = $filterName;
    }

	/**
	 * Gets the filter name.
	 *
	 * @return string name of the filter
	 */
	public function getName()
	{
		return $this->filterName;
	}

	/**
	 * {@inheritdoc}
	 */
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder->add('choices', 'choice', [
			'label'    => $this->label,
			'choices'  => array_combine($this->choices, $this->choices),
			'multiple' => $this->multichoice
		]);
	}
}