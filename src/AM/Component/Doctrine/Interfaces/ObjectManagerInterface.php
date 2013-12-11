<?php
/**
 * 
 * @author Anthony Matarazzo <email@anthonymatarazzo.com>
 */

namespace AM\Component\Doctrine\Interfaces;

/**
 * Interface ObjectManagerInterface
 *
 * @package AM\Component\Doctrine\Interfaces
 */
interface ObjectManagerInterface
{
	/**
	 * Set the ObjectManager
	 * @param \Doctrine\Common\Persistence\ObjectManager
	 * @return $this
	 */
	public function setObjectManager(\Doctrine\Common\Persistence\ObjectManager $em);

	/**
	 * Get the ObjectManager
	 * @return \Doctrine\Common\Persistence\ObjectManager
	 */
	public function getObjectManager();

	/**
	 * Tells the ObjectManager to make an instance managed and persistent.
	 *
	 * The object will be entered into the database as a result of the flush operation.
	 *
	 * NOTE: The persist operation always considers objects that are not yet known to
	 * this ObjectManager as NEW. Do not pass detached objects to the persist operation.
	 *
	 * @param object $object The instance to make managed and persistent.
	 *
	 * @return ObjectManagerInterface
	 */
	public function persist($object);

	/**
	 * Detaches an object from the ObjectManager, causing a managed object to
	 * become detached. Unflushed changes made to the object if any
	 * (including removal of the object), will not be synchronized to the database.
	 * Objects which previously referenced the detached object will continue to
	 * reference it.
	 *
	 * @param object $object The object to detach.
	 *
	 * @return ObjectManagerInterface
	 */
	public function detach($object);

	/**
	 * Merges the state of a detached object into the persistence context
	 * of this ObjectManager and returns the managed copy of the object.
	 * The object passed to merge will not become associated/managed with this ObjectManager.
	 *
	 * @param object $object
	 *
	 * @return object
	 */
	public function merge($object);

	/**
	 * Removes an object instance.
	 *
	 * A removed object will be removed from the database as a result of the flush operation.
	 *
	 * @param object $object The object instance to remove.
	 *
	 * @return ObjectManagerInterface
	 */
	public function remove($object);

	/**
	 * Flushes all changes to objects that have been queued up to now to the database.
	 * This effectively synchronizes the in-memory state of managed objects with the
	 * database.
	 *
	 * @return ObjectManagerInterface
	 */
	public function flush();

	/**
	 * Find records by an associative array of criteria
	 * @param array $criteria
	 * @param array $orderBy
	 * @param null|int $limit
	 * @param null|int $offset
	 * @return null|array<AppModelInterface>
	 */
	public function findBy(array $criteria=array(), array $orderBy = null, $limit = null, $offset = null);

	/**
	 * Finds a single object by a set of criteria.
	 * @param array $criteria The criteria.
	 * @return object The object.
	 */
	public function findOneBy(array $criteria);

	/**
	 * Perform an update on a model entity
	 * @param DatabaseModelInterface $model
	 * @return $this
	 */
	public function update(DatabaseModelInterface $model);
} 