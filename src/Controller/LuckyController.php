<?php
// src/Controller/LuckyController.php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use App\Entity\City;
use Doctrine\ORM\EntityManagerInterface;

use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\Validator\Validator\ValidatorInterface;

use App\Repository\StudentsRepository;

class LuckyController extends AbstractController
{
	
	/**
     * @Route("/about",name="about")
	
     */
    public function about()
    {
        return $this->render('about.html.twig');
    }
	
	/**
     * @Route("/add",name="create")
	
     */
    public function create()
    {
        return $this->render('forma.html.twig');
    }
	
	/**
     * @Route("/addcity", name="insert")
     */
	 public function AddStudent(Request $request,ValidatorInterface $validator): Response
    {
        // you can fetch the EntityManager via $this->getDoctrine()
        // or you can add an argument to the action: createProduct(EntityManagerInterface $entityManager)
        $entityManager = $this->getDoctrine()->getManager();

        $city = new City();
        $city->setName($request->query->get('name'));
        $city->setKod($request->query->get('kod'));
        $city->setOblast($request->query->get('oblast'));
		 $city->setKalky($request->query->get('kalky'));
		
		$errors = $validator->validate($city);
        if (count($errors) > 0) {
            return new Response((string) $errors, 400);
        }
        // tell Doctrine you want to (eventually) save the Product (no queries yet)
        $entityManager->persist($city);

        // actually executes the queries (i.e. the INSERT query)
        $entityManager->flush();

        $repository = $this->getDoctrine()->getRepository(City::class);
		$cities = $repository->findAll();
        return $this->render('show.html.twig',
		['cities'=>$cities]);
		//return $this->render->('forma.html.twig',
		//['id'=>$student->getId()]);
    }
	
	/**
     * @Route("/showAll",name="SelectAll")
	
     */
    public function showAll()
    {
		$repository = $this->getDoctrine()->getRepository(City::class);
		$cities = $repository->findAll();
        return $this->render('show.html.twig',
		['cities'=>$cities]);
    }
	
	/**
     * @Route("/update",name="Update")
	
     */
    public function PrepareUpdate(Request $request)
    {
		$id = $request->query->get('uId');
		$entityManager = $this->getDoctrine()->getManager();
		$city = $entityManager->getRepository(City::class)->find($id);
        return $this->render('uform.html.twig',
		['city'=>$city]);
    }
	/**
     * @Route("/updated",name="Updated") 
	
     */
    public function Update(Request $request):Response
    {
		$id = $request->query->get('id');
		$entityManager = $this->getDoctrine()->getManager();
		$city = $entityManager->getRepository(City::class)->find($id);
		$city->setName($request->query->get('cname'));
		$city->setKod($request->query->get('ckod'));
		$city->setOblast($request->query->get('coblast'));
		$city->setKalky($request->query->get('ckalky'));
		 $entityManager->flush();
		$repository = $this->getDoctrine()->getRepository(City::class);
		$cities = $repository->findAll();
        return $this->render('show.html.twig',
		['cities'=>$cities]);
        
    }
	
	/**
     * @Route("/delete",name="Delete")
	
     */
    public function delet(Request $request):Response
    {
		$id = $request->query->get('dId');
		$entityManager = $this->getDoctrine()->getManager();
		$city = $entityManager->getRepository(City::class)->find($id);
		$entityManager->remove($city);
		$entityManager->flush();
		$repository = $this->getDoctrine()->getRepository(City::class);
		$cities = $repository->findAll();
        return $this->render('show.html.twig',
		['cities'=>$cities]);
    }
	/**
     * @Route("/search",name="search")
	
     */
    public function search()
    {
        return $this->render('search.html.twig');
    }
	
	/**
     * @Route("/find",name="find")
	
     */
    public function searchCity(Request $request)
    {
		//$f = $request->query->get('findBy');
		//$s = $request->query->get('searchBy');
		$repository = $this->getDoctrine()->getRepository(City::class);
		
		$cities = $repository->findBy(
		[$request->query->get('searchBy') => $request->query->get('findBy')]
		);
		
        return $this->render('show.html.twig',
		['cities'=>$cities]);
		
		
    }
}
?>