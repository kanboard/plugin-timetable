<?php

namespace Kanboard\Plugin\Timetable\Controller;

/**
 * Over-time Timetable controller
 *
 * @package  controller
 * @author   Frederic Guillot
 */
class Timetableextra extends Timetableoff
{
    protected $model = 'timetableExtra';
    protected $controller_url = 'timetableextra';
    protected $template_dir = 'timetable:timetable_extra';
}
