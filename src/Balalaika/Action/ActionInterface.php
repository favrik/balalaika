<?php

namespace Balalaika\Action;

use Balalaika\Entity\PromotionSubjectInterface;

interface ActionInterface
{
    /**
     * Performs a promotion action.
     *
     * @param PromotionSubjectInterface $subject The subject where the
     *        prommotion action si going to be applied.
     * @return array The updated order data structure.
     */
    public function perform(PromotionSubjectInterface $subject);
}
