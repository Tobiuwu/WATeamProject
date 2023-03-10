<?php
session_start();

$username = !empty($_SESSION['username']) ? $_SESSION['username'] : "Login";
$userId = !empty($_SESSION['user_id']) ? $_SESSION['user_id'] : 0;
$bookId = isset($_GET['id']) ? $_GET['id'] : 0;

if ($bookId == 0) {
    header("Location: book1.php?id=1");
    die();
}

// Get book details by id
require_once('database/fetch.php');
$book = GetBookById($bookId);

// assign variables
$bookTitle = $book[0]['title'];
$authorName = $book[0]['first_name'] . " " . $book[0]['last_name'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="books_style.css">
    
    <title>Book</title>
</head>
<body>
    <div class="page">
        <!-- SIDEBAR -->
        <!-- ------------------------------------------------- -->
        <header class="header">

<div class="header__links">
    <a href="index.php" class="header__link" target = "blank">Domov</a>
  <a href="https://www.novinky.cz/" class="header__link" target = "blank">Novinky</a>
  <a href="https://www.knihovny.cz/" class="header__link" target = "blank">Knihovna</a>
</div>


<a href="login.php" class="header__search" type="text"><?php echo $username ?></a>
<?php
  if($userId != 0) {
    echo <<<HTML
    <a href="logout.php" type="text" >Logout</a>
HTML;
  }
?>

</header>
    </div>
          <main >
            <section class="container">
                <!-- Left Column / Headphones Image -->
                <div class="left-column">
                    <img data-image="red" class="active" src="imgs/<?php echo $bookId ?>.jpg" alt="">
                    
                </div>
                <!-- Right Column -->
                <div class="right-column">
                <!-- Product Description -->
                <div class="product-description">
                    <span><?php echo $authorName ?></span>
                    <h1><?php echo $bookTitle ?></h1>
                    <p>The preferred choice of a vast range of acclaimed DJs. Punchy, bass-focused sound and high isolation. Sturdy headband and on-ear cushions suitable for live performance</p>
                </div>
                </div>
            </section>
            <br>
            <section>
                <div class="text">
                    <p><strong>Liter??rn?? druh:</strong> epika</p>
                    <p><strong>Liter??rn?? ????nr:</strong> alegorick?? bajka</p>
                    <p><strong>Liter??rn?? forma:</strong> pr??za</p>
                    <p><strong>T??ma:</strong> P????b??h zv????at ??ij??c??ch na farm??, kter?? byla postupn?? ovl??d??na totalitn?? moc??.</p>
                    <p><strong>Motivy:</strong> rebelie (vzpoura), do??asn?? solidarita, manipulace, pod????zenost, teror, p????telstv??, intrik????stv??, totalita, politika, po??itk????stv??</p>
                    <p><strong>Hlavn?? my??lenka:</strong> Autor varuje p??ed nebezpe????m n??sil?? a nastolen??m totalitn??ho re??imu.</p>
                    <p><strong>??asoprostor:</strong> Anglie, Jonesova farma</p>
                    <p><strong>Kompozice:</strong> 10 kapitol bez n??zvu; chronologick?? v??stavba d??je</p>
                    <p><strong>Postavy:</strong></p>
                    <ul>
                        <li>pan Jones ??? p??vodn?? majitel farmy; vyko??is??ovatel, kv??li kter??mu zv????ata trp??; alkoholik</li>
                        <li>Major ??? inteligentn?? star?? kanec</li>
                        <li>Napoleon (Stalin) ??? prase, kter?? se ujme veden?? nad statkem spole??n?? s Kuli??em; Napoleon je nejchyt??ej???? ze v??ech, ale zneu????v?? toho ve sv??j prosp??ch; je prolhan??, prosp??ch????sk??, intrik??nsk??, pokryteck??, zr??dce</li>
                        <li>Kuli?? (Trockij) ??? inteligentn?? prase, kter?? vede spole??n?? s Napoleonem farmu do chv??le, ne?? Napoleon na Kuli??e po??tve divok?? psy; Kuli?? je prav??m opakem Napoleona, je ??estn??, m?? dobr?? n??pady, p????telsk??</li>
                        <li>Pi??t??k (propaganda, manipul??tor) ??? prase z farmy, kter?? podporuje Napoleona; stejn?? jako on je prolhan??, ??asto se oh??n?? sm????len??mi v??po??ty ??i rovnicemi, aby obalamutil zv????ec?? obyvatele farmy</li>
                        <li>Boxer (pracuj??c?? lid) ??? pracovit?? k????, nejv??t???? d?????? ze v??ech zv????at</li>
                        <li>Boxer (pracuj??c?? lid) ??? pracovit?? k????, nejv??t???? d?????? ze v??ech zv????at</li>
                        <li>Benjamin ??? osel, p??edstavitel pasivn??ho intelektu??la (Orwell), kter?? zn?? pravdu a tu???? d??sledky, ale nevid?? ????dn?? v??chodisko. Svou aktivitu pova??uje za zbyte??nou, proto??e ovce p??ehlu???? jak??koli vzdor a psi zni???? kohokoli, kdo se postav?? totalitn?? moci.</li>
                        <li>Ovce ??? tup?? dav, bez p??em????len?? opakuj??c?? nau??en?? fr??ze, nemaj?? vlastn?? n??zor, sv??m sborov??m, hlasit??m opakov??n??m fr??z?? p??ehlu???? jak??koli hlas odporu (protin??zor) = ide??ln?? pro totalitn?? spole??nost</li>
                        <li>Psi ??? p??edstavuj?? tajnou policii, kter?? slep?? pln?? rozkazy sv??ho dikt??tora (Napoleon)</li>
                        <li>Krkavec ??? p??edstavuje v??ru (k??es??anstv??), kter?? v totalitn?? spole??nosti ztr??c?? sv?? m??sto, ale na??t??st?? ji nelze zni??it</li>
                    </ul>
                    <p>Vyprav???? se ve Farma zv????at pou????v?? er-formy a autor pou????v?? spisovn?? jazyk, objevuj?? se odborn?? term??ny a pop????pad?? archaismy. V knize se vyskytuj?? r??zn?? jazykov?? prost??edky, jako jsou metafory, p????m?? i nep????m?? ??e??, ironie a kontrasty mezi my??lenkami a realizac?? ideologie. Celkov?? lze ????ci, ??e autor vyu????v?? liter??rn?? formu a jazykov?? prost??edky k tomu, aby co nejv??ce p??ibl????il ??ten??????m realitu totalitn??ch re??im??.</p>
                    <p>V liter??rn??-historick??m kontextu pat???? Farma zv????at k antiutopick??m rom??n??m 2. poloviny 20. stolet??, kter?? nab??zej?? ot??esn?? vize totalitn?? spole??nosti. Autor George Orwell je zn??m?? pro sv?? liter??rn?? d??lo, ve kter??m prol??n?? sci-fi a politickou literaturu.</p>
                </div>


            </section> 
            <form id="postCommentForm" class="add_comment" method="POST">
                <textarea id="commentText" class="comment">Type your comment here.</textarea>
                <input id="bookId" type="hidden" value="<?php echo $bookId ?>"></input>
                <input id="userId" type="hidden" value="<?php echo $userId ?>"></input>
                <br>
                <input id="submitComment" type="submit" name="submit" value="Send">
            </form>
            <section name="coments">
                
            <div id="comment_section" class="comment-thread">
                <!-- Comment 1 start -->
                
                <!-- Comment 1 end -->
            </div>
        </section>
    </main>
    <footer>
        <p class="mt-8 text-base leading-6 text-center text-gray-400">
        ?? 2021 Jecna, All rights reserved.
        </p>
    </footer>
    <script src="js/jquery-3.6.3.min.js"></script>
    <script src="js/form.js"></script>
</body> 
</html>