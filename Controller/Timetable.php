<?php

namespace Kanboard\Plugin\Timetable\Controller;

use DateTime;
use Kanboard\Controller\BaseController;

/**
 * Timetable controller
 *
 * @package  controller
 * @author   Frederic Guillot
 */
class Timetable extends BaseController
{
    /**
     * Display timetable for the user
     *
     * @access public
     */
    public function index()
    {
        $user = $this->getUser();
        $from = $this->request->getStringParam('from', date('Y-m-d'));
        $to = $this->request->getStringParam('to', date('Y-m-d', strtotime('next week')));
        $timetable = $this->timetable->calculate($user['id'], new DateTime($from), new DateTime($to));

        $this->response->html($this->helper->layout->user('timetable:timetable/index', array(
            'user' => $user,
            'timetable' => $timetable,
            'values' => array(
                'from' => $from,
                'to' => $to,
                'plugin' => 'timetable',
                'controller' => 'timetable',
                'action' => 'index',
                'user_id' => $user['id'],
            ),
        )));
    }
}
