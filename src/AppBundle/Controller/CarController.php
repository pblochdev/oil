<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Car;
use AppBundle\Entity\DefaultCar;
use AppBundle\Form\CarType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class CarController extends Controller 
{
    /**
     * @Route("/cars", name="car_list")
     */
    public function indexAction(Request $request)
    {
        $repository = $this->getDoctrine()->getRepository(Car::class);
		$user = $this->getUser();
		
		$cars = $repository->findBy(
			array('user' => $user->getId()),
			array('id' => 'ASC')
		);
		
        return $this->render('oil/index.html.twig', array(
			'cars' => $cars
        ));
    }
	
	/**
     * @Route("/cars/add", name="car_add")
     */
	public function addAction(Request $request)
	{
		$car = new Car();
		$form = $this->createForm(new CarType(), $car);
		
		if ($request->isMethod('POST'))
		{
			$form->handleRequest($request);
			
			if ($form->isValid())
			{
				$user = $this->getUser();
				$car->setUser($user);
				
				$em = $this->getDoctrine()->getManager();
				$em->persist($car);
				$em->flush();
				
				$defaultCar = $em->getRepository(DefaultCar::class)->findOneByUserId($user->getId());
				
				if (empty($defaultCar))
				{
					$defaultCar = new DefaultCar();
					$defaultCar->setCarId($car);
					$defaultCar->setUserId($user);
					
					$em->persist($defaultCar);
					$em->flush();
				}
				
				
				$this->addFlash('succes', 'Samochód dodany');

				return $this->redirectToRoute('car_list');
			}
		}
		
		
		return $this->render('oil/add.html.twig', array(
			'form' => $form->createView()
        ));
	}
	
	
	/**
	 * @Route("/cars/make-default/{id}", name="car_default")
	 */
	public function makeDefaultAction($id)
	{
		$user = $this->getUser();
		$em = $this->getDoctrine()->getManager();
		
		$car = $em->getRepository(Car::class)->findOneById($id);
		
		$defaultCar = $em->getRepository(DefaultCar::class)->findOneById($user->getId());
		
		if (!$defaultCar)
		{
			throw new Exception('Nie ma takiego samochodu!');
		}
		
		$defaultCar->setCarId($car);
		
		$em->persist($defaultCar);
		$em->flush();
		
		return $this->redirectToRoute('car_list');
	}
}