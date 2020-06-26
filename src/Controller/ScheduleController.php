<?php

namespace App\Controller;

use App\Entity\Month;
use App\Entity\Booking;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class ScheduleController extends AbstractController
{
    /**
     * @Route("/planning", name="schedule")
     */
    public function index()
    {
        $month = new Month($_GET['month'] ?? null, $_GET['year'] ?? null);

        $monthCalendar = $month->toString();

        $weekdays = $month->weekdays;

        $firstMonday = $month->getFirstDay();

        $lastSunday = $month->getLastDay();

        $period = date_diff($firstMonday, $lastSunday)->format('%R%a');

        for ($i = 0; $i <= $period; $i++) {
            $dayDates[] = (clone $firstMonday)->modify('+' . ($i) . 'days')->format('d');
        }

        $previous = $month->previousMonth();
        $previous = $previous->toUrl();
        $next = $month->nextMonth();
        $next = $next->toUrl();


        return $this->render('schedule/index.html.twig', [
            'monthCalendar' => $monthCalendar,
            'weekdays' => $weekdays,
            'dayDates'=>$dayDates,
            'next'=>$next,
            'previous'=>$previous
        ]);

    }


}
