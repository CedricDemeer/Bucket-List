<?php
namespace App\Controller;

use App\Entity\Idea;
use App\Form\IdeaType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class IdeaController extends AbstractController
{
    /**
     * @Route("/list", name="list")
     */
    public function list()
    {
        $rep = $this->getDoctrine()->getRepository(Idea::class);
        //$ideas = $rep->findBy([], ["dateCreated" => "DESC"]);
        $ideas = $rep->getIdeas();



        return $this->render("Bucket/list.html.twig", [
            'ideas' => $ideas,
        ]);
    }
    /**
     * @Route("/detail/{id}", name="detail", requirements={"id": "\d+"}, methods={"GET"})
     */
    public function detail($id=0)
    {
        $rep = $this->getDoctrine()->getRepository(Idea::class);
        $idee = $rep->find($id);

        return $this->render("Bucket/detail.html.twig", ['id' => $idee,]);
    }
    /**
     * @Route("/addList", name="addList")
     */
    public function addIdea(EntityManagerInterface $em, Request $request)
    {
        $Idea = new Idea();
        $IdeaForm = $this->createForm(IdeaType::class, $Idea);
        $IdeaForm->handleRequest($request);
        if ($IdeaForm->isSubmitted() && $IdeaForm->isValid())
        {
            $Idea->setDateCreated(new \DateTime());
            $Idea->setIsPublished(true);
            $em->persist($Idea);
            $em->flush();

            $this->addFlash("success", "L'idée à été créer.");

            return $this->redirectToRoute("detail", ['id'=>$Idea->getId()]);
        }


        return $this->render("Bucket/add.html.twig", [
            "Formulaire"=>$IdeaForm->createView()
        ]);
    }
}

