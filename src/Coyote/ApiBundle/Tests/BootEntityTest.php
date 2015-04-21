<?php
namespace Coyote\ApiBundle\Tests;

use Coyote\ApiBundle\Entity\Boot;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class BootEntityTest extends WebTestCase
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

    private function newBoot()
    {
    	$boot = new Boot();
    	$boot->setName('Patrick');
    	$boot->setLevel("1");
    	$boot->setRarity("23");
    	$boot->setWeight(1.69);
    	$boot->setCreatedAt(new \DateTime(NOW));
    	return $boot;
    }
    
    public function testNewBoot()
    {
        $em = $this->getEntityManager();
        $boot = $this->newBoot();
        $em->persist($boot) ;
        $em->flush();

        $boot_verif = $em->getRepository('CoyoteApiBundle:Boot')->findOneById($boot->getId());
        $this->assertEquals($boot_verif, $boot);
    }
    
    public function testUpdateBoot()
    {
    	$em = $this->getEntityManager();
    	$boot = $this->newBoot();
    	$em->persist($boot);
    	$em->flush();
    	
    	$boot_recup = $em->getRepository('CoyoteApiBundle:Boot')->findOneById($boot->getId());
    	$boot_recup->setName('Jean-Claude');
    	$boot_recup->setUpdatedAt(new \DateTime(NOW));
    	$em->persist($boot_recup);
    	$em->flush();
    	
    	$boot_verif = $em->getRepository('CoyoteApiBundle:Boot')->findOneById($boot_recup->getId());
    	$this->assertEquals($boot_verif->getName(), $boot_recup->getName());
    }
    
    public function testRemoveBoot()
    {
    	$em = $this->getEntityManager();
    	$boot = $this->newBoot();
    	$em->persist($boot);
    	$em->flush();
    	
    	$boot_id = $boot->getId();
    	
    	$em->remove($boot);
    	$em->flush();
    	
    	$boot_remove = $em->getRepository('CoyoteApiBundle:Boot')->findOneById($boot_id);
    	$this->assertNull($boot_remove);
    }
}