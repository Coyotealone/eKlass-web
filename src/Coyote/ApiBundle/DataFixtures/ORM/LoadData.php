<?php

namespace Coyote\ApiBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Coyote\ApiBundle\Entity\BreakPoint;
use Coyote\ApiBundle\Entity\Position;

class LoadData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $em)
    {
        $position = new Position();
        $position->setLatitude("48.047007");
        $position->setLongitude("-1.742169");
        $position->setDirection("Bruz");

        $position1 = new Position();
        $position1->setLatitude("48.044712");
        $position1->setLongitude("-1.745945");
        $position1->setDirection("Bruz");

        $position2 = new Position();
        $position2->setLatitude("48.052613");
        $position2->setLongitude("-1.738595");
        $position2->setDirection("Rennes");

        $position3 = new Position();
        $position3->setLatitude("48.049158");
        $position3->setLongitude("-1.740788");
        $position3->setDirection("Rennes");

        $em->persist($position);
        $em->persist($position1);
        $em->persist($position2);
        $em->persist($position3);

        $em->flush();

        $break_point = new BreakPoint();
        $break_point->setName("Arret1");
        $break_point->setPosition($position);

        $break_point1 = new BreakPoint();
        $break_point1->setName("Arret2");
        $break_point1->setPosition($position1);

        $break_point2 = new BreakPoint();
        $break_point2->setName("Arret3");
        $break_point2->setPosition($position2);

        $break_point3 = new BreakPoint();
        $break_point3->setName("Arret4");
        $break_point3->setPosition($position3);

        $em->persist($break_point);
        $em->persist($break_point1);
        $em->persist($break_point2);
        $em->persist($break_point3);

        $em->flush();
    }

    public function getOrder()
    {
        return 8; // the order in which fixtures will be loaded
    }

}