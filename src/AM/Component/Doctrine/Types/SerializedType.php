<?php
/**
 * This class allows doctrine to store complex objects in ORM tables
 * It is recommended that you implement \Serializable on your data class
 *
 * @author Anthony Matarazzo <email@anthonymatarazzo.com>
 */

namespace AM\Component\Doctrine\Types;

use Doctrine\DBAL\Platforms\AbstractPlatform,
	Doctrine\DBAL\Types\Type;

/**
 * Class SerializedType
 *
 * @package AM\Component\Doctrine\Types
 */
class SerializedType extends Type
{
	/**
	 * {@inheritdoc}
	 */
	public function getSQLDeclaration(array $fieldDeclaration, AbstractPlatform $platform)
	{
		return 'text';
	}

	/**
	 * {@inheritdoc}
	 */
	public function convertToPHPValue($value, AbstractPlatform $platform)
	{
		return unserialize($value);
	}

	/**
	 * {@inheritdoc}
	 */
	public function convertToDatabaseValue($value, AbstractPlatform $platform)
	{
		return serialize($value);
	}

	/**
	 * {@inheritdoc}
	 */
	public function getName()
	{
		return 'serialized';
	}
} 