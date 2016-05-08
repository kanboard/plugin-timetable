<?php

namespace Kanboard\Plugin\Timetable\Schema;

use PDO;

const VERSION = 1;

function version_1(PDO $pdo)
{
    $pdo->exec('CREATE TABLE IF NOT EXISTS timetable_day (
        "id" INTEGER PRIMARY KEY,
        "user_id" INTEGER NOT NULL,
        "start" TEXT NOT NULL,
        "end" TEXT NOT NULL,
        FOREIGN KEY(user_id) REFERENCES users(id) ON DELETE CASCADE
    )');

    $pdo->exec('CREATE TABLE IF NOT EXISTS timetable_week (
        "id" INTEGER PRIMARY KEY,
        "user_id" INTEGER NOT NULL,
        "day" INTEGER NOT NULL,
        "start" TEXT NOT NULL,
        "end" TEXT NOT NULL,
        FOREIGN KEY(user_id) REFERENCES users(id) ON DELETE CASCADE
    )');

    $pdo->exec('CREATE TABLE IF NOT EXISTS timetable_off (
        "id" INTEGER PRIMARY KEY,
        "user_id" INTEGER NOT NULL,
        "date" TEXT NOT NULL,
        "all_day" INTEGER DEFAULT 0,
        "start" TEXT DEFAULT 0,
        "end" TEXT DEFAULT 0,
        "comment" TEXT,
        FOREIGN KEY(user_id) REFERENCES users(id) ON DELETE CASCADE
    )');

    $pdo->exec('CREATE TABLE IF NOT EXISTS timetable_extra (
        "id" INTEGER PRIMARY KEY,
        "user_id" INTEGER NOT NULL,
        "date" TEXT NOT NULL,
        "all_day" INTEGER DEFAULT 0,
        "start" TEXT DEFAULT 0,
        "end" TEXT DEFAULT 0,
        "comment" TEXT,
        FOREIGN KEY(user_id) REFERENCES users(id) ON DELETE CASCADE
    )');
}
