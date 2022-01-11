<?php

namespace App\Controller;

use App\Controller\Master;
use App\Entity\Input;
use App\Form\InputType;
use App\Service\Transform;
use App\Service\Logger;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class HomepageController extends AbstractController
{
    private Transform $toDash;
    private Transform $toCaps;
    private Logger $logger;

    public function __construct(Transform $toCaps, Transform $toDash, Logger $logger)
    {
        $this->toCaps = $toCaps;
        $this->toDash = $toDash;
        $this->logger = $logger;
    }
    /**
     * @route("/", "homepage")
     */
    public function index(Request $request): Response
    {
        $input = new Input;
        $output = $input->getInput();
        $transform = $input->getTransform();
        $form = $this->createForm(InputType::class, $input);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $input = $form->getData();
            $string = $input->getInput();
            $master = new Master($this->toCaps, $this->toDash, $this->logger, $string);
            $transform= $input->getTransform();
            if($transform === 'caps'){
                $output = $master->toCaps();
            } else {
                $output = $master->toDash();
            }
            $this->logger->log($string);
        }
        return $this->renderForm('base.html.twig', [
            'form' => $form,
            'transform' => $transform,
            'output' => $output,
        ]);
    }
}
