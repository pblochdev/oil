<?php


namespace AppBundle\Controller;

use AppBundle\Entity\DefaultCar;
use AppBundle\Entity\Measure;
use AppBundle\Form\MeasureType;
use Exception;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


class MeasureController extends Controller
{
	
	/**
	 * @Route("/measure", name="measure_list")
	 */
	public function indexAction()
	{
		$user = $this->getUser();
		
		$em = $this->getDoctrine()->getManager();
		
		$defaultCar = $em->getRepository(DefaultCar::class)->findOneByUserId($user->getId());
		
		$repository = $this->getDoctrine()->getRepository(Measure::class);
		
		$measures = $repository->findBy(
			array('car' => $defaultCar->getCarId()),
			array('id' => 'ASC')
		);
		
        return $this->render('measure/index.html.twig', array(
			'measures' => $measures
        ));
	}
	
	
	/**
	 * @Route("/measure/add", name="measure_add")
	 */
	public function addAction(Request $request)
	{
		$measure = new Measure();
		$form = $this->createForm(new MeasureType, $measure);
		
		$em = $this->getDoctrine()->getManager();
		
		$defaultCar = $em->getRepository(DefaultCar::class)->findOneByUserId($this->getUser()->getId());
		
		if (!$defaultCar)
		{
			throw new Exception('Nie ma przypisanego samochodu');
		}
		
		$form->handleRequest($request);
		
		if ($form->isValid())
		{
			
			$measure->setCar($defaultCar->getCarId());
			$em->persist($measure);
			$em->flush();

			$this->addFlash('succes', 'Pomiar dodany');

			return $this->redirectToRoute('measure_add');
		}
		
		return $this->render('measure/add.html.twig', array(
			'form' => $form->createView(),
			'currentCar' => $defaultCar->getCarId()->getName(),
		));
	}
}