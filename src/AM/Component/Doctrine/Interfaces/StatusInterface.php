<?php
/**
 * This interface defines entities that have a status
 * Status codes are also defined on this interface
 * If you need to define a new status code, only put it here if it belongs to every entity in general
 *
 * @author Anthony Matarazzo <email@anthonymatarazzo.com>
 */

namespace AM\Component\Doctrine\Interfaces;

/**
 * Class StatusInterface
 *
 * @package AM\Component\Doctrine\Interfaces
 */
interface StatusInterface
{
	/**
	 * This entity is active, it should be fully functional
	 */
	const STATUS_ACTIVE = 1;

	/**
	 * This entity is not active, it should not be functional
	 */
	const STATUS_INACTIVE = 3;

	/**
	 * This entity is in a "trash bin" mode, it has been deleted
	 */
	const STATUS_DELETED = 5;

	/**
	 * This entity is in a pending state and should be only partially functional
	 */
	const STATUS_PENDING = 11;

	/**
	 * Set the status
	 * @param int $status
	 * @return StatusInterface
	 */
	public function setStatus($status);

	/**
	 * Get the status
	 * @return int
	 */
	public function getStatus();
}