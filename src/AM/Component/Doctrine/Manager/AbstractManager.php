<?php
/**
 * This class defines common functionality for our Object Managers
 * @author Anthony Matarazzo <email@anthonymatarazzo.com>
 */

namespace AM\Component\Doctrine\Manager;

use Doctrine\Common\Persistence\ObjectManager;

use AM\Component\Doctrine\Interfaces\ObjectManagerInterface,
	AM\Component\Doctrine\Interfaces\DatabaseModelInterface;

/**
 * Class AbstractManager
 *
 * @package AM\Component\Doctrine\Manager
 */
abstract class AbstractManager implements ObjectManagerInterface
{
	/**
	 * The ObjectManager
	 * @var ObjectManager
	 */
	private $om;

	/**
	 * The entity class path
	 * @var string
	 */
	private $entityClass;

	/**
	 * Construct this object with an entity class path
	 * @param string $entityClass
	 * @throws \InvalidArgumentException
	 */
	public function __construct($entityClass)
	{
		if (!class_exists($entityClass))
		{
			throw new \InvalidArgumentException($entityClass . ' is not a valid class');
		}
		$this->entityClass = $entityClass;
	}

	/**
	 * {@inheritdoc}
	 */
	public function setObjectManager(ObjectManager $om)
	{
		$this->om = $om;
		return $this;
	}

	/**
	 * {@inheritdoc}
	 */
	public function getObjectManager()
	{
		return $this->om;
	}

	/**
	 * {@inheritdoc}
	 */
	public function persist($object)
	{
		$this->om->persist($object);
		return $this;
	}

	/**
	 * {@inheritdoc}
	 */
	public function detach($object)
	{
		$this->om->detach($object);
		return $this;
	}

	/**
	 * {@inheritdoc}
	 */
	public function merge($object)
	{
		return $this->om->merge($object);
	}

	/**
	 * {@inheritdoc}
	 */
	public function remove($object)
	{
		$this->om->remove($object);
		return $this;
	}

	/**
	 * {@inheritdoc}
	 */
	public function flush()
	{
		$this->om->flush();
		return $this;
	}

	/**
	 * Get the Repository for this manager's entity
	 * @return \Doctrine\Common\Persistence\ObjectRepository
	 */
	public function getRepository()
	{
		return $this->om->getRepository($this->entityClass);
	}

	/**
	 * {@inheritdoc}
	 */
	public function findBy(array $criteria=array(), array $orderBy = null, $limit = null, $offset = null)
	{
		return $this->getRepository()->findBy($criteria, $orderBy, $limit, $offset);
	}

	/**
	 * {@inheritdoc}
	 */
	public function findOneBy(array $criteria)
	{
		return $this->getRepository()->findOneBy($criteria);
	}

	/**
	 * {@inheritdoc}
	 */
	public function update(DatabaseModelInterface $entity)
	{
		$this->om->persist($entity);
		$this->om->flush($entity);
	}
} 