<?php

namespace App\Controller;

use App\Repository\CycleRepository;
use App\Repository\TechniqueRepository;
use App\Repository\PositionRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index()
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    /**
     * @Route("/maintenance", name="maintenance")
     */
    public function maintenance(Security $security, CycleRepository $cycleRepository, TechniqueRepository $techniqueReopsitory, UserRepository $userRepository): Response
    {
        $em = $this->getDoctrine()->getManager();

        $id = $security->getUser();
        $user = $em->getRepository('App\Entity\User')->find($id);
        $currentPositionGroundId = $em->getRepository('App\Entity\User')->find($id)->getCurrentPositionGround();
        $currentPositionGround = $currentPositionGroundId->getName();
        $currentPositionStandingId = $em->getRepository('App\Entity\User')->find($id)->getCurrentPositionStanding();
        $currentPositionStanding = $currentPositionStandingId->getName();
        $techniquesGround = $em->getRepository('App\Entity\Technique')->findByPosition($currentPositionGround);
        $techniquesStanding = $em->getRepository('App\Entity\Technique')->findByPosition($currentPositionStanding);

        $videotest = $em->getRepository('App\Entity\video')->findBy([
            'position' => $currentPositionGroundId,
            'technique' => $techniquesGround
        ]);


        return $this->render('home/maintenance.html.twig', [
            'position' => $currentPositionGround,
            'cycles' => $cycleRepository->findAll(),
            'techniquesGround' => $techniquesGround,
            'techniquesStanding' => $techniquesStanding,
            'techniques' => $techniqueReopsitory->findAll(),
            'user' => $user,
            'videos' => $videotest
        ]);
    }

    /**
     * @Route("/focus", name="focus")
     */
    public function focus(CycleRepository $cycleRepository, TechniqueRepository $techniqueReopsitory): Response
    {
        return $this->render('home/focus.html.twig', [
            'cycles' => $cycleRepository->findAll(),
            'techniques' => $techniqueReopsitory->findAll()
        ]);
    }

    /**
     * @Route("/flow", name="flow") 
     */
    public function flow(CycleRepository $cycleRepository, TechniqueRepository $techniqueReopsitory, PositionRepository $positionRepository): Response
    {

        $em = $this->getDoctrine()->getManager();

        $game = 'Standing';
        $flowStarter = $em->getRepository('App\Entity\Technique')->findFlowStarter($game);
        $flowIterationStartPosition = $flowStarter->getEndPosition()->getValues();

        $flowArray[0] = $flowStarter;

        for ($x = 1; $x <= 10; $x++) {

            if (!$flowIterationStartPosition) {break;}
            $flowIteration = $em->getRepository('App\Entity\Technique')->findFlowIteration($flowIterationStartPosition[0]->getName());

            $flowArray[$x] = $flowIteration;
            $flowIterationStartPosition = $flowIteration->getEndPosition()->getValues();
        }

//        dump($flowArray);
//       echo($em->getRepository('App\Entity\Technique')->findFlowStarter('Ground'));

        return $this->render('home/flow.html.twig', [
            'flow_array' => $flowArray,
            'controller_name' => 'HomeController',
            'cycles' => $cycleRepository->findAll(),
            'techniques' => $techniqueReopsitory->findAll(),
            'positions' => $positionRepository->findAll()
        ]);
    }

    /**
     * @Route("/flow/go", name="flowGo")
     */
    public function flowGo(Request $request, CycleRepository $cycleRepository, TechniqueRepository $techniqueReopsitory): Response
    {
        $em = $this->getDoctrine()->getManager();

        $request = Request::createFromGlobals();

        $numberOfTech = $request->get('numberOfTech');
        $playerChoice = $request->get('playerChoice');
        $submissionChoice = $request->get('submissionChoice');
        $gameChoice = $request->get('gameChoice');
        $positionChoiceStanding = $request->get('positionChoiceStanding');
        $positionChoiceGround = $request->get('positionChoiceGround');

        $choices = [
            'Number of Techniques' => $numberOfTech,
            'Top or Bottom' => $playerChoice,
            'Ends with a submission' => $submissionChoice,
            'Starts' => $gameChoice,
        ];

        if($gameChoice == 'Standing'){
            $choices['Starting Position'] = $positionChoiceStanding;
            } else {
            $choices['Starting Position'] = $positionChoiceGround;
        };

        if($choices['Starting Position'] == 'Random'){
            $flowStarter = $em->getRepository('App\Entity\Technique')->findFlowStarter($gameChoice);
            $flowIterationStartPosition = $flowStarter->getEndPosition()->getValues();
        }else{
            $flowStarter = $em->getRepository('App\Entity\Technique')->findOneByPosition($choices['Starting Position']);
            $flowIterationStartPosition = $flowStarter->getEndPosition()->getValues();
        };
        
        dump($choices);

        $flowArray[0] = $flowStarter;

        for ($x = 1; $x <= $numberOfTech - 1; $x++) {

            if (!$flowIterationStartPosition) {break;}
            $flowIteration = $em->getRepository('App\Entity\Technique')->findFlowIteration($flowIterationStartPosition[0]->getName());

            $flowArray[$x] = $flowIteration;
            $flowIterationStartPosition = $flowIteration->getEndPosition()->getValues();
        }


        return $this->render('home/flowGo.html.twig', [
            'flow_array' => $flowArray,
            'choices' => $choices,
            'cycles' => $cycleRepository->findAll(),
            'techniques' => $techniqueReopsitory->findAll()
        ]);
    }
}
