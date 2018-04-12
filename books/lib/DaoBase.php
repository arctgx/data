<?php

class DaoBase {

    protected $_db_name = 'books';

    public function getDB() {
        return DbManager::getDB($this->_db_name);
    }
}
