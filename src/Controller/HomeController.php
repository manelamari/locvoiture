<?php

namespace App\Controller;

use App\Data\SearchData;
use App\Entity\Category;
use App\Form\SearchForm;
use App\Repository\CategoryRepository;
use App\Repository\VoitureRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Role\Role;


class HomeController extends AbstractController
{
    /**
     * @Route("/", name="app_home")
     */
    public function index(CategoryRepository $repository): Response
    {
       $categorys=$repository->findAll();
        return $this->render('home/index.html.twig',[
            'categorys'=>$categorys,
        ]);
    }
    /**
     *
     * @Route("/category/{id}", name="app_cat")
     * @param $id
     * @param CategoryRepository $categoryRepository
     */
    public function  show($id,CategoryRepository $categoryRepository,VoitureRepository $voitureRepository):Response
    {
        $category=$categoryRepository->find($id);
       $voitures=$voitureRepository->findvoitbycat($category);
        /* c'est juste pour les messages*/
        $a=null;
        $a=$this->getUser();

        if($a==null){
            $this->addFlash('message', "Il faut faire l'inscription dans notre site pour avoir un espace client et aussi effectuer votre résévation " );
        }else
        {  $this->addFlash('message', 'Il faut vérifier la disponibilité du voiture selon votre pèriode de résérvation');}
        return $this->render('home/show.html.twig',[
            'voitures'=>$voitures,
             'category'=>$category   ]
        );

    }



    /**
     * @Route("/voitures", name="app_voitures")
     *
     */
    public function showallvoiture(Request $request,VoitureRepository $repository,PaginatorInterface $paginator){

        $voitures=$repository->findby(array('disponibility'=> 1));
        $voitures = $paginator->paginate(
            $voitures, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            6/*limit per page*/);
        $a=null;
        $a=$this->getUser();

if($a==null){
    $this->addFlash('message', "Il faut faire l'inscription dans notre site pour avoir un espace client et aussi effectuer votre résévation  " );
}else
{  $this->addFlash('message', 'Il faut vérifier la disponibilité du voiture selon votre pèriode de résérvation');}
        return $this->render('home/showallvoitures.twig',[
            'voitures'=>$voitures,
        ]);
    }



    /**
     *
     * @Route ("/voitures/search",name="voituressss",methods={"GET","POST"})
     */
    public function index2(VoitureRepository $repository,Request $request):Response
    {
      //  $session=null;
       // $voitures=null;
        $data = new SearchData();
        $searchForm=$this->createForm(SearchForm::class,$data);
        $searchForm->handleRequest($request);
        $voitures2=null;


        if($searchForm->isSubmitted() && $searchForm->isValid()) {
            $criteria = $searchForm->getData();

            // dd($criteria);

            $D=$data->getDebut();
            $F=$data->getFin();
            $cat=$data->getCategorie();
            $min=$data->getMin();
            $max=$data->getMax();

            $session=$request->getSession();
            $session->set('dateDebut',$D);
            $session->set('dateFin',$F);
            $session->set('categories',$cat);
            $session->set('min',$min);
            $session->set('max',$max);
            //$session->set('vid',1);
            $voitures = $repository->findSearch($D, $F);
           //dd($voitures);
            if(null==$voitures){
                if(($cat)OR ($min) OR($max)){
                    $voitures2 = $repository->findvoitbycat2($cat,$min,$max);

                }
                else{
                $voitures2=$repository->findby(array('disponibility'=> 1));

            }
            } else {
                $voitures2 = $repository->findvoituresdispo($voitures,$cat,$min,$max);

            }
           //dd($voitures2);


        }

        return $this->render('home/index2.html.twig',[
           // 'voitures'=>$voitures,
            'voitures2'=>$voitures2,

            'form'=>$searchForm->createView()

        ]);

    }

    /**
     * @Route("/apropos", name="app_home_apropos")
     */
    public function apropos()
    {

        return $this->render('home/apropos.html.twig');
    }


}
