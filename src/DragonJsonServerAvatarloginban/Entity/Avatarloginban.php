<?php
/**
 * @link http://dragonjsonserver.de/
 * @copyright Copyright (c) 2012-2013 DragonProjects (http://dragonprojects.de/)
 * @license http://license.dragonprojects.de/dragonjsonserver.txt New BSD License
 * @author Christoph Herrmann <developer@dragonprojects.de>
 * @package DragonJsonServerAvatarloginban
 */

namespace DragonJsonServerAvatarloginban\Entity;

/**
 * Entityklasse eines Avatarloginbanns
 * @Doctrine\ORM\Mapping\Entity
 * @Doctrine\ORM\Mapping\Table(name="avatarloginbans")
 */
class Avatarloginban
{
	use \DragonJsonServerDoctrine\Entity\CreatedTrait;
	use \DragonJsonServerAvatar\Entity\AvatarIdTrait;
	
	/**
	 * @Doctrine\ORM\Mapping\Id 
	 * @Doctrine\ORM\Mapping\Column(type="integer")
	 * @Doctrine\ORM\Mapping\GeneratedValue
	 **/
	protected $avatarloginban_id;
	
	/**
	 * @Doctrine\ORM\Mapping\Column(type="datetime")
	 **/
	protected $end;
	
	/**
	 * Gibt die ID des Avatarloginbanns zurück
	 * @return integer
	 */
	public function getAvatarloginbanId()
	{
		return $this->avatarloginban_id;
	}
	
	/**
	 * Setzt den Endzeitpunkt des Avatarloginbanns
	 * @param \DateTime $end
	 */
	public function setEnd(\DateTime $end)
	{
		$this->end = $end;
		return $this;
	}
	
	/**
	 * Setzt den Endzeitpunkt des Avatarloginbanns als Unix Timestamp
	 * @param integer $end
	 */
	public function setEndTimestamp($end)
	{
		$this->setEnd((new \DateTime())->setTimestamp($end));
		return $this;
	}
	
	/**
	 * Gibt den Endzeitpunkt des Avatarloginbanns zurück
	 * @return \DateTime
	 */
	public function getEnd()
	{
		return $this->end;
	}
	
	/**
	 * Gibt den Endzeitpunkt des Avatarloginbanns als Unix Timestamp zurück
	 * @return \DateTime
	 */
	public function getEndTimestamp()
	{
		$end = $this->getEnd();
		if (null === $end) {
			return;
		}
		return $end->getTimestamp();
	}
	
	/**
	 * Gibt die Attribute des Avatarloginbanns als Array zurück
	 * @return array
	 */
	public function toArray()
	{
		return [
			'avatarloginban_id' => $this->getAvatarloginbanId(),
			'created' => $this->getCreatedTimestamp(),
			'avatar_id' => $this->getAvatarId(),
			'end' => $this->getEndTimestamp(),
		];
	}
}
