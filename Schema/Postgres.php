<?php

namespace Kanboard\Plugin\Timetable\Schema;

use PDO;
const VERSION = 1;

function version_1(PDO $pdo)
{
    $pdo->exec('CREATE TABLE IF NOT EXISTS timetable_day (
        "id" SERIAL PRIMARY KEY,
        "user_id" INTEGER NOT NULL,
        "start" VARCHAR(5) NOT NULL,
        "end" VARCHAR(5) NOT NULL,
        FOREIGN KEY(user_id) REFERENCES users(id) ON DELETE CASCADE
    )');

    $pdo->exec('CREATE TABLE IF NOT EXISTS timetable_week (
        "id" SERIAL PRIMARY KEY,
        "user_id" INTEGER NOT NULL,
        "day" INTEGER NOT NULL,
        "start" VARCHAR(5) NOT NULL,
        "end" VARCHAR(5) NOT NULL,
        FOREIGN KEY(user_id) REFERENCES users(id) ON DELETE CASCADE
    )');

    $pdo->exec('CREATE TABLE IF NOT EXISTS timetable_off (
        "id" SERIAL PRIMARY KEY,
        "user_id" INTEGER NOT NULL,
        "date" VARCHAR(10) NOT NULL,
        "all_day" BOOLEAN DEFAULT \'0\',
        "start" VARCHAR(5) DEFAULT 0,
        "end" VARCHAR(5) DEFAULT 0,
        "comment" TEXT,
        FOREIGN KEY(user_id) REFERENCES users(id) ON DELETE CASCADE
    )');

    $pdo->exec('CREATE TABLE IF NOT EXISTS timetable_extra (
        "id" SERIAL PRIMARY KEY,
        "user_id" INTEGER NOT NULL,
        "date" VARCHAR(10) NOT NULL,
        "all_day" BOOLEAN DEFAULT \'0\',
        "start" VARCHAR(5) DEFAULT 0,
        "end" VARCHAR(5) DEFAULT 0,
        "comment" TEXT,
        FOREIGN KEY(user_id) REFERENCES users(id) ON DELETE CASCADE
    )');
}
