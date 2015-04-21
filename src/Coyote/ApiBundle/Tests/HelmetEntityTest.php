<?php
namespace Coyote\ApiBundle\Tests;

use Coyote\ApiBundle\Entity\Helmet;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class HelmetEntityTest extends WebTestCase
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

    private function newHelmet()
    {
    	$helmet = new Helmet();
    	$helmet->setName('Michel');
    	$helmet->setLevel("12");
    	$helmet->setRarity("32");
    	$helmet->setWeight(1.75);
    	$helmet->setCreatedAt(new \DateTime(NOW));
    	return $helmet;
    }
    
    public function testNewHelmet()
    {
        $em = $this->getEntityManager();
        $helmet = $this->newHelmet();
        $em->persist($helmet) ;
        $em->flush();

        $helmet_verif = $em->getRepository('CoyoteApiBundle:Helmet')->findOneById($helmet->getId());
        $this->assertEquals($helmet_verif, $helmet);
    }
    
    public function testUpdateHelmet()
    {
    	$em = $this->getEntityManager();
    	$helmet = $this->newHelmet();
    	$em->persist($helmet);
    	$em->flush();
    	
    	$helmet_recup = $em->getRepository('CoyoteApiBundle:Helmet')->findOneById($helmet->getId());
    	$helmet_recup->setName('Paul');
    	$helmet_recup->setUpdatedAt(new \DateTime(NOW));
    	$em->persist($helmet_recup);
    	$em->flush();
    	
    	$helmet_verif = $em->getRepository('CoyoteApiBundle:Helmet')->findOneById($helmet_recup->getId());
    	$this->assertEquals($helmet_verif->getName(), $helmet_recup->getName());
    }
    
    public function testRemoveHelmet()
    {
    	$em = $this->getEntityManager();
    	$helmet = $this->newHelmet();
    	$em->persist($helmet);
    	$em->flush();
    	
    	$helmet_id = $helmet->getId();
    	
    	$em->remove($helmet);
    	$em->flush();
    	
    	$helmet_remove = $em->getRepository('CoyoteApiBundle:Helmet')->findOneById($helmet_id);
    	$this->assertNull($helmet_remove);
    }
}