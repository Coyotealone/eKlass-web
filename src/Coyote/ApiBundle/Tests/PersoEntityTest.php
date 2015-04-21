<?php
namespace Coyote\ApiBundle\Tests;

use Coyote\ApiBundle\Entity\Perso;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class PersoEntityTest extends WebTestCase
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

    private function newPerso()
    {
    	$perso = new Perso();
    	$perso->setName('Bichon');
    	$perso->setCreatedAt(new \DateTime(NOW));
    	$perso->setClass("Paladin");
    	$perso->setLevel("10");
    	$perso->setRace("Troll");
    	$perso->setSexe("Masculin");
    	return $perso;
    }
    
    public function testNewPerso()
    {
        $em = $this->getEntityManager();
        $perso = $this->newPerso();
        $em->persist($perso) ;
        $em->flush();

        $perso_verif = $em->getRepository('CoyoteApiBundle:Perso')->findOneById($perso->getId());
        $this->assertEquals($perso_verif, $perso);
    }
    
    public function testUpdatePerso()
    {
    	$em = $this->getEntityManager();
    	$perso = $this->newPerso();
    	$em->persist($perso);
    	$em->flush();
    	
    	$perso_recup = $em->getRepository('CoyoteApiBundle:Perso')->findOneById($perso->getId());
    	$perso_recup->setName('Lort');
    	$perso_recup->setUpdatedAt(new \DateTime(NOW));
    	$em->persist($perso_recup);
    	$em->flush();
    	
    	$perso_verif = $em->getRepository('CoyoteApiBundle:Perso')->findOneById($perso_recup->getId());
    	$this->assertEquals($perso_verif->getName(), $perso_recup->getName());
    }
    
    public function testRemovePerso()
    {
    	$em = $this->getEntityManager();
    	$perso = $this->newPerso();
    	$em->persist($perso);
    	$em->flush();
    	
    	$perso_id = $perso->getId();
    	
    	$em->remove($perso);
    	$em->flush();
    	
    	$perso_remove = $em->getRepository('CoyoteApiBundle:Perso')->findOneById($perso_id);
    	$this->assertNull($perso_remove);
    }
}