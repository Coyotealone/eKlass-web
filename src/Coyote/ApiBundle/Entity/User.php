<?php

namespace Coyote\ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * User
 * @ORM\Entity
 * @ORM\Table(name="user_eklass")
 * @ORM\Entity(repositoryClass="Coyote\ApiBundle\Entity\UserRepository");
 */
class User
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var integer
     * @ORM\Column(name="position", type="integer")
     */
    private $position;

    /**
     * @var integer
     *
     * @ORM\Column(name="status", type="integer")
     */
    private $status;

    /**
     * @var datetime
     *
     * @ORM\Column(name="postedat", type="datetime")
     */
    private $postedAt;

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
     * Set position
     *
     * @param integer $position
     * @return User
     */
    public function setPosition($position)
    {
        $this->position = $position;

        return $this;
    }

    /**
     * Get position
     *
     * @return integer
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * Set status
     *
     * @param integer $status
     * @return User
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return integer
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set postedAt
     *
     * @param \DateTime $postedAt
     * @return User
     */
    public function setPostedAt($postedAt)
    {
        $this->postedAt = $postedAt;

        return $this;
    }

    /**
     * Get postedAt
     *
     * @return \DateTime
     */
    public function getPostedAt()
    {
        return $this->postedAt;
    }
}
