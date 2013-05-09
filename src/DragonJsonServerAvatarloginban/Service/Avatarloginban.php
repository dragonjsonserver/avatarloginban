<?php
/**
 * @link http://dragonjsonserver.de/
 * @copyright Copyright (c) 2012-2013 DragonProjects (http://dragonprojects.de/)
 * @license http://license.dragonprojects.de/dragonjsonserver.txt New BSD License
 * @author Christoph Herrmann <developer@dragonprojects.de>
 * @package DragonJsonServerAvatarloginban
 */

namespace DragonJsonServerAvatarloginban\Service;

/**
 * Serviceklasse zur Verwaltung von Avatarloginbanns
 */
class Avatarloginban
{
	use \DragonJsonServer\ServiceManagerTrait;
	use \DragonJsonServer\EventManagerTrait;
	use \DragonJsonServerDoctrine\EntityManagerTrait;

	/**
	 * Erstellt einen Avatarloginbann für die AvatarID
	 * @param integer $avatar_id
	 * @param \DateTime $end
	 * @return \DragonJsonServerAvatarloginban\Entity\Avatarloginban
	 */
	public function createAvatarloginban($avatar_id, \DateTime $end)
	{
		$avatarloginban = $this->getAvatarloginbanByAvatarId($avatar_id, false);
		if (null === $avatarloginban) {
			$avatarloginban = (new \DragonJsonServerAvatarloginban\Entity\Avatarloginban())
				->setAvatarId($avatar_id)
				->setEnd($end);
		} else {
			$avatarloginban->setEnd($end);
		}
		$this->getServiceManager()->get('Doctrine')->transactional(function ($entityManager) use ($avatarloginban) {
			$entityManager->persist($avatarloginban);
			$entityManager->flush();
			$this->getEventManager()->trigger(
				(new \DragonJsonServerAvatarloginban\Event\CreateAvatarloginban())
					->setTarget($this)
					->setAvatarloginban($avatarloginban)
			);
		});
		return $avatarloginban;
	}
	
	/**
	 * Entfernt den übergebenen Avatarloginbann
	 * @param \DragonJsonServerAvatarloginban\Entity\Avatarloginban $avatarloginban
	 * @return Avatarloginban
	 */
	public function removeAvatarloginban(\DragonJsonServerAvatarloginban\Entity\Avatarloginban $avatarloginban)
	{
		$this->getServiceManager()->get('Doctrine')->transactional(function ($entityManager) use ($avatarloginban) {
			$this->getEventManager()->trigger(
				(new \DragonJsonServerAvatarloginban\Event\RemoveAvatarloginban())
					->setTarget($this)
					->setAvatarloginban($avatarloginban)
			);
			$entityManager->remove($avatarloginban);
			$entityManager->flush();
		});
	}
	
	/**
	 * Gibt den aktuellen Avatarloginbann für die AvatarID zurück
	 * @param integer $avatar_id
	 * @param boolean $throwException
	 * @return \DragonJsonServerAvatarloginban\Entity\Avatarloginban|null
     * @throws \DragonJsonServer\Exception
	 */
	public function getAvatarloginbanByAvatarId($avatar_id, $throwException = true)
	{
		$entityManager = $this->getEntityManager();

		$conditions = ['avatar_id' => $avatar_id];
		$avatarloginban = $entityManager
			->getRepository('\DragonJsonServerAvatarloginban\Entity\Avatarloginban')
			->findOneBy($conditions);
		if (null === $avatarloginban) {
			if ($throwException) {
				throw new \DragonJsonServer\Exception('invalid avatar_id', $conditions);
			}
			return;
		}
		if ($avatarloginban->getEndTimestamp() < time()) {
			$this->removeAvatarloginban($avatarloginban);
			return;
		}
		return $avatarloginban;
	}
}
