<?php

namespace Coyote\ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * User
 * @ORM\Entity
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
    * @ORM\OneToOne(targetEntity="Position")
    * @ORM\JoinColumn(name="position_id", referencedColumnName="id")
    */
    private $position;

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
     * @param \Coyote\ApiBundle\Entity\Position $position
     * @return User
     */
    public function setPosition(\Coyote\ApiBundle\Entity\Position $position = null)
    {
        $this->position = $position;

        return $this;
    }

    /**
     * Get position
     *
     * @return \Coyote\ApiBundle\Entity\Position 
     */
    public function getPosition()
    {
        return $this->position;
    }
}
