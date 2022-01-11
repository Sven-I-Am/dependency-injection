<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\Transform;
use App\Service\Logger;


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
    public function index(): Response
    {
        $string = 'hello, this is your homepagecontroller speaking';
        $output1 = $this->toCaps->transform($string);
        $output2 = $this->toDash->transform($string);
        $this->logger->log($string);
        return $this->render('base.html.twig', [
            'output1' => $output1,
            'output2' => $output2,
        ]);
    }
}
