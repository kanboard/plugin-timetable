<?php if ($this->user->isAdmin()): ?>
    <li <?= $this->app->getRouterController() === 'timetable' ? 'class="active"' : '' ?>>
        <?= $this->url->link(t('Manage timetable'), 'timetable', 'index', array('plugin' => 'timetable', 'user_id' => $user['id'])) ?>
    </li>
<?php endif ?>