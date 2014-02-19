<?php
/**
 * @link http://dragonjsonserver.de/
 * @copyright Copyright (c) 2012-2014 DragonProjects (http://dragonprojects.de/)
 * @license http://license.dragonprojects.de/dragonjsonserver.txt New BSD License
 * @author Christoph Herrmann <developer@dragonprojects.de>
 * @package DragonJsonServerAvatarloginban
 */

namespace DragonJsonServerAvatarloginban;

/**
 * Klasse zur Initialisierung des Moduls
 */
class Module
{
    use \DragonJsonServer\ServiceManagerTrait;
	
    /**
     * Gibt die Konfiguration des Moduls zurück
     * @return array
     */
    public function getConfig()
    {
        return require __DIR__ . '/config/module.config.php';
    }

    /**
     * Gibt die Autoloaderkonfiguration des Moduls zurück
     * @return array
     */
    public function getAutoloaderConfig()
    {
        return [
            'Zend\Loader\StandardAutoloader' => [
                'namespaces' => [
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ],
            ],
        ];
    }
    
    /**
     * Wird bei der Initialisierung des Moduls aufgerufen
     * @param \Zend\ModuleManager\ModuleManager $moduleManager
     */
    public function init(\Zend\ModuleManager\ModuleManager $moduleManager)
    {
    	$sharedManager = $moduleManager->getEventManager()->getSharedManager();
    	$sharedManager->attach('DragonJsonServerAvatar\Module', 'LoadAvatar', 
	    	function (\DragonJsonServerAvatar\Event\LoadAvatar $eventLoadAvatar) {
	    		$serviceAvatarloginban = $this->getServiceManager()->get('\DragonJsonServerAvatarloginban\Service\Avatarloginban');
	    		$avatarloginban = $serviceAvatarloginban->getAvatarloginbanByAvatarId($eventLoadAvatar->getAvatar()->getAvatarId(), false);
	    		if (null === $avatarloginban) {
	    			return;
	    		}
	    		throw new \DragonJsonServer\Exception('avatarloginban', ['avatarloginban' => $avatarloginban->toArray()]);
	    	}
    	);
    	$sharedManager->attach('DragonJsonServerAvatar\Service\Avatar', 'RemoveAvatar', 
	    	function (\DragonJsonServerAvatar\Event\RemoveAvatar $eventRemoveAvatar) {
	    		$serviceAvatarloginban = $this->getServiceManager()->get('\DragonJsonServerAvatarloginban\Service\Avatarloginban');
	    		$avatarloginban = $serviceAvatarloginban->getAvatarloginbanByAvatarId($eventRemoveAvatar->getAvatar()->getAvatarId(), false);
	    		if (null === $avatarloginban) {
	    			return;
	    		}
	    		$serviceAvatarloginban->removeAvatarloginban($avatarloginban);
	    	}
    	);
    }
}
