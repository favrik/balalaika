<?php

namespace Balalaika\Action;

use Balalaika\Entity\PromotionSubjectInterface;

class FreeShippingAction implements ActionInterface
{
    public function perform(PromotionSubjectInterface $subject)
    {
        $subject->setFreeShipping();
    }
}

