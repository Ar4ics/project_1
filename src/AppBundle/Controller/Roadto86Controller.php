<?php
namespace AppBundle\Controller;

use AppBundle\Entity\Prepod;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;



class Roadto86Controller extends Controller
{

    public function indexAction($name)
    {
        return $this->render('road/road.html.twig', array(
        'name' => $name
        ));
    }
    
    public function roadAction() {
        
        return $this->redirectToRoute('road', array('name' => "Алексей"), 301);
    }
    
    public function homeAction() {
        
        return $this->redirectToRoute('road', array('name' => "Алексей"), 301);
    }
    
    
    public function ajaxAction(Request $request)
    {
    if ($request->isXMLHttpRequest()) {
        
        $repository = $this->getDoctrine()
            ->getRepository('AppBundle:Prepod');
            $ids = $request->request->get('ids');
            if (sizeof($ids) == 0) {
                $prepods = $repository->findAll();
            } else {
            $prepods = $repository->createQueryBuilder('n')
            ->where('n.id NOT IN (:status)')
            ->setParameter('status', $ids)->getQuery()->getResult();
            }
            $prepod = $prepods[array_rand($prepods)];
        if ($prepod->getId() == 2) {
            return new JsonResponse(array('winner' => 2, 'img' => $prepod->getFoto(), 'name' => $prepod->getName(), 'text' => $prepod->getDescription()));
        }
        if (sizeof($ids) == 2) {
            return new JsonResponse(array('winner' => 1, 'img' => $prepod->getFoto(), 'name' => $prepod->getName(), 'text' => $prepod->getDescription()));
        }
        
        return new JsonResponse(array('winner' => 0, 'img' => $prepod->getFoto(), 'ids' => $prepod->getId()));
        
        
    } 

    return new Response('This is not ajax!', 400); 
    
    
    
}

}