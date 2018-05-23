<?php

namespace Credit;

class Schedule
{
    /**
     * @var array
     */
    private $entries = [];

    public function addEntry(ScheduleEntry $entry)
    {
        $this->entries[] = $entry;
    }

    /**
     * @return array
     */
    public function getEntries(): array
    {
        return $this->entries;
    }

    public function toCsvString()
    {

    }
}