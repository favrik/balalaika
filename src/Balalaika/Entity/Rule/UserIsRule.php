<?php

namespace Balalaika\Entity\Rule;

class UserIsRule extends ListRule
{
    public function getSubjectValue($subject)
    {
        return $subject->getUserId();
    }
}
