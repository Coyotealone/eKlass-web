<?php

namespace Coyote\ApiBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\Annotations\Get;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Coyote\ApiBundle\Entity\User;
use Coyote\ApiBundle\Entity\Position;
use Coyote\ApiBundle\Entity\BreakPoint;
use Coyote\ApiBundle\Form\UserType;
use Coyote\ApiBundle\Form\PositionType;
use Coyote\ApiBundle\Form\BreakPointType;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\Security\Core\SecurityContextInterface;

class DefaultRestController extends FOSRestController
{
    /**
     * @Rest\Get("user")
     * @ApiDoc(
     *      section="User Entity",
     *      description="Get all user from database",
     *      statusCodes = {
     *          200 = "OK",
     *          201 = "Created",
     *          204 = "No Content",
     *          404 = "Not Found",
     *          406 = "Not Acceptable",
     *      }
     * )
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getAllUserAction()
    {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository("CoyoteApiBundle:User")->findAll();
        if (count($entity) > 0)
        {
            $view = $this->view(array(
                            "Users" => $entity
            ),200);
        }
        else
        {
            $view = $this->view(array(
                            "No User" => $entity
            ),204);
        }
        return $this->handleView($view);
    }

    /**
     * @Rest\Get("user_status")
     * @ApiDoc(
     *      section="User Entity",
     *      description="Get all user from database where status is 1",
     *      statusCodes = {
     *          200 = "OK",
     *          201 = "Created",
     *          204 = "No Content",
     *          404 = "Not Found",
     *          406 = "Not Acceptable",
     *      }
     * )
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getAllUserStatusAction()
    {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository("CoyoteApiBundle:User")->findAllStatusUp();
        if (count($entity) > 0)
        {
            $view = $this->view(array(
                            "Users Status" => $entity
            ),200);
        }
        else
        {
            $view = $this->view(array(
                            "Users Status" => $entity
            ),204);
        }
        return $this->handleView($view);
    }

    /**
     * @Rest\Get("position")
     * @ApiDoc(
     *      section="Position Entity",
     *      description="Get all position from database",
     *      statusCodes = {
     *          200 = "OK",
     *          201 = "Created",
     *          204 = "No Content",
     *          404 = "Not Found",
     *          406 = "Not Acceptable",
     *      }
     * )
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getAllPositionAction()
    {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository("CoyoteApiBundle:Position")->findAll();
        if (count($entity) > 0)
        {
            $view = $this->view(array(
                            "Positions" => $entity
            ),200);
        }
        else
        {
            $view = $this->view(array(
                            "No Position" => $entity
            ),204);
        }
        return $this->handleView($view);
    }

    /**
     * @Rest\Get("user/{id}")
     * @ApiDoc(
     *      section="User Entity",
     *      description="Get user by id from database",
     *      statusCodes = {
     *          200 = "OK",
     *          201 = "Created",
     *          204 = "No Content",
     *          404 = "Not Found",
     *          406 = "Not Acceptable",
     *      }
     * )
     * @param integer $id Id of the user instance.
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getUserByIdAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository("CoyoteApiBundle:User")->findOneById($id);
        if ($entity)
        {
            $view = $this->view(array(
                            "User" => $entity
            ),200);
        }
        else
        {
            $view = $this->view(array(
                            "No User" => $entity
            ),204);
        }
        return $this->handleView($view);
    }

    /**
     * @Rest\Get("position/{id}")
     * @ApiDoc(
     *      section="Position Entity",
     *      description="Get position by id from database",
     *      statusCodes = {
     *          200 = "OK",
     *          201 = "Created",
     *          204 = "No Content",
     *          404 = "Not Found",
     *          406 = "Not Acceptable",
     *      }
     * )
     * @param integer $id Id of the position instance.
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getPositionByIdAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository("CoyoteApiBundle:Position")->findOneById($id);
        if ($entity)
        {
            $view = $this->view(array(
                            "Position" => $entity
            ),200);
        }
        else
        {
            $view = $this->view(array(
                            "No Position" => $entity
            ),204);
        }
        return $this->handleView($view);
    }

    /**
     * @Rest\Get("all_break_point")
     * @ApiDoc(
     *      section="Break Point Entity",
     *      description="Get all break point from database",
     *      statusCodes = {
     *          200 = "OK",
     *          204 = "No Content",
     *          406 = "Not Acceptable",
     *      }
     * )
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getAllBreakPointAction()
    {
        $em = $this->getDoctrine()->getManager();
        $datas = $em->getRepository("CoyoteApiBundle:BreakPoint")->findAll();
        if (count($datas) > 0)
        {
            $view = $this->view(array(
                            "BreakPoint" => $datas
            ),200);
        }
        else
        {
            $view = $this->view(array(
                            "message" => "Empty Data"
            ),204);
        }
        return $this->handleView($view);
    }

    /**
     * @Rest\Get("breakpoint/{id}")
     * @ApiDoc(
     *      section="BreakPoint Entity",
     *      description="Get breakpoint by id from database",
     *      statusCodes = {
     *          200 = "OK",
     *          201 = "Created",
     *          204 = "No Content",
     *          404 = "Not Found",
     *          406 = "Not Acceptable",
     *      }
     * )
     * @param integer $id Id of the position instance.
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getBreakPointByIdAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository("CoyoteApiBundle:BreakPoint")->findOneById($id);
        if ($entity)
        {
            $view = $this->view(array(
                            "BreakPoint" => $entity
            ),200);
        }
        else
        {
            $view = $this->view(array(
                            "No break point" => $entity
            ),204);
        }
        return $this->handleView($view);
    }

    /**
     * @Rest\Put("user")
     * @ApiDoc(
     *      requirements = {
     *      {
     *          "name" = "position",
     *          "dataType" = "integer",
     *          "requirement" = "1 | 2",
     *          "description" = "The id of the position"
     *      },
     *      {
     *          "name" = "status",
     *          "dataType" = "integer",
     *          "requirement" = "0 | 1",
     *          "description" = "Status 1 Up or 0 Down"
     *      },
     *      },
     *      section="User Entity",
     *      description="Insert new user into database",
     *      statusCodes = {
     *          200 = "OK",
     *          201 = "Created",
     *          204 = "No Content",
     *          406 = "Not Acceptable",
     *      }
     * )
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function putUserAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entity = new User();
        $form = $this->createForm(new UserType(), $entity,
                array('csrf_protection' => false,));
        $request = $this->getRequest()->request->all();
        $form->submit($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();
        }

        if ($entity->getId() > 0)
        {
            $view = $this->view(array(
                            "User create" => $entity
            ),200);
        }
        else{
            $view = $this->view(array(
                            "User not create" => $entity
            ),406);
        }
        return $this->handleView($view);
    }

    /**
     * @Rest\Put("position")
     * @ApiDoc(
     *      requirements = {
     *          {
     *              "name" = "latitude",
     *              "dataType" = "float",
     *              "requirement" = "48.1 | -48.1",
     *              "description" = "The latitude"
     *          },
     *          {
     *              "name" = "longitude",
     *              "dataType" = "float",
     *              "requirement" = "-1.667 | 1.667",
     *              "description" = "The longitude"
     *          },
     *          {
     *              "name" = "direction",
     *              "dataType" = "string",
     *              "requirement" = "Bruz | Rennes",
     *              "description" = "City"
     *          },
     *      },
     *      section="Position Entity",
     *      description="Insert new position into database",
     *      statusCodes = {
     *          200 = "OK",
     *          201 = "Created",
     *          204 = "No Content",
     *          406 = "Not Acceptable",
     *      }
     * )
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function putPositionAddAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entity = new Position();
        $form = $this->createForm(new PositionType(), $entity,
                array('csrf_protection' => false,));
        $request = $this->getRequest()->request->all();
        $form->submit($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();
        }

        if ($entity->getId() > 0)
        {
            $view = $this->view(array(
                            "Break Point create" => $entity
            ),200);
        }
        else{
            $view = $this->view(array(
                            "Break Point not create" => $entity
            ),406);
        }

        return $this->handleView($view);
    }

    /**
     * @Rest\Put("positionUser")
     * @ApiDoc(
     *      requirements = {
     *          {
     *              "name" = "latitude",
     *              "dataType" = "float",
     *              "requirement" = "48.1 | -48.1",
     *              "description" = "The latitude"
     *          },
     *          {
     *              "name" = "longitude",
     *              "dataType" = "float",
     *              "requirement" = "-1.667 | 1.667",
     *              "description" = "The longitude"
     *          },
     *          {
     *              "name" = "direction",
     *              "dataType" = "string",
     *              "requirement" = "Bruz | Rennes",
     *              "description" = "City"
     *          },
     *      },
     *      section="Position Entity",
     *      description="Check position into database",
     *      statusCodes = {
     *          200 = "OK",
     *          201 = "Created",
     *          204 = "No Content",
     *          406 = "Not Acceptable",
     *      }
     * )
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function putPositionAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entity = new Position();
        $form = $this->createForm(new PositionType(), $entity,
                array('csrf_protection' => false,));
        $request = $this->getRequest()->request->all();
        $form->submit($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();
        }

        $point = "";

        if ($entity->getId() > 0)
        {
            $db = $this->getDoctrine()->getManager()->getConnection();

            $break_point = $em->getRepository("CoyoteApiBundle:BreakPoint")->findAll();

            $entity_user = new User();

            if($entity->getDirection() == "Bruz")
            {
                foreach($break_point as $datas)
                {
                    if($datas->getPosition()->getDirection() == "Bruz")
                    {
                        $sql = "Select st_distance('POINT(".$datas->getPosition()->getLatitude()." ".$datas->getPosition()->getLongitude().")'::geography,
                            'POINT(".$entity->getLatitude()." ".$entity->getLongitude().")'::geography) AS d;";
                        $box = $db->query($sql)->fetchColumn();

                        if($box < 300)
                        {
                            //$position = $em->getRepository('CoyoteApiBundle:Position')->findOneById($datas->getPosition()->getId());
                            $entity_user->setPosition($datas->getPosition()->getId());
                            $entity_user->setStatus(1);
                            $entity_user->setPostedAt(new \DateTime('NOW'));
                            //$form_user = $this->createForm(new UserType(), $entity_user, array('csrf_protection' => false,));
                            //$request = $this->getRequest()->request->all();
                            //$form_user->submit($request);
                            //if ($form_user->isValid()) {
                                $em = $this->getDoctrine()->getManager();
                                $em->persist($entity_user);
                                $em->flush();
                            //}
                            //if($entity_user->getId() > 0)
                            //{
                            //    $point = $entity_user->getId();
                            //}
                        }
                    }
                }
            }

            if($entity->getDirection() == "Rennes")
            {
                foreach($break_point as $datas)
                {
                    if($datas->getPosition()->getDirection() == "Rennes")
                    {
                        $sql = "Select st_distance('POINT(".$datas->getPosition()->getLatitude()." ".$datas->getPosition()->getLongitude().")'::geography,
                            'POINT(".$entity->getLatitude()." ".$entity->getLongitude().")'::geography) AS d;";
                        $box = $db->query($sql)->fetchColumn();
                        if($box < 30)
                        {
                            //$position = $em->getRepository('CoyoteApiBundle:Position')->findOneById($datas->getPosition()->getId());
                            $entity_user->setPosition($datas->getPosition()->getId());
                            $entity_user->setStatus(1);
                            $entity_user->setPostedAt(new \DateTime('NOW'));
                            //$form_user = $this->createForm(new UserType(), $entity_user, array('csrf_protection' => false,));
                            //$request = $this->getRequest()->request->all();
                            //$form_user->submit($request);
                            //if ($form_user->isValid()) {
                                $em = $this->getDoctrine()->getManager();
                                $em->persist($entity_user);
                                $em->flush();
                            //}
                            /*if($entity_user->getId() > 0)
                            {
                                $point = $entity_user->getId();
                            }*/
                        }
                    }
                }
            }

            $message = "KO";//"Vous n etes pas a un point d arret.";
            $message2 = "OK";//"Vous etes en attente d un vehicule, au point d arret : ";

            $point = $entity_user->getId();

            if($point == "")
            {
                $view = $this->view(array(
                            "Position incorrecte" => $message
                            ),200);
            }
            else
            {    $view = $this->view(array(
                            "Position correcte" => $message2." ".$point
                            ),200);
            }
        }
        else
        {
            $view = $this->view(array(
                            "Position not create" => $entity
            ),406);
        }
        $em->remove($entity);
        $em->flush();

        return $this->handleView($view);
    }

    /**
     * @Rest\Put("break_point")
     * @ApiDoc(
     *      requirements = {
     *      {
     *          "name" = "name",
     *          "dataType" = "string",
     *          "requirement" = "Arret1|Arret2",
     *          "description" = "The name of break point"
     *      },
     *      {
     *          "name" = "position",
     *          "dataType" = "integer",
     *          "requirement" = "1 | 2",
     *          "description" = "The id of the position"
     *      },
     *      },
     *      section="Break Point Entity",
     *      description="Insert new break point into database",
     *      statusCodes = {
     *          200 = "OK",
     *          201 = "Created",
     *          204 = "No Content",
     *          406 = "Not Acceptable",
     *      }
     * )
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function putBreakPointAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entity = new BreakPoint();
        $form = $this->createForm(new BreakPointType(), $entity,
                array('csrf_protection' => false,));
        $request = $this->getRequest()->request->all();
        $form->submit($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();
        }

        if ($entity->getId() > 0)
        {
            $view = $this->view(array(
                            "Break Point create" => $entity
            ),200);
        }
        else{
            $view = $this->view(array(
                            "Break Point not create" => $entity
            ),406);
        }
        return $this->handleView($view);
    }

    /**
     * @Rest\Post("user/{id}")
     * @ApiDoc(
     *      requirements = {
     *      {
     *          "name" = "position",
     *          "dataType" = "integer",
     *          "requirement" = "1 | 2",
     *          "description" = "The id of the position"
     *      },
     *      {
     *          "name" = "status",
     *          "dataType" = "integer",
     *          "requirement" = "0 | 1",
     *          "description" = "Status 1 Up or 0 Down"
     *      },
     *      },
     *      section="User Entity",
     *      description="Update user into database",
     *      statusCodes = {
     *          200 = "OK",
     *          201 = "Created",
     *          204 = "No Content",
     *          406 = "Not Acceptable",
     *      }
     * )
     * @param integer $id Id of the user instance.
     * @return \Symfony\Component\HttpFoundation\Response
     */
    /*public function postUserAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository("CoyoteApiBundle:User")->findOneById($id);
        if (!$entity) {
            $view = $this->view(array(
                            "Not delete register" => $entity
            ),404);
        }
        else {
            $form = $this->createForm(new UserType(), $entity,
                    array('csrf_protection' => false,));
            $request = $this->getRequest()->request->all();
            $form->submit($request);

            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();

                $em->persist($entity);
                $em->flush();
            }

            if ($entity->getId() > 0)
            {
                $view = $this->view(array(
                                "User update" => $entity
                ),200);
            }
            else{
                $view = $this->view(array(
                                "User not update" => $entity
                ),406);
            }
        }
        return $this->handleView($view);
    }*/

    /**
     * @Rest\Post("position/{id}")
     * @ApiDoc(
     *      requirements = {
     *      {
     *          "name" = "latitude",
     *          "dataType" = "float",
     *          "requirement" = "48.1 | -48.1",
     *          "description" = "The latitude"
     *      },
     *      {
     *          "name" = "longitude",
     *          "dataType" = "float",
     *          "requirement" = "-1.667 | 1.667",
     *          "description" = "The longitude"
     *      },
     *      {
     *          "name" = "direction",
     *              "dataType" = "string",
     *              "requirement" = "Bruz | Rennes",
     *              "description" = "City"
     *          },
     *      },
     *      section="Position Entity",
     *      description="Update position into database",
     *      statusCodes = {
     *          200 = "OK",
     *          201 = "Created",
     *          204 = "No Content",
     *          406 = "Not Acceptable",
     *      }
     * )
     * @param integer $id Id of the position instance.
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function postPositionAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository("CoyoteApiBundle:Position")->findOneById($id);
        if (!$entity) {
            $view = $this->view(array(
                            "Not delete register" => $entity
            ),404);
        }
        else {
            $form = $this->createForm(new PositionType(), $entity,
                    array('csrf_protection' => false,));
            $request = $this->getRequest()->request->all();
            $form->submit($request);

            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($entity);
                $em->flush();
            }

            if ($entity->getId() > 0)
            {
                $view = $this->view(array(
                                "Position update" => $entity
                ),200);
            }
            else{
                $view = $this->view(array(
                                "Position not update" => $entity
                ),406);
            }
        }
        return $this->handleView($view);
    }

    /**
     * @Rest\Post("break_point/{id}")
     * @ApiDoc(
     *      requirements = {
     *      {
     *          "name" = "name",
     *          "dataType" = "string",
     *          "requirement" = "Arret1|Arret2",
     *          "description" = "The name of break point"
     *      },
     *      {
     *          "name" = "position",
     *          "dataType" = "integer",
     *          "requirement" = "1 | 2",
     *          "description" = "The id of the position"
     *      },
     *      },
     *      section="Break Point Entity",
     *      description="Update break point into database",
     *      statusCodes = {
     *          200 = "OK",
     *          201 = "Created",
     *          204 = "No Content",
     *          406 = "Not Acceptable",
     *      }
     * )
     * @param integer $id Id of the break point instance.
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function postBreakPointAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository("CoyoteApiBundle:BreakPoint")->findOneById($id);
        if (!$entity) {
            $view = $this->view(array(
                            "Not delete register" => $entity
            ),404);
        }
        else {
            $form = $this->createForm(new BreakPointType(), $entity,
                    array('csrf_protection' => false,));
            $request = $this->getRequest()->request->all();
            $form->submit($request);

            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($entity);
                $em->flush();
            }

            if ($entity->getId() > 0)
            {
                $view = $this->view(array(
                                "Break Point update" => $entity
                ),200);
            }
            else{
                $view = $this->view(array(
                                "Break Point not update" => $entity
                ),406);
            }
        }
        return $this->handleView($view);
    }

    /**
     * @Rest\Delete("position/{id}")
     * @ApiDoc(
     *      section="Position Entity",
     *      description="Remove position into database",
     *      statusCodes = {
     *          200 = "OK",
     *          201 = "Created",
     *          204 = "No Content",
     *          404 = "Not Found",
     *          406 = "Not Acceptable",
     *      }
     * )
     * @param integer $id Id of the position instance.
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function deletePositionAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository("CoyoteApiBundle:Position")->findOneById($id);
        if (!$entity) {
            $view = $this->view(array(
                            "Not delete register" => $entity
            ),404);
        }
        else {
            $form = $this->createForm(new PositionType(), $entity,
                    array('csrf_protection' => false,));
            $request = $this->getRequest()->request->all();
            $form->submit($request);

            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->remove($entity);
                $em->flush();
            }
            $view = $this->view(array(
                            "Delete position" => $entity
            ),200);

        }
        return $this->handleView($view);
    }

    /**
     * @Rest\Delete("user/{id}")
     * @ApiDoc(
     *      section="User Entity",
     *      description="Remove user into database",
     *      statusCodes = {
     *          200 = "OK",
     *          201 = "Created",
     *          204 = "No Content",
     *          404 = "Not Found",
     *          406 = "Not Acceptable",
     *      }
     * )
     * @param integer $id Id of the user instance.
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function deleteUserAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository("CoyoteApiBundle:User")->findOneById($id);
        if (!$entity) {
            $view = $this->view(array(
                            "Not delete register" => $entity
            ),404);
        }
        else {
            $form = $this->createForm(new UserType(), $entity,
                    array('csrf_protection' => false,));
            $request = $this->getRequest()->request->all();
            $form->submit($request);

            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->remove($entity);
                $em->flush();
            }
            $view = $this->view(array(
                            "Delete user" => $entity
            ),200);

        }
        return $this->handleView($view);
    }

    /**
     * @Rest\Delete("breakpoint/{id}")
     * @ApiDoc(
     *      section="Break Point Entity",
     *      description="Remove break point into database",
     *      statusCodes = {
     *          200 = "OK",
     *          201 = "Created",
     *          204 = "No Content",
     *          404 = "Not Found",
     *          406 = "Not Acceptable",
     *      }
     * )
     * @param integer $id Id of the break point instance.
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function deleteBreakPointAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository("CoyoteApiBundle:BreakPoint")->findOneById($id);
        if (!$entity) {
            $view = $this->view(array(
                            "Not delete register" => $entity
            ),404);
        }
        else {
            $form = $this->createForm(new BreakPointType(), $entity,
                    array('csrf_protection' => false,));
            $request = $this->getRequest()->request->all();
            $form->submit($request);

            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->remove($entity);
                $em->flush();
            }
            $view = $this->view(array(
                            "Delete break point" => $entity
            ),200);

        }
        return $this->handleView($view);
    }

    /**
     * @Rest\Put("outcampus")
     * @ApiDoc(
     *      requirements = {
     *          {
     *              "name" = "latitude",
     *              "dataType" = "float",
     *              "requirement" = "48.1 | -48.1",
     *              "description" = "The latitude"
     *          },
     *          {
     *              "name" = "longitude",
     *              "dataType" = "float",
     *              "requirement" = "-1.667 | 1.667",
     *              "description" = "The longitude"
     *          },
     *      },
     *      section="Position Entity",
     *      description="Check position into database",
     *      statusCodes = {
     *          200 = "OK",
     *          201 = "Created",
     *          204 = "No Content",
     *          406 = "Not Acceptable",
     *      }
     * )
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function putOutCampusAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entity = new Position();
        $form = $this->createForm(new PositionType(), $entity,
                array('csrf_protection' => false,));
        $request = $this->getRequest()->request->all();
        $form->submit($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();
        }

        $result = "";

        if ($entity->getId() > 0)
        {
            $db = $this->getDoctrine()->getManager()->getConnection();

            $campus = $em->getRepository("CoyoteApiBundle:BreakPoint")->findOneByName("Milieu Campus");

            $sql = "Select st_distance('POINT(".$campus->getPosition()->getLatitude()." ".$campus->getPosition()->getLongitude().")'::geography,
                'POINT(".$entity->getLatitude()." ".$entity->getLongitude().")'::geography) AS d;";
            $box = $db->query($sql)->fetchColumn();
            if($box > 30000)
            {
                $result = "NOK";
            }
            else
            {
                $result = "OK";
            }

            $view = $this->view(array("Position" => $result),200);
        }
        else
        {
            $view = $this->view(array(
                            "Position not validate" => "error"
            ),406);
        }
        $em->remove($entity);
        $em->flush();

        return $this->handleView($view);
    }
}
