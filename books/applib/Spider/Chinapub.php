<?php

// 爬虫
class Spider_Chinapub {

    protected $_index_html = '';

    public function getIndexHtml() {
        $dataFile = DATA_PATH.'china-pub_index.html';
        if (file_exists($dataFile) && filesize($dataFile) && time()-filectime($dataFile)<3600) {
            $this->_index_html = file_get_contents($dataFile);
            Log::notice('use local file');
            return true;
        }

        Log::notice('download from china-pub');

        $url = 'http://www.china-pub.com/';
        $userAgent = 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36';

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_USERAGENT, $userAgent);

        // curl_setopt($ch, CURLOPT_POST, 1 );
        // curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
        curl_setopt($ch, CURLOPT_URL, $url);
        $contents = curl_exec($ch);
        $errno = curl_errno($ch);
        $error = curl_error($ch);
        curl_close($ch);

        if ($errno != 0) {
            $strLog = sprintf('get contents fail, path[%s]', $path);
            Log::warning($strLog);
            return false;
        }

        $contents = mb_convert_encoding($contents, 'UTF-8', 'gbk');
        $this->_index_html = $contents;
        file_put_contents($dataFile, $this->_index_html);
        return true;
    }

    // 分析

    protected $_tags = array(
        // 新书排行
        array(
            'start_tag' => "<div class='c' id='TB1488'>",
            'from_tag'  => Dao_ChinapubBook::FROM_TAG_XSPH,
            'category'  => Dao_ChinapubBook::CATEGORY_JSJ,
        ),
        array(
            'start_tag' => "<div class='c' id='TB1489'>",
            'from_tag'  => Dao_ChinapubBook::FROM_TAG_XSPH,
            'category'  => Dao_ChinapubBook::CATEGORY_KXJS,
        ),
        array(
            'start_tag' => "<div class='c' id='TB1490'>",
            'from_tag'  => Dao_ChinapubBook::FROM_TAG_XSPH,
            'category'  => Dao_ChinapubBook::CATEGORY_JJGL,
        ),
        array(
            'start_tag' => "<div class='c' id='TB1491'>",
            'from_tag'  => Dao_ChinapubBook::FROM_TAG_XSPH,
            'category'  => Dao_ChinapubBook::CATEGORY_RWSK,
        ),
        //关注排行
        array(
            'start_tag' => "<div class='c' id='TB1492'>",
            'from_tag'  => Dao_ChinapubBook::FROM_TAG_GZPH,
            'category'  => Dao_ChinapubBook::CATEGORY_JSJ,
        ),
        array(
            'start_tag' => "<div class='c' id='TB1493'>",
            'from_tag'  => Dao_ChinapubBook::FROM_TAG_GZPH,
            'category'  => Dao_ChinapubBook::CATEGORY_KXJS,
        ),
        array(
            'start_tag' => "<div class='c' id='TB1494'>",
            'from_tag'  => Dao_ChinapubBook::FROM_TAG_GZPH,
            'category'  => Dao_ChinapubBook::CATEGORY_JJGL,
        ),
        array(
            'start_tag' => "<div class='c' id='TB1496'>",
            'from_tag'  => Dao_ChinapubBook::FROM_TAG_GZPH,
            'category'  => Dao_ChinapubBook::CATEGORY_RWSK,
        ),
        // 评论排行
        array(
            'start_tag' => "<div class='c' id='TB1497'>",
            'from_tag'  => Dao_ChinapubBook::FROM_TAG_PLPH,
            'category'  => Dao_ChinapubBook::CATEGORY_JSJ,
        ),
        array(
            'start_tag' => "<div class='c' id='TB1498'>",
            'from_tag'  => Dao_ChinapubBook::FROM_TAG_PLPH,
            'category'  => Dao_ChinapubBook::CATEGORY_KXJS,
        ),
        array(
            'start_tag' => "<div class='c' id='TB1499'>",
            'from_tag'  => Dao_ChinapubBook::FROM_TAG_PLPH,
            'category'  => Dao_ChinapubBook::CATEGORY_JJGL,
        ),
        array(
            'start_tag' => "<div class='c' id='TB1495'>",
            'from_tag'  => Dao_ChinapubBook::FROM_TAG_PLPH,
            'category'  => Dao_ChinapubBook::CATEGORY_RWSK,
        ),
        // 热门收藏
        array(
            'start_tag' => "<div class='c' id='TB1500'>",
            'from_tag'  => Dao_ChinapubBook::FROM_TAG_RMSC,
            'category'  => Dao_ChinapubBook::CATEGORY_JSJ,
        ),
        array(
            'start_tag' => "<div class='c' id='TB1502'>",
            'from_tag'  => Dao_ChinapubBook::FROM_TAG_RMSC,
            'category'  => Dao_ChinapubBook::CATEGORY_KXJS,
        ),
        array(
            'start_tag' => "<div class='c' id='TB1501'>",
            'from_tag'  => Dao_ChinapubBook::FROM_TAG_RMSC,
            'category'  => Dao_ChinapubBook::CATEGORY_JJGL,
        ),
        array(
            'start_tag' => "<div class='c' id='TB1503'>",
            'from_tag'  => Dao_ChinapubBook::FROM_TAG_RMSC,
            'category'  => Dao_ChinapubBook::CATEGORY_RWSK,
        ),
        // 编辑推荐
        array(
            'start_tag' => "<div class='c' id='TB1475'>",
            'from_tag'  => Dao_ChinapubBook::FROM_TAG_BJTJ,
            'category'  => Dao_ChinapubBook::CATEGORY_JSJ,
        ),
        array(
            'start_tag' => "<div class='c' id='TB1477'>",
            'from_tag'  => Dao_ChinapubBook::FROM_TAG_BJTJ,
            'category'  => Dao_ChinapubBook::CATEGORY_KXJS,
        ),
        array(
            'start_tag' => "<div class='c' id='TB1481'>",
            'from_tag'  => Dao_ChinapubBook::FROM_TAG_BJTJ,
            'category'  => Dao_ChinapubBook::CATEGORY_JJGL,
        ),
        array(
            'start_tag' => "<div class='c' id='TB1476'>",
            'from_tag'  => Dao_ChinapubBook::FROM_TAG_BJTJ,
            'category'  => Dao_ChinapubBook::CATEGORY_RWSK,
        ),
        // 出版社推荐
        array(
            'start_tag' => "<div class='c' id='TB1483'>",
            'from_tag'  => Dao_ChinapubBook::FROM_TAG_CBSTJ,
            'category'  => Dao_ChinapubBook::CATEGORY_JSJ,
        ),
        array(
            'start_tag' => "<div class='c' id='TB1480'>",
            'from_tag'  => Dao_ChinapubBook::FROM_TAG_CBSTJ,
            'category'  => Dao_ChinapubBook::CATEGORY_KXJS,
        ),
        array(
            'start_tag' => "<div class='c' id='TB1482'>",
            'from_tag'  => Dao_ChinapubBook::FROM_TAG_CBSTJ,
            'category'  => Dao_ChinapubBook::CATEGORY_JJGL,
        ),
        array(
            'start_tag' => "<div class='c' id='TB1484'>",
            'from_tag'  => Dao_ChinapubBook::FROM_TAG_CBSTJ,
            'category'  => Dao_ChinapubBook::CATEGORY_RWSK,
        ),
        // 重磅推荐
        array(
            'start_tag' => "<div class='c' id='TB1930'>",
            'from_tag'  => Dao_ChinapubBook::FROM_TAG_ZBTJ,
            'category'  => Dao_ChinapubBook::CATEGORY_JSJ,
        ),
        array(
            'start_tag' => "<div class='c' id='TB1931'>",
            'from_tag'  => Dao_ChinapubBook::FROM_TAG_ZBTJ,
            'category'  => Dao_ChinapubBook::CATEGORY_KXJS,
        ),
        array(
            'start_tag' => "<div class='c' id='TB1932'>",
            'from_tag'  => Dao_ChinapubBook::FROM_TAG_ZBTJ,
            'category'  => Dao_ChinapubBook::CATEGORY_JJGL,
        ),
        array(
            'start_tag' => "<div class='c' id='TB1933'>",
            'from_tag'  => Dao_ChinapubBook::FROM_TAG_ZBTJ,
            'category'  => Dao_ChinapubBook::CATEGORY_RWSK,
        ),
    );

    protected $_books = array();

    public function parse() {
        foreach ($this->_tags as $oneItem) {
            $startIdx = strpos($this->_index_html, $oneItem['start_tag']);
            if ($startIdx === false) {
                $strLog = sprintf('get startIdx fail, from_tag[%d] category[%d] start_tag[%s]', $oneItem['from_tag'], $oneItem['category'], $oneItem['start_tag']);
                Log::warning($strLog);
                continue;
            }

            $endIdx = strpos($this->_index_html, "<div class='clear'>", $startIdx);
            if ($endIdx===false) {
                $strLog = sprintf('get endIdx fail, from_tag[%d] category[%d] start_tag[%s]', $oneItem['from_tag'], $oneItem['category'], $oneItem['start_tag']);
                Log::warning($strLog);
                continue;
            }

            $contents = substr($this->_index_html, $startIdx, $endIdx-$startIdx);

            $bookStartIdx = 0;
            while (true) {
                $bookStartIdx = strpos($contents, '<li>', $bookStartIdx);
                if ($bookStartIdx===false) {
                    break;
                }

                $bookEndIdx = strpos($contents, '</li>', $bookStartIdx);
                if ($bookEndIdx===false) {
                    break;
                }
                $oneBookStr = substr($contents, $bookStartIdx, $bookEndIdx - $bookStartIdx);
                // var_dump($oneBookStr);
                $this->_extractBookInfo($oneBookStr, $oneItem['from_tag'], $oneItem['category']);

                $bookStartIdx = $bookEndIdx;
            }
            // exit();
        }
    }

    public function getBooks() {
        return $this->_books;
    }

    /*
        <li><div class='book_rank'><div class='rank123'><img src='images/shouye2012/rank_one.gif' /></div>< div  class='book_s'><a target='_blank' href='http://product.china-pub.com/7628819'  title='数据即未来：大数据王者之道'><img s rc='http://images.china-pub.com/images/1.png' file='http://images.china-pub.com/ebook7625001-7630000/7628819/zco ver.jpg'  mysrc='/ebook7625001-7630000/7628819' n='-1' onerror='jp.oe(this);'border='0' onload='jp.show(this);'width='104' alt='数据即未来：大数据王者之道'  fid='TB1488'/></a></div><p class='mTop10 price_height'><a target='_blank' href= 'http://product.china-pub.com/7628819'  title='数据即未来：大数据王者之道'>数据即未来：大数据王者之道</a></p><p><span class='book_price'>￥ 79</span><span class='book_dis'>￥55.3</span></p><p><span class='book_five'>VIP价：</span><span class='book_dis_fiv e'>￥55.3</span></p></div>
    */
    protected function _extractBookInfo($contents, $fromTag, $category) {
        $tmp = array();
        $ret = preg_match('/href=\'http:\\/\\/product\.china-pub\.com\/([0-9]+)\'/', $contents, $tmp);
        if (!$ret) {
            Log::warning('get book url fail, ['.$contents.']');
            return ;
        }

        $bookID = $tmp[1];
        $bookUrl = sprintf('http://product.china-pub.com/%d', $bookID);

        $tmp = array();
        $ret = preg_match("/title='([^']+)'/", $contents, $tmp);
        if (!$ret) {
            Log::warning('get book title fail, ['.$contents.']');
            return ;
        }
        $bookTitle = $tmp[1];

        // cover_url
        $tmp = array();
        $ret = preg_match("/ file='([^']+)' +mysrc/", $contents, $tmp);
        if (!$ret) {
            Log::warning('get book cover fail, ['.$contents.']');
            return ;
        }
        $bookCover = $tmp[1];

        // 价格
        $tmp = array();
        $ret = preg_match("/<span class='book_price'>￥([0-9.]+)<\/span>/", $contents, $tmp);
        if (!$ret) {
            Log::warning('get book origin price fail, ['.$contents.']');
            return ;
        }
        $bookOriPrice = $tmp[1];

        $tmp = array();
        $ret = preg_match("/<span class='book_dis'>￥([0-9.]+)<\/span>/", $contents, $tmp);
        if (!$ret) {
            Log::warning('get book origin price fail, ['.$contents.']');
            return ;
        }
        $bookDisPrice = $tmp[1];

        $this->_books[] = array(
            'title'     => $bookTitle,
            'book_id'   => $bookID,
            'book_url'  => $bookUrl,
            'cover_url' => $bookCover,
            'ori_price' => $bookOriPrice,
            'dis_price' => $bookDisPrice,
            'from_tag'  => $fromTag,
            'category'  => $category,
        );
        return ;
    }

}
