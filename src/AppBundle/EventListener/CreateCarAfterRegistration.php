<?php

namespace AppBundle\EventListener;

use AppBundle\Entity\Car;
use AppBundle\Entity\DefaultCar;
use Doctrine\ORM\EntityManager;
use FOS\UserBundle\Event\FilterUserResponseEvent;
use FOS\UserBundle\FOSUserEvents;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;

class CreateCarAfterRegistration implements EventSubscriberInterface
{
	protected $user;
	
	protected $tokenStorage;
	
	protected $em;
	
	protected $container;
	
	protected $request;


	public function __construct(EntityManager $entityManager) 
	{
		$this->em = $entityManager;
	}
	
	public function onRegistrationCompleted(FilterUserResponseEvent $event)
	{
		$car = new Car();
		$car->setUser($event->getUser());
		$car->setName('Domyślny');
		$this->em->persist($car);
		$this->em->flush();
		
		$defaultCar = new DefaultCar();
		$defaultCar->setCarId($car);
		$defaultCar->setUserId($event->getUser());

		$this->em->persist($defaultCar);
		$this->em->flush();
		
	}
	
	
	public static function getSubscribedEvents() {
		return array(
			FOSUserEvents::REGISTRATION_COMPLETED => 'onRegistrationCompleted'
		);
	}

}
