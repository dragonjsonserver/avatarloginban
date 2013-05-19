<?php
/**
 * @link http://dragonjsonserver.de/
 * @copyright Copyright (c) 2012-2013 DragonProjects (http://dragonprojects.de/)
 * @license http://license.dragonprojects.de/dragonjsonserver.txt New BSD License
 * @author Christoph Herrmann <developer@dragonprojects.de>
 * @package DragonJsonServerAvatarloginban
 */

/**
 * @return array
 */
return [
	'service_manager' => [
		'invokables' => [
            '\DragonJsonServerAvatarloginban\Service\Avatarloginban' => '\DragonJsonServerAvatarloginban\Service\Avatarloginban',
		],
	],
	'doctrine' => [
		'driver' => [
			'DragonJsonServerAvatarloginban_driver' => [
				'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
				'cache' => 'array',
				'paths' => [
					__DIR__ . '/../src/DragonJsonServerAvatarloginban/Entity'
				],
			],
			'orm_default' => [
				'drivers' => [
					'DragonJsonServerAvatarloginban\Entity' => 'DragonJsonServerAvatarloginban_driver'
				],
			],
		],
	],
];
