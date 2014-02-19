<?php
/**
 * @link http://dragonjsonserver.de/
 * @copyright Copyright (c) 2012-2014 DragonProjects (http://dragonprojects.de/)
 * @license http://license.dragonprojects.de/dragonjsonserver.txt New BSD License
 * @author Christoph Herrmann <developer@dragonprojects.de>
 * @package DragonJsonServerAvatarloginban
 */

namespace DragonJsonServerAvatarloginban\Event;

/**
 * Eventklasse für die Entfernung eines Avatarloginbanns
 */
class RemoveAvatarloginban extends \Zend\EventManager\Event
{
	/**
	 * @var string
	 */
	protected $name = 'RemoveAvatarloginban';

    /**
     * Setzt den Avatarloginbann der entfernt wird
     * @param \DragonJsonServerAvatarloginban\Entity\Avatarloginban $avatarloginban
     * @return RemoveAvatarloginban
     */
    public function setAvatarloginban(\DragonJsonServerAvatarloginban\Entity\Avatarloginban $avatarloginban)
    {
        $this->setParam('avatarloginban', $avatarloginban);
        return $this;
    }

    /**
     * Gibt den Avatarloginbann der entfernt wird zurück
     * @return \DragonJsonServerAvatarloginban\Entity\Avatarloginban
     */
    public function getAvatarloginban()
    {
        return $this->getParam('avatarloginban');
    }
}
