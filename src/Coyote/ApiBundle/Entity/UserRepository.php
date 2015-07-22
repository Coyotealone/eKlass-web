<?php

namespace Coyote\ApiBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * PositionRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class UserRepository extends EntityRepository
{

    public function findAllStatusUp()
    {
        return $this->findPosition1StatusUp().';'.$this->findPosition2StatusUp().';'.$this->findPosition3StatusUp().';'.$this->findPosition4StatusUp();
    }

    public function findPosition1StatusUp()
    {
        $entities = $this->findBy(array('status' => 1, 'position' => 1), array());
        return count($entities);
    }

    public function findPosition2StatusUp()
    {
        $entities = $this->findBy(array('status' => 1, 'position' => 2), array());
        return count($entities);
    }

    public function findPosition3StatusUp()
    {
        $entities = $this->findBy(array('status' => 1, 'position' => 3), array());
        return count($entities);
    }

    public function findPosition4StatusUp()
    {
        $entities = $this->findBy(array('status' => 1, 'position' => 4), array());
        return count($entities);
    }
}
