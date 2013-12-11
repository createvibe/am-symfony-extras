<?php
/**
 * Defines the public accessibility for all form processors
 * @author Anthony Matarazzo <email@anthonymatarazzo.com>
 */

namespace AM\Component\Form\Interfaces;

/**
 * Interface FormProcessorInterface
 *
 * @package AM\Component\Form\Interfaces
 */
interface FormProcessorInterface
{
	/**
	 * Process a form
	 * @param \Symfony\Component\Form\Form $form Passed by reference because it is intended to be redefined after successful submit to clear values (but not required)
	 * @return boolean
	 */
	public function process(\Symfony\Component\Form\Form &$form);

	/**
	 * Set the Request object
	 * @param \Symfony\Component\HttpFoundation\Request|null $request
	 * @return FormProcessorInterface
	 */
	public function setRequest(\Symfony\Component\HttpFoundation\Request $request=null);
} 