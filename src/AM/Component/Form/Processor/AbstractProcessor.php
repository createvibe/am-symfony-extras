<?php
/**
 * Abstract common logic for form processing (you do not have to extend this class in your processor)
 * @author Anthony Matarazzo <email@anthonymatarazzo.com>
 */

namespace AM\Component\Form\Processor;

use Symfony\Component\Form\Form,
	Symfony\Component\HttpFoundation\Request,
	Symfony\Component\Security\Core\SecurityContext;

use Psr\Log\LoggerInterface;

use AM\Component\Form\Interfaces\FormProcessorInterface;

/**
 * Class AbstractProcessor
 *
 * @package AM\Component\Form\Processor
 */
abstract class AbstractProcessor implements FormProcessorInterface
{
	/**
	 * The User we are processing for
	 * @var null|mixed
	 */
	protected $user = null;

	/**
	 * The SecurityContext
	 * @var SecurityContext
	 */
	protected $securityContext;

	/**
	 * The Request object
	 * @var Request
	 */
	protected $request;

	/**
	 * The Logger
	 * @var LoggerInterface
	 */
	protected $logger;

	/**
	 * Error Messages
	 * @var array<string>
	 */
	protected $errors = array();

	/**
	 * Actually process the form
	 * @param Form $form
	 * @return boolean
	 */
	abstract protected function processForm(Form $form);

	/**
	 * {@inheritdoc}
	 */
	public function setRequest(Request $request=null)
	{
		$this->request = $request;
		return $this;
	}

	/**
	 * Set the Security Context
	 * @param SecurityContext $securityContext
	 * @return $this
	 */
	public function setSecurityContext(SecurityContext $securityContext)
	{
		$this->securityContext = $securityContext;
		return $this;
	}

	/**
	 * Set the Logger
	 * @param LoggerInterface $logger
	 * @return $this
	 */
	public function setLogger(LoggerInterface $logger)
	{
		$this->logger = $logger;
		return $this;
	}

	/**
	 * Set the User
	 * @param mixed $user
	 * @return $this
	 */
	public function setUser($user)
	{
		$this->user = $user;
		return $this;
	}

	/**
	 * Get the currently logged in user (if any)
	 * @return null|mixed
	 */
	protected function getUser()
	{
		if ($this->user)
		{
			return $this->user;
		}
		if (!$this->securityContext ||
			!$this->securityContext->gettoken())
		{
			return null;
		}
		$this->user = $this->securityContext->getToken()->getUser() ?: null;
		return $this->user;
	}

	/**
	 * Log an error
	 * @param string $message
	 * @return $this
	 */
	public function logError($message)
	{
		$this->logger->err($message);
		return $this;
	}

	/**
	 * Log information
	 * @param string $message
	 * @return $this
	 */
	public function log($message)
	{
		$this->logger->info($message);
		return $this;
	}

	/**
	 * Log an error
	 * @param string $message
	 * @return $this
	 */
	protected function error($message)
	{
		$this->errors[] = $message;
		return $this;
	}

	/**
	 * See if there are any errors
	 * @return bool
	 */
	public function hasErrors()
	{
		return (count($this->errors) > 0);
	}

	/**
	 * Get the errors
	 * @return array<string>
	 */
	public function getErrors()
	{
		return $this->errors;
	}

	/**
	 * {@inheritdoc}
	 */
	public function process(Form &$form)
	{
		if (null === $this->request)
		{
			throw new FormProcessorException('The form cannot be processed outside the request scope.');
		}
		if ('POST' === $this->request->getMethod())
		{
			$cloned = clone $form;
			$form->handleRequest($this->request);
			if ($form->isValid())
			{
				if ($bool = $this->processForm($form))
				{
					$form = $cloned;
				}
			}
			return false;
		}
		return true;
	}
} 