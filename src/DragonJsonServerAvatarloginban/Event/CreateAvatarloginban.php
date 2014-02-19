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
 * Eventklasse für die Erstellung eines Avatarloginbanns
 */
class CreateAvatarloginban extends \Zend\EventManager\Event
{
	/**
	 * @var string
	 */
	protected $name = 'CreateAvatarloginban';

    /**
     * Setzt den Avatarloginbann der erstellt wurde
     * @param \DragonJsonServerAvatarloginban\Entity\Avatarloginban $avatarloginban
     * @return CreateAvatarloginban
     */
    public function setAvatarloginban(\DragonJsonServerAvatarloginban\Entity\Avatarloginban $avatarloginban)
    {
        $this->setParam('avatarloginban', $avatarloginban);
        return $this;
    }

    /**
     * Gibt den Avatarloginbann der erstellt wurde zurück
     * @return \DragonJsonServerAvatarloginban\Entity\Avatarloginban
     */
    public function getAvatarloginban()
    {
        return $this->getParam('avatarloginban');
    }
}
