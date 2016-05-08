<?php

namespace Kanboard\Plugin\Timetable\Schema;

use PDO;
const VERSION = 1;

function version_1(PDO $pdo)
{
    $pdo->exec('CREATE TABLE IF NOT EXISTS timetable_day (
        id INT NOT NULL AUTO_INCREMENT,
        user_id INT NOT NULL,
        start VARCHAR(5) NOT NULL,
        end VARCHAR(5) NOT NULL,
        FOREIGN KEY(user_id) REFERENCES users(id) ON DELETE CASCADE,
        PRIMARY KEY(id)
    ) ENGINE=InnoDB CHARSET=utf8');

    $pdo->exec('CREATE TABLE IF NOT EXISTS timetable_week (
        id INT NOT NULL AUTO_INCREMENT,
        user_id INTEGER NOT NULL,
        day INT NOT NULL,
        start VARCHAR(5) NOT NULL,
        end VARCHAR(5) NOT NULL,
        FOREIGN KEY(user_id) REFERENCES users(id) ON DELETE CASCADE,
        PRIMARY KEY(id)
    ) ENGINE=InnoDB CHARSET=utf8');

    $pdo->exec('CREATE TABLE IF NOT EXISTS timetable_off (
        id INT NOT NULL AUTO_INCREMENT,
        user_id INT NOT NULL,
        date VARCHAR(10) NOT NULL,
        all_day TINYINT(1) DEFAULT 0,
        start VARCHAR(5) DEFAULT 0,
        end VARCHAR(5) DEFAULT 0,
        comment TEXT,
        FOREIGN KEY(user_id) REFERENCES users(id) ON DELETE CASCADE,
        PRIMARY KEY(id)
    ) ENGINE=InnoDB CHARSET=utf8');

    $pdo->exec('CREATE TABLE IF NOT EXISTS timetable_extra (
        id INT NOT NULL AUTO_INCREMENT,
        user_id INT NOT NULL,
        date VARCHAR(10) NOT NULL,
        all_day TINYINT(1) DEFAULT 0,
        start VARCHAR(5) DEFAULT 0,
        end VARCHAR(5) DEFAULT 0,
        comment TEXT,
        FOREIGN KEY(user_id) REFERENCES users(id) ON DELETE CASCADE,
        PRIMARY KEY(id)
    ) ENGINE=InnoDB CHARSET=utf8');
}
