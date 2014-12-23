<?php

namespace Message\Mothership\Report\Filter\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class Choices extends AbstractType
{
	private $_filterName;
	private $_label;
	private $_choices;
	private $_multichoice;

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
    	$this->_label = $label;
        $this->_choices = $choices;
        $this->_multichoice = $multichoice;
        $this->_filterName = $filterName;
    }

	/**
	 * Gets the filter name.
	 *
	 * @return string name of the filter
	 */
	public function getName()
	{
		return $this->_filterName;
	}

	/**
	 * {@inheritdoc}
	 */
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder->add('choices', 'choice', [
			'label'    => $this->_label,
			'choices'  => array_combine($this->_choices, $this->_choices),
			'multiple' => $this->_multichoice
		]);
	}
}