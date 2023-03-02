<?php
ini_set('display_errors', 0);


if (isset($_GET['getAllGenres'])) {
	require_once('authenticate_class.php');
	$DB = new Authenticate();
	$html = "";
	$DB->type = 'GetGenres';
	$DB->param = array();
	$result = $DB->Fetch();
	if ($result) {
		foreach	($result as $genre){
			$html .= <<<HTML
			<label class="check">
				<input type="checkbox" class="check__input" value="$genre[ID]" onclick="UpdateBooksByGenre(this)">
				<span class="check__checkbox">
					<svg width="24" height="25" viewBox="0 0 24 25" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M20 6.5L9 17.5L4 12.5" stroke="#fff" stroke-width="2.6" stroke-linecap="round" stroke-linejoin="round" />
					</svg>
				</span>
				<p class="check__text">$genre[genre_name]</p>
			</label>
HTML;
		}
		
		echo $html;
		die();
	} else {
		http_response_code(500);
		die();
	}

} else if (isset($_GET['getAllBooks'])) {
	require_once('authenticate_class.php');
	$DB = new Authenticate();
	$html = "";
	if ($_GET['genreID'] > 0) {
		$DB->type = 'GetGenreBooks';
		$DB->param = array($_GET['genreID']);
	} else {
		$DB->type = 'GetBooks';
		$DB->param = array();
	}
	
	$result = $DB->Fetch();
	if ($result) {
		foreach	($result as $book){
			$html .= <<<HTML
			<div class="item">
				<div class="item__position">
				<img src="imgs/$book[ID].jpg" alt="Plant 1" class="item__image item__image--hue">
				</div>
				<div class="item__detail">
				<p>$book[title]</p>
				<button><a href="book1.php?id=$book[ID]">READ</a></button>
				</div>
			</div>
HTML;
		}
		
		echo json_encode(array("html"=>$html, "num"=>count($result)));
		die();
	} else {
		http_response_code(500);
		die();
	}
} else if (isset($_GET['getCommentsByBook']) && $_GET['bookId'] > 0) {
	require_once('authenticate_class.php');
	$DB = new Authenticate();
	$html = "";
	$DB->type = 'GetCommentByBook';
	$DB->param = array($_GET['bookId']);
	$result = $DB->Fetch();
	if ($result) {
		foreach	($result as $comment){
			$html .= <<<HTML
			<details open class="comment" id="$comment[ID]">
                    <summary>
                        <div class="comment-heading">
                            <div class="comment-info">
                                <a href="#" class="comment-author">$comment[first_name]</a>
                            </div>
                        </div>
                    </summary>
            
                    <div class="comment-body">
                        <p>
							$comment[contents]
                        </p>
                    </div>
                    
                </details>
HTML;
		}
		
		echo json_encode(array("html"=>$html, "num"=>count($result)));
		die();
	} else {
		http_response_code(500);
		die();
	}
}

function GetBookById($id)  {
	require_once('authenticate_class.php');
	$DB = new Authenticate();
	$DB->type = 'GetBookById';
	$DB->param = array($id);
	return $DB->Fetch();
}
?>