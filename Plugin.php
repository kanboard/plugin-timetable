<?php

namespace Plugin\Timetable;

use DateTime;
use Core\Translator;
use Core\Plugin\Base;

class Plugin extends Base
{
    public function initialize()
    {
        $container = $this->container;

        $this->acl->extend('admin_acl', array(
            'timetable' => '*',
            'timetableday' => '*',
            'timetableextra' => '*',
            'timetableoff' => '*',
            'timetableweek' => '*',
        ));

        $this->template->hook->attach('template:user:sidebar:actions', 'timetable:user/sidebar');

        $this->on('session.bootstrap', function($container) {
            Translator::load($container['config']->getCurrentLanguage(), __DIR__.'/Locale');
        });

        // Calculate time spent according to the timetable
        $this->hook->on('model:subtask-time-tracking:calculate:time-spent', function($user_id, DateTime $start, DateTime $end) use ($container) {
            return $container['timetable']->calculateEffectiveDuration($user_id, $start, $end);
        });

        // Split calendar events according to the timetable
        $this->hook->on('model:subtask-time-tracking:calendar:events', function($user_id, array $events, $start, $end) use ($container) {
            return $container['timetable']->calculateEventsIntersect($user_id, $events, $start, $end);
        });
    }

    public function getClasses()
    {
        return array(
            'Plugin\Timetable\Model' => array(
                'Timetable',
                'TimetableDay',
                'TimetableExtra',
                'TimetableWeek',
                'TimetableOff',
            )
        );
    }
}
