<?php

namespace Kanboard\Plugin\Timetable\Controller;

use Kanboard\Controller\BaseController;

/**
 * Week Timetable controller
 *
 * @package  controller
 * @author   Frederic Guillot
 */
class Timetableweek extends BaseController
{
    /**
     * Display timetable for the user
     *
     * @access public
     * @param array $values
     * @param array $errors
     * @throws \Kanboard\Core\Controller\AccessForbiddenException
     * @throws \Kanboard\Core\Controller\PageNotFoundException
     */
    public function index(array $values = array(), array $errors = array())
    {
        $user = $this->getUser();

        if (empty($values)) {

            $day = $this->timetableDay->getByUser($user['id']);

            $values = array(
                'user_id' => $user['id'],
                'start' => isset($day[0]['start']) ? $day[0]['start'] : null,
                'end' => isset($day[0]['end']) ? $day[0]['end'] : null,
            );
        }

        $this->response->html($this->helper->layout->user('timetable:timetable_week/index', array(
            'timetable' => $this->timetableWeek->getByUser($user['id']),
            'values' => $values,
            'errors' => $errors,
            'user' => $user,
        )));
    }

    /**
     * Validate and save
     *
     * @access public
     */
    public function save()
    {
        $values = $this->request->getValues();
        list($valid, $errors) = $this->timetableWeek->validateCreation($values);

        if ($valid) {

            if ($this->timetableWeek->create($values['user_id'], $values['day'], $values['start'], $values['end'])) {
                $this->flash->success(t('Time slot created successfully.'));
                return $this->response->redirect($this->helper->url->to('timetableweek', 'index', array('plugin' => 'timetable', 'user_id' => $values['user_id'])));
            } else {
                $this->flash->failure(t('Unable to save this time slot.'));
            }
        }

        return $this->index($values, $errors);
    }

    /**
     * Confirmation dialag box to remove a row
     *
     * @access public
     */
    public function confirm()
    {
        $user = $this->getUser();

        $this->response->html($this->helper->layout->user('timetable:timetable_week/remove', array(
            'slot_id' => $this->request->getIntegerParam('slot_id'),
            'user' => $user,
        )));
    }

    /**
     * Remove a row
     *
     * @access public
     */
    public function remove()
    {
        $this->checkCSRFParam();
        $user = $this->getUser();

        if ($this->timetableWeek->remove($this->request->getIntegerParam('slot_id'))) {
            $this->flash->success(t('Time slot removed successfully.'));
        } else {
            $this->flash->success(t('Unable to remove this time slot.'));
        }

        $this->response->redirect($this->helper->url->to('timetableweek', 'index', array('plugin' => 'timetable', 'user_id' => $user['id'])));
    }
}
