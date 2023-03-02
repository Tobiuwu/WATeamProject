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
                    <p><strong>Literární druh:</strong> epika</p>
                    <p><strong>Literární žánr:</strong> alegorická bajka</p>
                    <p><strong>Literární forma:</strong> próza</p>
                    <p><strong>Téma:</strong> Příběh zvířat žijících na farmě, která byla postupně ovládána totalitní mocí.</p>
                    <p><strong>Motivy:</strong> rebelie (vzpoura), dočasná solidarita, manipulace, podřízenost, teror, přátelství, intrikářství, totalita, politika, požitkářství</p>
                    <p><strong>Hlavní myšlenka:</strong> Autor varuje před nebezpečím násilí a nastolením totalitního režimu.</p>
                    <p><strong>Časoprostor:</strong> Anglie, Jonesova farma</p>
                    <p><strong>Kompozice:</strong> 10 kapitol bez názvu; chronologická výstavba děje</p>
                    <p><strong>Postavy:</strong></p>
                    <ul>
                        <li>pan Jones – původní majitel farmy; vykořisťovatel, kvůli kterému zvířata trpí; alkoholik</li>
                        <li>Major – inteligentní starý kanec</li>
                        <li>Napoleon (Stalin) – prase, které se ujme vedení nad statkem společně s Kulišem; Napoleon je nejchytřejší ze všech, ale zneužívá toho ve svůj prospěch; je prolhaný, prospěchářský, intrikánský, pokrytecký, zrádce</li>
                        <li>Kuliš (Trockij) – inteligentní prase, které vede společně s Napoleonem farmu do chvíle, než Napoleon na Kuliše poštve divoké psy; Kuliš je pravým opakem Napoleona, je čestný, má dobré nápady, přátelský</li>
                        <li>Pištík (propaganda, manipulátor) – prase z farmy, které podporuje Napoleona; stejně jako on je prolhaný, často se ohání smýšlenými výpočty či rovnicemi, aby obalamutil zvířecí obyvatele farmy</li>
                        <li>Boxer (pracující lid) – pracovitý kůň, největší dříč ze všech zvířat</li>
                        <li>Boxer (pracující lid) – pracovitý kůň, největší dříč ze všech zvířat</li>
                        <li>Benjamin – osel, představitel pasivního intelektuála (Orwell), který zná pravdu a tuší důsledky, ale nevidí žádné východisko. Svou aktivitu považuje za zbytečnou, protože ovce přehluší jakýkoli vzdor a psi zničí kohokoli, kdo se postaví totalitní moci.</li>
                        <li>Ovce – tupý dav, bez přemýšlení opakující naučené fráze, nemají vlastní názor, svým sborovým, hlasitým opakováním frází přehluší jakýkoli hlas odporu (protinázor) = ideální pro totalitní společnost</li>
                        <li>Psi – představují tajnou policii, která slepě plní rozkazy svého diktátora (Napoleon)</li>
                        <li>Krkavec – představuje víru (křesťanství), která v totalitní společnosti ztrácí své místo, ale naštěstí ji nelze zničit</li>
                    </ul>
                    <p>Vypravěč se ve Farma zvířat používá er-formy a autor používá spisovný jazyk, objevují se odborné termíny a popřípadě archaismy. V knize se vyskytují různé jazykové prostředky, jako jsou metafory, přímá i nepřímá řeč, ironie a kontrasty mezi myšlenkami a realizací ideologie. Celkově lze říci, že autor využívá literární formu a jazykové prostředky k tomu, aby co nejvíce přiblížil čtenářům realitu totalitních režimů.</p>
                    <p>V literárně-historickém kontextu patří Farma zvířat k antiutopickým románům 2. poloviny 20. století, které nabízejí otřesné vize totalitní společnosti. Autor George Orwell je známý pro své literární dílo, ve kterém prolíná sci-fi a politickou literaturu.</p>
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
        © 2021 Jecna, All rights reserved.
        </p>
    </footer>
    <script src="js/jquery-3.6.3.min.js"></script>
    <script src="js/form.js"></script>
</body> 
</html>