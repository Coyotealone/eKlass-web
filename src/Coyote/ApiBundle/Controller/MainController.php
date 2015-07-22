<?php

namespace Coyote\ApiBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\Security\Core\SecurityContextInterface;

use Coyote\ApiBundle\Entity\Position;

use Doctrine\ORM\EntityRepository;


/**
 * Main controller.
 *
 */
class MainController extends Controller
{
    /**
     * @access public
     * @return \Symfony\Component\HttpFoundation\Response|\Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function testAction()
    {
        $db = $this->getDoctrine()->getManager()->getConnection();

        $latitude_point1 = "48.427395";
        $longitude_point1 = "-4.4333391";

        $sql = "Select st_distance('POINT(".$latitude_point1." ".$longitude_point1.")'::geography,
  'POINT(48.427502 -4.4332842)'::geography) AS d;";
        $box = $db->query($sql)->fetchColumn();

        $box = number_format($box,0);

        $message = "Vous n'êtes pas au point d'arrêt.";
        $message2 = "Vous êtes en attente d'un véhicule.";

        if($box > 20)
            return new Response($message." : A".$box."m du point.");
        else
            return new Response($message2." : A".$box."m du point.");
        //$test = $em->getRepository('CoyoteApiBundle:Position')->test();
        /** update status from Expense */

    }
}