<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * DefaultCar
 *
 * @ORM\Table(name="default_car")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\DefaultCarRepository")
 */
class DefaultCar
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
	
	
	/**
	* @var int
    *
     * @ORM\OneToOne(targetEntity="Car", inversedBy="defaultCar")
    * @ORM\JoinColumn(name="car_id", referencedColumnName="id")
    */
    private $carId;
	
	
	/**
	* @var int
	* 
    * @ORM\OneToOne(targetEntity="User", inversedBy="defaultCar")
    * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
    */
    private $userId;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set userId
     *
     * @param integer $userId
     * @return DefaultCar
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;

        return $this;
    }

    /**
     * Get userId
     *
     * @return integer 
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Set carId
     *
     * @param integer $carId
     * @return DefaultCar
     */
    public function setCarId($carId)
    {
        $this->carId = $carId;

        return $this;
    }

    /**
     * Get carId
     *
     * @return integer 
     */
    public function getCarId()
    {
        return $this->carId;
    }
	
	
	public function __toString() 
	{
		return 'Aktywny samochód';
	}
}
