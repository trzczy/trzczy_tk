<?php
namespace Mvc\Model\Domain;
class TagResultDomain
{
    private $excerpts = [];

    /**
     * @return array
     */
    public function getExcerpts() {
        return $this->excerpts;
    }

    /**
     * @param array $excerpts
     */
    public function setExcerpts($excerpts) {
        $this->excerpts = $excerpts;
    }
}
