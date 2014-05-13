<?php

namespace Balalaika\Entity\Activator;

use Balalaika\Entity\PromotionSubjectInterface;

class DateRangeActivator
{

    protected $start = null;
    protected $end = null;

    public function start($start)
    {
        $this->start = $start;
        return $this;
    }

    public function end($end)
    {
        $this->end = $end;
        return $this;
    }

    /**
     * If no date range is set, the promotion is considered to be active.
     *
     * @return boolean
     */
    public function isActive(PromotionSubjectInterface $subject)
    {
        $currentDate = $subject->getCurrentDateTime();
        $startDate = $this->start ? $subject->getDateTime($this->start) : null;
        $endDate = $this->end ? $subject->getDateTime($this->end) : null;

        if ($this->start && $this->end) {
            return $currentDate > $startDate && $currentDate < $endDate;
        }

        if ($this->start) {
            return $currentDate > $startDate;
        }

        if ($this->end) {
            return $currentDate < $endDate;
        }

        return true;
    }
}
