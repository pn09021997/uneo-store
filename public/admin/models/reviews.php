<?php
class Review extends Db{

    static function getAllReviews()
    {
        $sql = self::$connection->prepare("SELECT * FROM reviews ORDER BY reviews.created_at DESC");
        $sql->execute();
        $items = array();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $items;
    }

    static function removeReview_ById($productId)
    {
        $sql = self::$connection->prepare("DELETE FROM reviews WHERE product_id = ?");
        $sql->bind_param('i', $productId);
        return $sql->execute();
    }

    static function insertReview($productId, $reviewerName, $reviewerEmail, $reviewTitle ,$content)
    {
        $sql = self::$connection->prepare("INSERT INTO reviews (product_id, reviewer_name, reviewer_email, review_title, content)
        VALUES (?, ?, ?, ?, ?)");
        $sql->bind_param('siissi', $productId, $reviewerName, $reviewerEmail, $reviewTitle, $content);
        return $sql->execute();
    }

    static function getReviews_ByProID($productId) {
        $sql = self::$connection->prepare("SELECT * FROM reviews WHERE product_id like ?");
        $sql->bind_param("i", $productId);
        $sql->execute();
        $items = array();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $items; //return an array.
    }

    static function getReviews_ByProID_andCreatePagination($productId, $page, $resultsPerPage) {
        $firstLink = ($page - 1) * $resultsPerPage;
        $sql = self::$connection->prepare("SELECT * FROM reviews WHERE product_id = ? ORDER BY created_at ASC LIMIT $firstLink, $resultsPerPage");
        $sql->bind_param("s", $productId);
        $sql->execute();
        $items = array();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $items; //return an array.
    }

    static function paginate($url, $page, $totalResults, $resultsPerPage, $offset) {
        $totalLinks = ceil(floatval($totalResults)/floatval($resultsPerPage));
        $links = "";

        $from = $page - $offset;
        $to = $page + $offset;
        if($from <= 0) {
            $from = 1;
            $to = $offset * 2;
        }
        if($to > $totalLinks) {
            $to = $totalLinks;
        }

        $firstLink = "";
        $lastLink = "";
        $prevLink = "";
        $nextLink = "";
        // Trường hợp để xuất hiện $firstLink, $lastLink, $prevLink, $nextLink:
        if($page > 1) {
            $prev = $page - 1;
            $prevLink = "<a style=\"padding:10px;\" href='$url" . "page=$prev' class='paginate-item'>< Previous</a>";
            $firstLink = "<a style=\"padding:10px;\" href='$url" . "page=1' class='paginate-item'><< First</a>";
        }
        if($page < $totalLinks) {
            $next = $page + 1;
            $nextLink = "<a style=\"padding:10px;\" href='$url" . "page=$next'  class='paginate-item'>Next ></a>";
            $lastLink = "<a style=\"padding:10px;\" href='$url" . "page=$totalLinks' class='paginate-item'>Last >></a>";
        }
        // $links:
        for($i=$from; $i<=$to; $i++) {
            if($page == $i) {
                $links = $links . "<a style=\"padding:10px;\" href='$url" . "page=$i' class='paginate-item'>$i</a>";
            }
            else
            {
                $links = $links . "<a style=\"padding:10px;\" href='$url" . "page=$i' class='paginate-item'>$i</a>";
            }
        }
        return $firstLink . $prevLink . $links . $nextLink . $lastLink;
    }
}