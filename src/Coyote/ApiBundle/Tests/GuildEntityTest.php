<?php
namespace Coyote\ApiBundle\Tests;

use Coyote\ApiBundle\Entity\Guild;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class GuildEntityTest extends WebTestCase
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

    private function newGuild()
    {
    	$guild = new Guild();
    	$guild->setBanner("Banniere");
    	$guild->setName("DrinkNoMore");
    	$guild->setCreatedAt(new \DateTime(NOW));
    	return $guild;
    }
    
    public function testNewGuild()
    {
        $em = $this->getEntityManager();
        $guild = $this->newGuild();
        $em->persist($guild) ;
        $em->flush();

        $guild_verif = $em->getRepository('CoyoteApiBundle:Guild')->findOneById($guild->getId());
        $this->assertEquals($guild_verif, $guild);
    }
    
    public function testUpdateGuild()
    {
    	$em = $this->getEntityManager();
    	$guild = $this->newGuild();
    	$em->persist($guild);
    	$em->flush();
    	
    	$guild_recup = $em->getRepository('CoyoteApiBundle:Guild')->findOneById($guild->getId());
    	$guild_recup->setBanner('Jean-Claude');
    	$guild_recup->setUpdatedAt(new \DateTime(NOW));
    	$em->persist($guild_recup);
    	$em->flush();
    	
    	$guild_verif = $em->getRepository('CoyoteApiBundle:Guild')->findOneById($guild_recup->getId());
    	$this->assertEquals($guild_verif->getName(), $guild_recup->getName());
    }
    
    public function testRemoveGuild()
    {
    	$em = $this->getEntityManager();
    	$guild = $this->newGuild();
    	$em->persist($guild);
    	$em->flush();
    	
    	$guild_id = $guild->getId();
    	
    	$em->remove($guild);
    	$em->flush();
    	
    	$guild_remove = $em->getRepository('CoyoteApiBundle:Guild')->findOneById($guild_id);
    	$this->assertNull($guild_remove);
    }
}