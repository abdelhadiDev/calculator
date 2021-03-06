<?php

declare(strict_types=1);

namespace App\Controller;

use App\Utils\Calculator;
use App\Utils\CalculatorInterface;
use App\Utils\Operator\Addition;
use App\Utils\Operator\Division;
use App\Utils\Operator\Multiplication;
use App\Utils\Operator\Subtraction;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CalculatorController extends AbstractController
{
    /**
     * @Route("/", name="app_default")
     * @Route("/calculator", name="calculator")
     */
    public function calculator(Request $request, CalculatorInterface $calculator): Response
    {
        if ($request->isMethod('POST')) {
            $result = $calculator->calculate($request->request->get('input'));

            return $this->render('calculator/index.html.twig', [
                'controller_name' => 'CalculatorController',
                'result' => $result,
                'input' => $request->request->get('input')
            ]);
        }

        return $this->render('calculator/index.html.twig', [
            'controller_name' => 'CalculatorController',
        ]);
    }
}
