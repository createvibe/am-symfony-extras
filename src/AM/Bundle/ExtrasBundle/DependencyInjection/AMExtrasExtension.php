<?php

namespace AM\Bundle\ExtrasBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder,
	Symfony\Component\DependencyInjection\Loader\XmlFileLoader,
	Symfony\Component\HttpKernel\DependencyInjection\Extension,
	Symfony\Component\Config\FileLocator;

class AMExtrasExtension extends Extension
{
	/**
	 * {@inheritdoc}
	 */
	public function load(array $configs, ContainerBuilder $container)
	{
		$loader = new XmlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
		$loader->load('forms.processors.xml');
	}

	/**
	 * {@inheritdoc}
	 */
	public function getAlias()
	{
		return 'am_extras';
	}
}
