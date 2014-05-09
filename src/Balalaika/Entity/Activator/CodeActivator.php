<?php

namespace Balalaika\Entity\Activator;

use Balalaika\Entity\PromotionSubjectInterface;

class CodeActivator
{
    private $code;
    private $usageLimitPerCode = null;
    private $usageLimitPerUser = null;

    public function code($code)
    {
        $this->code = $code;
        return $this;
    }

    public function usageLimitPerCode($limit)
    {
        $this->usageLimitPerCode = intval($limit);
        return $this;
    }

    public function usageLimitPerUser($limit)
    {
        $this->usageLimitPerUser = intval($limit);
        return $this;
    }

    /**
     * If the code has a null usage limit it is considered to have unlimited usage.
     *
     * @return boolean
     */
    public function isActive(PromotionSubjectInterface $subject)
    {
        return
            $subject->getPromotionCode() == $this->code
            &&
            ($this->usageLimitPerCode ? $subject->getPromotionUsageCount() < $this->usageLimitPerCode : true)
            &&
            ($this->usageLimitPerUser ? $subject->getPromotionUserCount() < $this->usageLimitPerUser : true);
    }
}
