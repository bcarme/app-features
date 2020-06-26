<?php


namespace App\Entity;


class Month
{

    public $weekdays = ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche'];

    public $months = ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'];

    public $month;

    public $year;


    /**
     * Month constructor.
     * @param int $month
     * @param int $year
     */
    public function __construct(?int $month = null, ?int $year = null)
    {
        if ($month === null || $month <1 || $month > 12){
            $month = intval(date('m'));
        }

        if ($year === null){
            $year = intval(date('Y'));
        }
            $this->month = $month;

            $this->year = $year;
    }

    /**
     * @return string
     */
    public function toString(): string
    {
        return $this->months[$this->month -1] . ' ' . $this->year;
    }

    public function toUrl()
    {

        return '?month=' . (array_keys($this->months)[$this->month -1]+1) . '&year=' . $this->year;
    }

    public function getFirstDay()
    {
        $startDay = new \DateTime("{$this->year}-{$this->month}-01");
        $firstMonday = $startDay->modify('monday this week');
        return $firstMonday;
    }

    public function getLastDay()
    {
        $startDay = new \DateTime("{$this->year}-{$this->month}-01");
        $lastDay = clone($startDay->modify('last day of this month'));
        $lastSunday = $lastDay->modify('sunday this week');
        return $lastSunday;
    }

    public function nextMonth():Month
    {
        $month = $this->month + 1;
        $year = $this->year;
        if ($month > 12) {
            $month = 1;
            $year += 1;
        }

        return new Month($month, $year);
    }

        public function previousMonth():Month
    {
        $month = $this->month-1;
        $year = $this->year;
        if($month < 1){
            $month=12;
            $year-=1;
        }

        return new Month($month, $year);

    }

    public function isWithinMonth(\DateTime $date):bool
    {
        return $this->getFirstDay()->format('Y-m') === $date->format('Y-m');
    }

    public function weekNumber()
    {
        $weeknb = new \DateTime();
        $weeknb = $weeknb->format('W');
        return $weeknb;

    }


}