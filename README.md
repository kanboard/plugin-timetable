User Timetable plugin for Kanboard
===================================

- Timetable / schedule for users
- Display in the calendar intersects between sub-task time tracking and user schedule
- Timetable management: weekly, daily, overtime, days off
- The timetable is configurable for each user
- Sub-task time tracking is calculated according to the timetable
- Sub-task time tracking in calendar settings must be activated

Author
------

- Frederic Guillot
- License MIT

Requirements
------------

- Kanboard >= 1.0.29 and < 1.0.37

Installation
------------

You have the choice between 3 methods:

1. Install the plugin from the Kanboard plugin manager in one click
2. Download the zip file and decompress everything under the directory `plugins/Timetable`
3. Clone this repository into the folder `plugins/Timetable`

Note: Plugin folder is case-sensitive.

Documentation
-------------

### User Timetables

Each user can have a predefined timetable.
This feature mainly is used for time tracking, project budget calculation and to display sub-tasks in the calendar.

Each user has his own timetable. At the moment, that need to be specified manually for each person.
You can also schedule time-off or overtime.

The timetable section is available from the user profile: **User profile > Timetable**.

#### Work Timetable

This timetable is dynamically calculated according to the regular week timetable, time-off and overtime.

![Timetable](https://cloud.githubusercontent.com/assets/323546/21756475/c62e9fae-d5ef-11e6-8037-e91005eb1dfc.png)

#### Week Timetable

![Week Timetable](https://cloud.githubusercontent.com/assets/323546/21756479/da443ff8-d5ef-11e6-8d24-2006350a2a5f.png)

The week timetable is used to define regular work hours for the selected user.

To add a new time slot, just select the day of the week and the time range.

#### Time-off Timetable

The time-off timetable is used to schedule time not worked.
This time is deducted from the regular work hours.

When you check the box "All day", the regular day timetable is used to define the regular work hours.

#### Overtime Timetable

![Overtime Timetable](https://cloud.githubusercontent.com/assets/323546/21756484/e9008a42-d5ef-11e6-8d61-1e33a174f359.png)

The overtime timetable is used to define worked hours outside of regular hours.

#### Day Timetable

This timetable is used when the checkbox "All day" is checked for overtime and time-off entries.
