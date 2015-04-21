<?php
namespace Coyote\ApiBundle\Tests;

use Coyote\ApiBundle\Entity\Register;
use Coyote\ApiBundle\Entity\Guild;
use Coyote\ApiBundle\Entity\Perso;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class RegisterEntityTest extends WebTestCase
{

/**
    * @var \Doctrine\ORM\EntityManager
    */
    private $em;

    public function __construct()
    {
        self::bootKernel();
        $this->em = static ::$kernel->getContainer()->get('doctrine.orm.entity_manager');
    }

    /**
    * Enter description here ...
    * @return \Doctrine\ORM\EntityManager
    */
    protected function getEntityManager ()
    {
        return $this->em;
    }

    private function newRegister()
    {
    	$register = new Register();
    	$register->setLevel(10);
    	$register->setRank("Rang5");
    	$register->setCreatedAt(new \DateTime(NOW));
    	return $register;
    }
    
    public function testNewRegister()
    {
        $em = $this->getEntityManager();
        $register = $this->newRegister();
        $em->persist($register) ;
        $em->flush();

        $register_verif = $em->getRepository('CoyoteApiBundle:Register')->findOneById($register->getId());
        $this->assertEquals($register_verif, $register);
    }
    
    public function testUpdateRegister()
    {
    	$em = $this->getEntityManager();
    	$register = $this->newRegister();
    	$em->persist($register);
    	$em->flush();
    	
    	$register_recup = $em->getRepository('CoyoteApiBundle:Register')->findOneById($register->getId());
    	$register_recup->setRank('Rank6');
    	$register_recup->setUpdatedAt(new \DateTime(NOW));
    	$em->persist($register_recup);
    	$em->flush();
    	
    	$register_verif = $em->getRepository('CoyoteApiBundle:Register')->findOneById($register_recup->getId());
    	$this->assertEquals($register_verif->getRank(), $register_recup->getRank());
    }
    
    public function testRemoveRegister()
    {
    	$em = $this->getEntityManager();
    	$register = $this->newRegister();
    	$em->persist($register);
    	$em->flush();
    	
    	$register_id = $register->getId();
    	
    	$em->remove($register);
    	$em->flush();
    	
    	$register_remove = $em->getRepository('CoyoteApiBundle:Register')->findOneById($register_id);
    	$this->assertNull($register_remove);
    }
}