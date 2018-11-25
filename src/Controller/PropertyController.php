<?php
namespace App\Controller;
use App\Entity\Property;
use App\Repository\PropertyRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
/**
 * Created by PhpStorm.
 * User: Amine
 * Date: 21/11/2018
 * Time: 22:17
 */

/**
 * Class PropertyController
 * @package App\Controller
 */
class PropertyController extends AbstractController
{

    private $_propertyRepository;

    public function __construct(PropertyRepository $propertyRepository)
    {
        $this->_propertyRepository = $propertyRepository;
    }

    /**
     * @Route("/biens",name="property.index")
     */
    public function indexAction()
    {
        $properties = $this->_propertyRepository->findAllVisibleProperies();
        return $this->render('property/index.html.twig',['current_menu'=>'property']);
    }
    /**
     * @Route("/biens/{slug}-{id}",name="property.show",requirements={"slug" : "[a-z0-9\-]*"})
     */
    public function showAction(Property $property,string $slug)
    {
        if($property->getSlug() !== $slug){
            return $this->redirectToRoute('property.show',[
                'id'=>$property->getId(),
                'slug'=>$property->getSlug()
            ],301);
        }
        return $this->render('property/show.html.twig',['property'=>$property,'current_menu'=>'property']);
    }
}