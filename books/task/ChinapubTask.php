<?php

class ChinapubTask {

    protected $_task_id;

    public function TestAction() {
        $file = DATA_PATH.'china-pub_index.html';
        $contents = file_get_contents($file);
        $contents = mb_convert_encoding($contents, 'UTF-8', 'gbk');
        var_dump($contents);
    }

    // php -f cli.php Chinapub Download
    public function DownloadAction() {
        $this->_task_id = sprintf('chinapub_task_%d', time());

        $strLog = sprintf('task[%s] start', $this->_task_id);
        Log::notice($strLog);

        $spider = new Spider_Chinapub();
        $crawlerRet = $spider->getIndexHtml();
        if (!$crawlerRet) {
            $strLog = sprintf('%s get index fail', $this->_task_id);
            Log::fatal($strLog);
            exit(1);
        }

        $spider->parse();

        $books = $spider->getBooks();
        // var_dump($books);

        if (empty($books)) {
            Log::warning('books empty');
            exit(1);
        }

        $chinapubBookDao = new Dao_ChinapubBook();
        foreach ($books as $oneBook) {
            $bookID = $oneBook['book_id'];
            $info = $chinapubBookDao->getInfoByBookID($bookID);
            if (empty($info)) {
                $chinapubBookDao->save($oneBook);
            }
        }

        $strLog = sprintf('task[%s] end', $this->_task_id);
        Log::notice($strLog);
    }
}

