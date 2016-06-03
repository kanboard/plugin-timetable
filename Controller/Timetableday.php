<?php

namespace Kanboard\Plugin\Timetable\Controller;

use Kanboard\Controller\BaseController;

/**
 * Day Timetable controller
 *
 * @package  controller
 * @author   Frederic Guillot
 */
class Timetableday extends BaseController
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

        $this->response->html($this->helper->layout->user('timetable:timetable_day/index', array(
            'timetable' => $this->timetableDay->getByUser($user['id']),
            'values' => $values + array('user_id' => $user['id']),
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
        list($valid, $errors) = $this->timetableDay->validateCreation($values);

        if ($valid) {

            if ($this->timetableDay->create($values['user_id'], $values['start'], $values['end'])) {
                $this->flash->success(t('Time slot created successfully.'));
                return $this->response->redirect($this->helper->url->to('timetableday', 'index', array('plugin' => 'timetable', 'user_id' => $values['user_id'])));
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

        $this->response->html($this->helper->layout->user('timetable:timetable_day/remove', array(
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

        if ($this->timetableDay->remove($this->request->getIntegerParam('slot_id'))) {
            $this->flash->success(t('Time slot removed successfully.'));
        } else {
            $this->flash->success(t('Unable to remove this time slot.'));
        }

        $this->response->redirect($this->helper->url->to('timetableday', 'index', array('plugin' => 'timetable', 'user_id' => $user['id'])));
    }
}
