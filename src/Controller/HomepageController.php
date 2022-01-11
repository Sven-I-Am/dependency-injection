<?php

namespace App\Controller;

use App\Entity\Input;
use App\Form\InputType;
use App\Service\Transform;

use Monolog\Handler\StreamHandler;
use Monolog\Logger;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class HomepageController extends AbstractController
{
    private Transform $toDash;
    private Transform $toCaps;

    public function __construct(Transform $toCaps, Transform $toDash)
    {
        $this->toCaps = $toCaps;
        $this->toDash = $toDash;
    }
    /**
     * @route("/", "homepage")
     */
    public function index(Request $request): Response
    {
        $log = new Logger('my_logger');
        $log->pushHandler(new StreamHandler('../var/log/log.info', Logger::ALERT));
        $input = new Input;
        $output = $input->getInput();
        $transform = $input->getTransform();
        $form = $this->createForm(InputType::class, $input);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $input = $form->getData();
            $string = $input->getInput();
            $log->alert($string);
            $master = new Master($this->toCaps, $this->toDash, $string);
            $transform= $input->getTransform();
            if($transform === 'caps'){
                $output = $master->toCaps();
            } else {
                $output = $master->toDash();
            }
        }
        return $this->renderForm('base.html.twig', [
            'form' => $form,
            'transform' => $transform,
            'output' => $output,
        ]);
    }
}
