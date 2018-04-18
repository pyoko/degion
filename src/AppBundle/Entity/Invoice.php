<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use AppBundle\Entity\EntityInterface;

/**
 * Invoice
 *
 * @ORM\Table(name="invoice")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\InvoiceRepository")
 */
class Invoice implements EntityInterface
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
     * @ORM\Column(name="distance", type="integer")
     */
    private $distance;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="deadline", type="datetime")
     */
    private $deadline;

    /**
     * @var float
     *
     * @ORM\Column(name="cost", type="float")
     */
    private $cost;

    /**
     * One Invoice has One Pigeon.
     * 
     * @ORM\OneToOne(targetEntity="Pigeon")
     * @ORM\JoinColumn(name="pigeon_id", referencedColumnName="id")
     */
    private $pigeon;

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set distance
     *
     * @param integer $distance
     *
     * @return Invoice
     */
    public function setDistance($distance)
    {
        $this->distance = $distance;

        return $this;
    }

    /**
     * Get distance
     *
     * @return int
     */
    public function getDistance()
    {
        return $this->distance;
    }

    /**
     * Set deadline
     *
     * @param \DateTime $deadline
     *
     * @return Invoice
     */
    public function setDeadline($deadline)
    {
        $this->deadline = $deadline;

        return $this;
    }

    /**
     * Get deadline
     *
     * @return \DateTime
     */
    public function getDeadline()
    {
        return $this->deadline;
    }

    /**
     * Set cost
     *
     * @param float $cost
     *
     * @return Invoice
     */
    public function setCost($cost)
    {
        $this->cost = $cost;

        return $this;
    }

    /**
     * Get cost
     *
     * @return float
     */
    public function getCost()
    {
        return $this->cost;
    }

    /**
     * Set pigeon
     * 
     * @param EntityInterface $pigeon
     */
    public function setPigeon(EntityInterface $pigeon)
    {
        $this->pigeon = $pigeon;
    }

    /**
     * Get Pigeon
     * 
     * @return EntityInterface
     */
    public function getPigeon()
    {
        return $this->pigeon;
    }
}

