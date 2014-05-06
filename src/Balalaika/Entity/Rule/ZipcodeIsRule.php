<?php

namespace Balalaika\Entity\Rule;

class ZipcodeIsRule extends ListRule
{
    public function getSubjectValue($subject)
    {
        return $subject->getShippingZipcode();
    }
}
