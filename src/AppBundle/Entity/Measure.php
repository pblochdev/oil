<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Measure
 *
 * @ORM\Table(name="measure")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\MeasureRepository")
 */
class Measure
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
     * @var string
     *
     * @ORM\Column(name="price", type="decimal", precision=2, scale=0)
     */
    private $price;

    /**
     * @var string
     *
     * @ORM\Column(name="totalPrice", type="decimal", precision=2, scale=0)
     */
    private $totalPrice;

    /**
     * @var string
     *
     * @ORM\Column(name="km", type="decimal", precision=2, scale=0)
     */
    private $km;

    /**
     * @var string
     *
     * @ORM\Column(name="liter", type="decimal", precision=2, scale=0)
     */
    private $liter;


	/**
     * @ORM\ManyToOne(targetEntity="Car", inversedBy="measures")
     * @ORM\JoinColumn(name="car_id", referencedColumnName="id")
    */
	private $car;
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
     * Set price
     *
     * @param integer $price
     * @return Measure
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return integer 
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set totalPrice
     *
     * @param string $totalPrice
     * @return Measure
     */
    public function setTotalPrice($totalPrice)
    {
        $this->totalPrice = $totalPrice;

        return $this;
    }

    /**
     * Get totalPrice
     *
     * @return string 
     */
    public function getTotalPrice()
    {
        return $this->totalPrice;
    }

    /**
     * Set km
     *
     * @param string $km
     * @return Measure
     */
    public function setKm($km)
    {
        $this->km = $km;

        return $this;
    }

    /**
     * Get km
     *
     * @return string 
     */
    public function getKm()
    {
        return $this->km;
    }

    /**
     * Set liter
     *
     * @param string $liter
     * @return Measure
     */
    public function setLiter($liter)
    {
        $this->liter = $liter;

        return $this;
    }

    /**
     * Get liter
     *
     * @return string 
     */
    public function getLiter()
    {
        return $this->liter;
    }
}
