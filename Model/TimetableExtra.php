<?php

namespace Plugin\Timetable\Model;

use SimpleValidator\Validator;
use SimpleValidator\Validators;
use Model\Base;

/**
 * Timetable over-time
 *
 * @package  model
 * @author   Frederic Guillot
 */
class TimetableExtra extends TimetableOff
{
    /**
     * SQL table name
     *
     * @var string
     */
    const TABLE = 'timetable_extra';
}
