<?php

function connectDb() {
    mysql_connect(DB_HOST, DB_USER, DB_PASSWORD) or die("can not connect to DB:".mysql_error());
    mysql_select_db(DB_NAME) or die("can not select DB: ".mysql_error());
}

function h($s) {
    return htmlspecialchars($s);
}