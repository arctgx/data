<?php

class Dao_ChinapubBook extends DaoBase {

    const FROM_TAG_XSPH  = 1; // 新书排行
    const FROM_TAG_GZPH  = 2; // 关注排行
    const FROM_TAG_PLPH  = 3; // 评论排行
    const FROM_TAG_RMSC  = 4; // 热门收藏
    const FROM_TAG_BJTJ  = 5; // 编辑推荐
    const FROM_TAG_CBSTJ = 6; // 出版社推荐
    const FROM_TAG_ZBTJ  = 7; // 重磅推荐

    const CATEGORY_JSJ  = 1; // 计算机
    const CATEGORY_KXJS = 2; // 科学技术
    const CATEGORY_JJGL = 3; // 经济管理
    const CATEGORY_RWSK = 4; // 人文社科

    protected $_table = 'china_pub_books';

    // todo
    public function getInfoByBookID($bookID) {
        $db = $this->getDB();
        $sql = sprintf('SELECT * FROM %s WHERE book_id = %d', $this->_table, $bookID);
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $ret = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return $ret;
    }

    public function save($saveData) {
        $sql = sprintf(
            'INSERT INTO %s (title, book_id, book_url, cover_url, ori_price, dis_price, from_tag, category, create_at, update_at) VALUES (:title, :book_id, :book_url, :cover_url, :ori_price, :dis_price, :from_tag, :category, :create_at, :update_at)',
            $this->_table
        );

        $curTime = time();
        $db = $this->getDB();
        $stmt = $db->prepare($sql);

        $stmt->bindParam(':title',     $saveData['title'],     \PDO::PARAM_STR);
        $stmt->bindParam(':book_id',   $saveData['book_id'],   \PDO::PARAM_INT);
        $stmt->bindParam(':book_url',  $saveData['book_url'],  \PDO::PARAM_STR);
        $stmt->bindParam(':cover_url', $saveData['cover_url'], \PDO::PARAM_STR);
        $stmt->bindParam(':ori_price', $saveData['ori_price'], \PDO::PARAM_STR);
        $stmt->bindParam(':dis_price', $saveData['dis_price'], \PDO::PARAM_STR);
        $stmt->bindParam(':from_tag',  $saveData['from_tag'],  \PDO::PARAM_INT);
        $stmt->bindParam(':category',  $saveData['category'],  \PDO::PARAM_INT);
        $stmt->bindParam(':create_at', $curTime,               \PDO::PARAM_INT);
        $stmt->bindParam(':update_at', $curTime,               \PDO::PARAM_INT);
        $ret = $stmt->execute();
        if (!$ret) {
            printf("mysql err \n");
            var_dump($stmt->errorInfo());
        }
        return $ret;
    }

}
