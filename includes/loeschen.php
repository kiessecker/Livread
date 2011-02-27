<?php 


# Check if book request is valid
if(!isset($_GET["book"])) exit;
$_GET["book"]=(int)$_GET["book"];
if($_GET["book"]<0) $_GET["book"]=-1;



# Does the user own the book?
$sql="SELECT book_id FROM books WHERE book_id=".addslashes($_GET["book"])." AND book_path LIKE './repository/".$_SESSION["username"]."/%' LIMIT 0,1";
$result=mysql_query($sql);
if(mysql_num_rows($result)<1) {
	?>
<script type="text/javascript">
parent.renderSimpleDialog("Mitteilung","Fehler","Sie besitzen kein Buch, wie Sie es angefordert haben!");
</script>
	</body>
</html>
	<?php
	exit;
}


$sql="SELECT * FROM books WHERE book_id=".addslashes($_GET["book"])." LIMIT 0,1";
$result=mysql_query($sql);
$row = mysql_fetch_assoc($result);
$contents=$row["original_content"];




?><!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.1//EN' 'http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd'>

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">

  <head>
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta
      name="viewport"
      content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;"
    />
    <meta http-equiv="Content-Type" content="text/htmlcharset=utf-8"/>
    <title>Monocle Simple test</title>

    <!-- MONOCLE CORE -->
    <script type="text/javascript" src="js/monocle/monocle.js"></script>
    <script type="text/javascript" src="js/monocle/compat.js"></script>
    <script type="text/javascript" src="js/monocle/reader.js"></script>
    <script type="text/javascript" src="js/monocle/book.js"></script>
    <script type="text/javascript" src="js/monocle/component.js"></script>
    <script type="text/javascript" src="js/monocle/place.js"></script>
    <script type="text/javascript" src="js/monocle/styles.js"></script>

    <!-- MONOCLE FLIPPERS -->
    <script type="text/javascript" src="js/monocle/flippers/slider.js"></script>
    <script type="text/javascript" src="js/monocle/flippers/legacy.js"></script>

    <!-- MONOCLE STANDARD CONTROLS -->
    <script type="text/javascript" src="js/monocle/controls/spinner.js"></script>
    <script type="text/javascript" src="js/monocle/controls/magnifier.js"></script>
    <script type="text/javascript" src="js/monocle/controls/scrubber.js"></script>
    <script type="text/javascript" src="js/monocle/controls/placesaver.js"></script>
    <script type="text/javascript" src="js/monocle/controls/contents.js"></script>

    <link rel="stylesheet" type="text/css" href="styles/monocle.css" />
    <script type="text/javascript" src="js/monocle/default.js"></script>
  </head>

  <body>
    <div id="readerBg">
      <div class="board"></div>
      <div class="jacket"></div>
      <div class="dummyPage"></div>
      <div class="dummyPage"></div>
      <div class="dummyPage"></div>
      <div class="dummyPage"></div>
      <div class="dummyPage"></div>
    </div>

    <div id="readerCntr">
      <div id="reader"></div>
    </div>

    <div id="components">
      <div id="part1">
	<pre>
	<?php echo $contents;?>
	</pre>



        <h1>
            Book the First&mdash;Recalled to Life
        </h1>

        <h2 id="part1-I">
            I. The Period
        </h2>
        <blockquote>
          It was the best of times,<br>
          it was the worst of times,<br>
          it was the age of wisdom,<br>
          it was the age of foolishness,<br>
          it was the epoch of belief,<br>
          it was the epoch of incredulity,<br>
          it was the season of Light,<br>
          it was the season of Darkness,<br>
          it was the spring of hope,<br>
          it was the winter of despair,
        </blockquote>
        <p>
        we had everything before us, we had nothing before us, we were
        all going direct to Heaven, we were all going direct the other way&mdash;
        in short, the period was so far like the present period, that some of its
        noisiest authorities insisted on its being received, for good or for
        evil, in the superlative degree of comparison only.
        </p>
        <p>
        There were a king with a large jaw and a queen with a plain face, on the
        throne of England; there were a king with a large jaw and a queen with
        a fair face, on the throne of France. In both countries it was clearer
        than crystal to the lords of the State preserves of loaves and fishes,
        that things in general were settled for ever.
        </p>
        <p>
        It was the year of Our Lord one thousand seven hundred and seventy-five.
        Spiritual revelations were conceded to England at that favoured period,
        as at this. Mrs. Southcott had recently attained her five-and-twentieth
        blessed birthday, of whom a prophetic private in the Life Guards had
        heralded the sublime appearance by announcing that arrangements were
        made for the swallowing up of London and Westminster. Even the Cock-lane
        ghost had been laid only a round dozen of years, after rapping out its
        messages, as the spirits of this very year last past (supernaturally
        deficient in originality) rapped out theirs. Mere messages in the
        earthly order of events had lately come to the English Crown and People,
        from a congress of British subjects in America: which, strange
        to relate, have proved more important to the human race than any
        communications yet received through any of the chickens of the Cock-lane
        brood.
        </p>
        <p>
        France, less favoured on the whole as to matters spiritual than her
        sister of the shield and trident, rolled with exceeding smoothness down
        hill, making paper money and spending it. Under the guidance of her
        Christian pastors, she entertained herself, besides, with such humane
        achievements as sentencing a youth to have his hands cut off, his tongue
        torn out with pincers, and his body burned alive, because he had not
        kneeled down in the rain to do honour to a dirty procession of monks
        which passed within his view, at a distance of some fifty or sixty
        yards. It is likely enough that, rooted in the woods of France and
        Norway, there were growing trees, when that sufferer was put to death,
        already marked by the Woodman, Fate, to come down and be sawn into
        boards, to make a certain movable framework with a sack and a knife in
        it, terrible in history. It is likely enough that in the rough outhouses
        of some tillers of the heavy lands adjacent to Paris, there were
        sheltered from the weather that very day, rude carts, bespattered with
        rustic mire, snuffed about by pigs, and roosted in by poultry, which
        the Farmer, Death, had already set apart to be his tumbrils of
        the Revolution. But that Woodman and that Farmer, though they work
        unceasingly, work silently, and no one heard them as they went about
        with muffled tread: the rather, forasmuch as to entertain any suspicion
        that they were awake, was to be atheistical and traitorous.
        </p>
        <p>
        In England, there was scarcely an amount of order and protection to
        justify much national boasting. Daring burglaries by armed men, and
        highway robberies, took place in the capital itself every night;
        families were publicly cautioned not to go out of town without removing
        their furniture to upholsterers' warehouses for security; the highwayman
        in the dark was a City tradesman in the light, and, being recognised and
        challenged by his fellow-tradesman whom he stopped in his character of
        "the Captain," gallantly shot him through the head and rode away; the
        mail was waylaid by seven robbers, and the guard shot three dead, and
        then got shot dead himself by the other four, "in consequence of the
        failure of his ammunition:" after which the mail was robbed in peace;
        that magnificent potentate, the Lord Mayor of London, was made to stand
        and deliver on Turnham Green, by one highwayman, who despoiled the
        illustrious creature in sight of all his retinue; prisoners in London
        gaols fought battles with their turnkeys, and the majesty of the law
        fired blunderbusses in among them, loaded with rounds of shot and ball;
        thieves snipped off diamond crosses from the necks of noble lords at
        Court drawing-rooms; musketeers went into St. Giles's, to search
        for contraband goods, and the mob fired on the musketeers, and the
        musketeers fired on the mob, and nobody thought any of these occurrences
        much out of the common way. In the midst of them, the hangman, ever busy
        and ever worse than useless, was in constant requisition; now, stringing
        up long rows of miscellaneous criminals; now, hanging a housebreaker on
        Saturday who had been taken on Tuesday; now, burning people in the
        hand at Newgate by the dozen, and now burning pamphlets at the door of
        Westminster Hall; to-day, taking the life of an atrocious murderer,
        and to-morrow of a wretched pilferer who had robbed a farmer's boy of
        sixpence.

        </p>
        <p>
        All these things, and a thousand like them, came to pass in and close
        upon the dear old year one thousand seven hundred and seventy-five.
        Environed by them, while the Woodman and the Farmer worked unheeded,
        those two of the large jaws, and those other two of the plain and the
        fair faces, trod with stir enough, and carried their divine rights
        with a high hand. Thus did the year one thousand seven hundred
        and seventy-five conduct their Greatnesses, and myriads of small
        creatures&mdash;the creatures of this chronicle among the rest&mdash;along the
        roads that lay before them.
        </p>

        <h2 id="part1-II">
            II. The Mail
        </h2>
        <p>
        It was the Dover road that lay, on a Friday night late in November,
        before the first of the persons with whom this history has business.
        The Dover road lay, as to him, beyond the Dover mail, as it lumbered up
        Shooter's Hill. He walked up hill in the mire by the side of the mail,
        as the rest of the passengers did; not because they had the least relish
        for walking exercise, under the circumstances, but because the hill,
        and the harness, and the mud, and the mail, were all so heavy, that the
        horses had three times already come to a stop, besides once drawing the
        coach across the road, with the mutinous intent of taking it back
        to Blackheath. Reins and whip and coachman and guard, however, in
        combination, had read that article of war which forbade a purpose
        otherwise strongly in favour of the argument, that some brute animals
        are endued with Reason; and the team had capitulated and returned to
        their duty.
        </p>

        <p>
        With drooping heads and tremulous tails, they mashed their way through
        the thick mud, floundering and stumbling between whiles, as if they were
        falling to pieces at the larger joints. As often as the driver rested
        them and brought them to a stand, with a wary "Wo-ho! so-ho-then!" the
        near leader violently shook his head and everything upon it&mdash;like an
        unusually emphatic horse, denying that the coach could be got up the
        hill. Whenever the leader made this rattle, the passenger started, as a
        nervous passenger might, and was disturbed in mind.
        </p>
        <p>
        There was a steaming mist in all the hollows, and it had roamed in its
        forlornness up the hill, like an evil spirit, seeking rest and finding
        none. A clammy and intensely cold mist, it made its slow way through the
        air in ripples that visibly followed and overspread one another, as the
        waves of an unwholesome sea might do. It was dense enough to shut out
        everything from the light of the coach-lamps but these its own workings,
        and a few yards of road; and the reek of the labouring horses steamed
        into it, as if they had made it all.
        </p>
        <p>
        Two other passengers, besides the one, were plodding up the hill by the
        side of the mail. All three were wrapped to the cheekbones and over the
        ears, and wore jack-boots. Not one of the three could have said, from
        anything he saw, what either of the other two was like; and each was
        hidden under almost as many wrappers from the eyes of the mind, as from
        the eyes of the body, of his two companions. In those days, travellers
        were very shy of being confidential on a short notice, for anybody on
        the road might be a robber or in league with robbers. As to the latter,
        when every posting-house and ale-house could produce somebody in
        "the Captain's" pay, ranging from the landlord to the lowest stable
        non-descript, it was the likeliest thing upon the cards. So the guard
        of the Dover mail thought to himself, that Friday night in November, one
        thousand seven hundred and seventy-five, lumbering up Shooter's Hill, as
        he stood on his own particular perch behind the mail, beating his feet,
        and keeping an eye and a hand on the arm-chest before him, where a
        loaded blunderbuss lay at the top of six or eight loaded horse-pistols,
        deposited on a substratum of cutlass.
        </p>
        <p>
        The Dover mail was in its usual genial position that the guard suspected
        the passengers, the passengers suspected one another and the guard, they
        all suspected everybody else, and the coachman was sure of nothing but
        the horses; as to which cattle he could with a clear conscience have
        taken his oath on the two Testaments that they were not fit for the
        journey.
        </p>
        <p>
        "Wo-ho!" said the coachman. "So, then! One more pull and you're at the
        top and be damned to you, for I have had trouble enough to get you to
        it!&mdash;Joe!"
        </p>

        <p>
        "Halloa!" the guard replied.
        </p>
        <p>
        "What o'clock do you make it, Joe?"
        </p>
        <p>
        "Ten minutes, good, past eleven."
        </p>
        <p>
        "My blood!" ejaculated the vexed coachman, "and not atop of Shooter's
        yet! Tst! Yah! Get on with you!"
        </p>
        <p>
        The emphatic horse, cut short by the whip in a most decided negative,
        made a decided scramble for it, and the three other horses followed
        suit. Once more, the Dover mail struggled on, with the jack-boots of its
        passengers squashing along by its side. They had stopped when the coach
        stopped, and they kept close company with it. If any one of the three
        had had the hardihood to propose to another to walk on a little ahead
        into the mist and darkness, he would have put himself in a fair way of
        getting shot instantly as a highwayman.
        </p>
        <p>
        The last burst carried the mail to the summit of the hill. The horses
        stopped to breathe again, and the guard got down to skid the wheel for
        the descent, and open the coach-door to let the passengers in.

        </p>
        <p>
        "Tst! Joe!" cried the coachman in a warning voice, looking down from his
        box.
        </p>
        <p>
        "What do you say, Tom?"
        </p>
        <p>
        They both listened.
        </p>
        <p>
        "I say a horse at a canter coming up, Joe."
        </p>
        <p>
        "<i>I</i> say a horse at a gallop, Tom," returned the guard, leaving his hold
        of the door, and mounting nimbly to his place. "Gentlemen! In the king's
        name, all of you!"

        </p>
        <p>
        With this hurried adjuration, he cocked his blunderbuss, and stood on
        the offensive.
        </p>
        <p>
        The passenger booked by this history, was on the coach-step, getting in;
        the two other passengers were close behind him, and about to follow. He
        remained on the step, half in the coach and half out of; they remained
        in the road below him. They all looked from the coachman to the guard,
        and from the guard to the coachman, and listened. The coachman looked
        back and the guard looked back, and even the emphatic leader pricked up
        his ears and looked back, without contradicting.
        </p>
        <p>
        The stillness consequent on the cessation of the rumbling and labouring
        of the coach, added to the stillness of the night, made it very quiet
        indeed. The panting of the horses communicated a tremulous motion to
        the coach, as if it were in a state of agitation. The hearts of the
        passengers beat loud enough perhaps to be heard; but at any rate, the
        quiet pause was audibly expressive of people out of breath, and holding
        the breath, and having the pulses quickened by expectation.
        </p>
        <p>
        The sound of a horse at a gallop came fast and furiously up the hill.
        </p>
        <p>
        "So-ho!" the guard sang out, as loud as he could roar. "Yo there! Stand!
        I shall fire!"
        </p>
        <p>

        The pace was suddenly checked, and, with much splashing and floundering,
        a man's voice called from the mist, "Is that the Dover mail?"
        </p>
        <p>
        "Never you mind what it is!" the guard retorted. "What are you?"
        </p>
        <p>
        "<i>Is</i> that the Dover mail?"
        </p>
        <p>
        "Why do you want to know?"
        </p>
        <p>
        "I want a passenger, if it is."
        </p>

        <p>
        "What passenger?"
        </p>
        <p>
        "Mr. Jarvis Lorry."
        </p>
        <p>
        Our booked passenger showed in a moment that it was his name. The guard,
        the coachman, and the two other passengers eyed him distrustfully.
        </p>
        <p>
        "Keep where you are," the guard called to the voice in the mist,
        "because, if I should make a mistake, it could never be set right in
        your lifetime. Gentleman of the name of Lorry answer straight."
        </p>
        <p>
        "What is the matter?" asked the passenger, then, with mildly quavering
        speech. "Who wants me? Is it Jerry?"
        </p>
        <p>
        ("I don't like Jerry's voice, if it is Jerry," growled the guard to
        himself. "He's hoarser than suits me, is Jerry.")

        </p>
        <p>
        "Yes, Mr. Lorry."
        </p>
        <p>
        "What is the matter?"
        </p>
        <p>
        "A despatch sent after you from over yonder. T. and Co."
        </p>
        <p>
        "I know this messenger, guard," said Mr. Lorry, getting down into the
        road&mdash;assisted from behind more swiftly than politely by the other two
        passengers, who immediately scrambled into the coach, shut the door, and
        pulled up the window. "He may come close; there's nothing wrong."
        </p>
        <p>
        "I hope there ain't, but I can't make so 'Nation sure of that," said the
        guard, in gruff soliloquy. "Hallo you!"
        </p>

        <p>
        "Well! And hallo you!" said Jerry, more hoarsely than before.
        </p>
        <p>
        "Come on at a footpace! d'ye mind me? And if you've got holsters to that
        saddle o' yourn, don't let me see your hand go nigh 'em. For I'm a devil
        at a quick mistake, and when I make one it takes the form of Lead. So
        now let's look at you."
        </p>
        <p>
        The figures of a horse and rider came slowly through the eddying mist,
        and came to the side of the mail, where the passenger stood. The rider
        stooped, and, casting up his eyes at the guard, handed the passenger
        a small folded paper. The rider's horse was blown, and both horse and
        rider were covered with mud, from the hoofs of the horse to the hat of
        the man.
        </p>
        <p>
        "Guard!" said the passenger, in a tone of quiet business confidence.
        </p>
        <p>
        The watchful guard, with his right hand at the stock of his raised
        blunderbuss, his left at the barrel, and his eye on the horseman,
        answered curtly, "Sir."
        </p>
        <p>
        "There is nothing to apprehend. I belong to Tellson's Bank. You must
        know Tellson's Bank in London. I am going to Paris on business. A crown
        to drink. I may read this?"

        </p>
        <p>
        "If so be as you're quick, sir."
        </p>
        <p>
        He opened it in the light of the coach-lamp on that side, and
        read&mdash;first to himself and then aloud: "'Wait at Dover for Mam'selle.'
        It's not long, you see, guard. Jerry, say that my answer was, RECALLED
        TO LIFE."
        </p>
        <p>
        Jerry started in his saddle. "That's a Blazing strange answer, too,"
        said he, at his hoarsest.
        </p>
        <p>
        "Take that message back, and they will know that I received this, as
        well as if I wrote. Make the best of your way. Good night."
        </p>
        <p>
        With those words the passenger opened the coach-door and got in; not at
        all assisted by his fellow-passengers, who had expeditiously secreted
        their watches and purses in their boots, and were now making a general
        pretence of being asleep. With no more definite purpose than to escape
        the hazard of originating any other kind of action.
        </p>

        <p>
        The coach lumbered on again, with heavier wreaths of mist closing round
        it as it began the descent. The guard soon replaced his blunderbuss
        in his arm-chest, and, having looked to the rest of its contents, and
        having looked to the supplementary pistols that he wore in his belt,
        looked to a smaller chest beneath his seat, in which there were a
        few smith's tools, a couple of torches, and a tinder-box. For he was
        furnished with that completeness that if the coach-lamps had been blown
        and stormed out, which did occasionally happen, he had only to shut
        himself up inside, keep the flint and steel sparks well off the straw,
        and get a light with tolerable safety and ease (if he were lucky) in
        five minutes.
        </p>
        <p>
        "Tom!" softly over the coach roof.
        </p>
        <p>
        "Hallo, Joe."
        </p>
        <p>
        "Did you hear the message?"
        </p>
        <p>
        "I did, Joe."
        </p>
        <p>
        "What did you make of it, Tom?"

        </p>
        <p>
        "Nothing at all, Joe."
        </p>
        <p>
        "That's a coincidence, too," the guard mused, "for I made the same of it
        myself."
        </p>
        <p>
        Jerry, left alone in the mist and darkness, dismounted meanwhile, not
        only to ease his spent horse, but to wipe the mud from his face, and
        shake the wet out of his hat-brim, which might be capable of
        holding about half a gallon. After standing with the bridle over his
        heavily-splashed arm, until the wheels of the mail were no longer within
        hearing and the night was quite still again, he turned to walk down the
        hill.
        </p>
        <p>
        "After that there gallop from Temple Bar, old lady, I won't trust your
        fore-legs till I get you on the level," said this hoarse messenger,
        glancing at his mare. "'Recalled to life.' That's a Blazing strange
        message. Much of that wouldn't do for you, Jerry! I say, Jerry! You'd
        be in a Blazing bad way, if recalling to life was to come into fashion,
        Jerry!"
        </p>
      </div>

      <div id="part1-III">
        <h2>
            III. The Night Shadows
        </h2>
        <p>
        A wonderful fact to reflect upon, that every human creature is
        constituted to be that profound secret and mystery to every other. A
        solemn consideration, when I enter a great city by night, that every
        one of those darkly clustered houses encloses its own secret; that every
        room in every one of them encloses its own secret; that every beating
        heart in the hundreds of thousands of breasts there, is, in some of
        its imaginings, a secret to the heart nearest it! Something of the
        awfulness, even of Death itself, is referable to this. No more can I
        turn the leaves of this dear book that I loved, and vainly hope in time
        to read it all. No more can I look into the depths of this unfathomable
        water, wherein, as momentary lights glanced into it, I have had glimpses
        of buried treasure and other things submerged. It was appointed that the
        book should shut with a spring, for ever and for ever, when I had read
        but a page. It was appointed that the water should be locked in an
        eternal frost, when the light was playing on its surface, and I stood
        in ignorance on the shore. My friend is dead, my neighbour is dead,
        my love, the darling of my soul, is dead; it is the inexorable
        consolidation and perpetuation of the secret that was always in that
        individuality, and which I shall carry in mine to my life's end. In
        any of the burial-places of this city through which I pass, is there
        a sleeper more inscrutable than its busy inhabitants are, in their
        innermost personality, to me, or than I am to them?
        </p>
        <p>
        As to this, his natural and not to be alienated inheritance, the
        messenger on horseback had exactly the same possessions as the King, the
        first Minister of State, or the richest merchant in London. So with the
        three passengers shut up in the narrow compass of one lumbering old mail
        coach; they were mysteries to one another, as complete as if each had
        been in his own coach and six, or his own coach and sixty, with the
        breadth of a county between him and the next.
        </p>
        <p>
        The messenger rode back at an easy trot, stopping pretty often at
        ale-houses by the way to drink, but evincing a tendency to keep his
        own counsel, and to keep his hat cocked over his eyes. He had eyes that
        assorted very well with that decoration, being of a surface black, with
        no depth in the colour or form, and much too near together&mdash;as if they
        were afraid of being found out in something, singly, if they kept too
        far apart. They had a sinister expression, under an old cocked-hat like
        a three-cornered spittoon, and over a great muffler for the chin and
        throat, which descended nearly to the wearer's knees. When he stopped
        for drink, he moved this muffler with his left hand, only while he
        poured his liquor in with his right; as soon as that was done, he
        muffled again.
        </p>
        <p>
        "No, Jerry, no!" said the messenger, harping on one theme as he rode.
        "It wouldn't do for you, Jerry. Jerry, you honest tradesman, it wouldn't
        suit <i>your</i> line of business! Recalled&mdash;! Bust me if I don't think he'd
        been a drinking!"

        </p>
        <p>
        His message perplexed his mind to that degree that he was fain, several
        times, to take off his hat to scratch his head. Except on the crown,
        which was raggedly bald, he had stiff, black hair, standing jaggedly all
        over it, and growing down hill almost to his broad, blunt nose. It was
        so like Smith's work, so much more like the top of a strongly spiked
        wall than a head of hair, that the best of players at leap-frog might
        have declined him, as the most dangerous man in the world to go over.
        </p>
        <p>
        While he trotted back with the message he was to deliver to the night
        watchman in his box at the door of Tellson's Bank, by Temple Bar, who
        was to deliver it to greater authorities within, the shadows of the
        night took such shapes to him as arose out of the message, and took such
        shapes to the mare as arose out of <i>her</i> private topics of uneasiness.
        They seemed to be numerous, for she shied at every shadow on the road.
        </p>
        <p>
        What time, the mail-coach lumbered, jolted, rattled, and bumped upon
        its tedious way, with its three fellow-inscrutables inside. To whom,
        likewise, the shadows of the night revealed themselves, in the forms
        their dozing eyes and wandering thoughts suggested.
        </p>
        <p>
        Tellson's Bank had a run upon it in the mail. As the bank
        passenger&mdash;with an arm drawn through the leathern strap, which did what
        lay in it to keep him from pounding against the next passenger,
        and driving him into his corner, whenever the coach got a special
        jolt&mdash;nodded in his place, with half-shut eyes, the little
        coach-windows, and the coach-lamp dimly gleaming through them, and the
        bulky bundle of opposite passenger, became the bank, and did a great
        stroke of business. The rattle of the harness was the chink of money,
        and more drafts were honoured in five minutes than even Tellson's, with
        all its foreign and home connection, ever paid in thrice the time. Then
        the strong-rooms underground, at Tellson's, with such of their valuable
        stores and secrets as were known to the passenger (and it was not a
        little that he knew about them), opened before him, and he went in among
        them with the great keys and the feebly-burning candle, and found them
        safe, and strong, and sound, and still, just as he had last seen them.

        </p>
        <p>
        But, though the bank was almost always with him, and though the coach
        (in a confused way, like the presence of pain under an opiate) was
        always with him, there was another current of impression that never
        ceased to run, all through the night. He was on his way to dig some one
        out of a grave.
        </p>
        <p>
        Now, which of the multitude of faces that showed themselves before him
        was the true face of the buried person, the shadows of the night did
        not indicate; but they were all the faces of a man of five-and-forty by
        years, and they differed principally in the passions they expressed,
        and in the ghastliness of their worn and wasted state. Pride, contempt,
        defiance, stubbornness, submission, lamentation, succeeded one another;
        so did varieties of sunken cheek, cadaverous colour, emaciated hands
        and figures. But the face was in the main one face, and every head was
        prematurely white. A hundred times the dozing passenger inquired of this
        spectre:
        </p>
        <p>
        "Buried how long?"
        </p>
        <p>
        The answer was always the same: "Almost eighteen years."
        </p>
        <p>
        "You had abandoned all hope of being dug out?"
        </p>
        <p>

        "Long ago."
        </p>
        <p>
        "You know that you are recalled to life?"
        </p>
        <p>
        "They tell me so."
        </p>
        <p>
        "I hope you care to live?"
        </p>
        <p>
        "I can't say."
        </p>
        <p>
        "Shall I show her to you? Will you come and see her?"
        </p>

        <p>
        The answers to this question were various and contradictory. Sometimes
        the broken reply was, "Wait! It would kill me if I saw her too soon."
        Sometimes, it was given in a tender rain of tears, and then it was,
        "Take me to her." Sometimes it was staring and bewildered, and then it
        was, "I don't know her. I don't understand."
        </p>
        <p>
        After such imaginary discourse, the passenger in his fancy would dig,
        and dig, dig&mdash;now with a spade, now with a great key, now with his
        hands&mdash;to dig this wretched creature out. Got out at last, with earth
        hanging about his face and hair, he would suddenly fan away to dust. The
        passenger would then start to himself, and lower the window, to get the
        reality of mist and rain on his cheek.
        </p>
        <p>
        Yet even when his eyes were opened on the mist and rain, on the moving
        patch of light from the lamps, and the hedge at the roadside retreating
        by jerks, the night shadows outside the coach would fall into the train
        of the night shadows within. The real Banking-house by Temple Bar, the
        real business of the past day, the real strong rooms, the real express
        sent after him, and the real message returned, would all be there. Out
        of the midst of them, the ghostly face would rise, and he would accost
        it again.
        </p>
        <p>
        "Buried how long?"
        </p>
        <p>
        "Almost eighteen years."
        </p>

        <p>
        "I hope you care to live?"
        </p>
        <p>
        "I can't say."
        </p>
        <p>
        Dig&mdash;dig&mdash;dig&mdash;until an impatient movement from one of the two
        passengers would admonish him to pull up the window, draw his arm
        securely through the leathern strap, and speculate upon the two
        slumbering forms, until his mind lost its hold of them, and they again
        slid away into the bank and the grave.
        </p>
        <p>
        "Buried how long?"
        </p>
        <p>
        "Almost eighteen years."

        </p>
        <p>
        "You had abandoned all hope of being dug out?"
        </p>
        <p>
        "Long ago."
        </p>
        <p>
        The words were still in his hearing as just spoken&mdash;distinctly in
        his hearing as ever spoken words had been in his life&mdash;when the weary
        passenger started to the consciousness of daylight, and found that the
        shadows of the night were gone.
        </p>
        <p>
        He lowered the window, and looked out at the rising sun. There was a
        ridge of ploughed land, with a plough upon it where it had been left
        last night when the horses were unyoked; beyond, a quiet coppice-wood,
        in which many leaves of burning red and golden yellow still remained
        upon the trees. Though the earth was cold and wet, the sky was clear,
        and the sun rose bright, placid, and beautiful.
        </p>
        <p>
        "Eighteen years!" said the passenger, looking at the sun. "Gracious
        Creator of day! To be buried alive for eighteen years!"

        </p>
      </div>

      <div id="part1-IV">
        <h2>
            IV. The Preparation
        </h2>
        <p>
        When the mail got successfully to Dover, in the course of the forenoon,
        the head drawer at the Royal George Hotel opened the coach-door as his
        custom was. He did it with some flourish of ceremony, for a mail journey
        from London in winter was an achievement to congratulate an adventurous
        traveller upon.
        </p>
        <p>
        By that time, there was only one adventurous traveller left be
        congratulated: for the two others had been set down at their respective
        roadside destinations. The mildewy inside of the coach, with its damp
        and dirty straw, its disagreeable smell, and its obscurity, was rather
        like a larger dog-kennel. Mr. Lorry, the passenger, shaking himself out
        of it in chains of straw, a tangle of shaggy wrapper, flapping hat, and
        muddy legs, was rather like a larger sort of dog.
        </p>
        <p>
        "There will be a packet to Calais, tomorrow, drawer?"

        </p>
        <p>
        "Yes, sir, if the weather holds and the wind sets tolerable fair. The
        tide will serve pretty nicely at about two in the afternoon, sir. Bed,
        sir?"
        </p>
        <p>
        "I shall not go to bed till night; but I want a bedroom, and a barber."
        </p>
        <p>
        "And then breakfast, sir? Yes, sir. That way, sir, if you please.
        Show Concord! Gentleman's valise and hot water to Concord. Pull off
        gentleman's boots in Concord. (You will find a fine sea-coal fire, sir.)
        Fetch barber to Concord. Stir about there, now, for Concord!"
        </p>
        <p>
        The Concord bed-chamber being always assigned to a passenger by the
        mail, and passengers by the mail being always heavily wrapped up from
        head to foot, the room had the odd interest for the establishment of the
        Royal George, that although but one kind of man was seen to go into it,
        all kinds and varieties of men came out of it. Consequently, another
        drawer, and two porters, and several maids and the landlady, were all
        loitering by accident at various points of the road between the Concord
        and the coffee-room, when a gentleman of sixty, formally dressed in a
        brown suit of clothes, pretty well worn, but very well kept, with large
        square cuffs and large flaps to the pockets, passed along on his way to
        his breakfast.
        </p>
        <p>
        The coffee-room had no other occupant, that forenoon, than the gentleman
        in brown. His breakfast-table was drawn before the fire, and as he sat,
        with its light shining on him, waiting for the meal, he sat so still,
        that he might have been sitting for his portrait.
        </p>
        <p>

        Very orderly and methodical he looked, with a hand on each knee, and a
        loud watch ticking a sonorous sermon under his flapped waist-coat,
        as though it pitted its gravity and longevity against the levity and
        evanescence of the brisk fire. He had a good leg, and was a little vain
        of it, for his brown stockings fitted sleek and close, and were of a
        fine texture; his shoes and buckles, too, though plain, were trim. He
        wore an odd little sleek crisp flaxen wig, setting very close to his
        head: which wig, it is to be presumed, was made of hair, but which
        looked far more as though it were spun from filaments of silk or glass.
        His linen, though not of a fineness in accordance with his stockings,
        was as white as the tops of the waves that broke upon the neighbouring
        beach, or the specks of sail that glinted in the sunlight far at sea. A
        face habitually suppressed and quieted, was still lighted up under the
        quaint wig by a pair of moist bright eyes that it must have cost
        their owner, in years gone by, some pains to drill to the composed and
        reserved expression of Tellson's Bank. He had a healthy colour in his
        cheeks, and his face, though lined, bore few traces of anxiety.
        But, perhaps the confidential bachelor clerks in Tellson's Bank were
        principally occupied with the cares of other people; and perhaps
        second-hand cares, like second-hand clothes, come easily off and on.
        </p>
        <p>
        Completing his resemblance to a man who was sitting for his portrait,
        Mr. Lorry dropped off to sleep. The arrival of his breakfast roused him,
        and he said to the drawer, as he moved his chair to it:
        </p>
        <p>
        "I wish accommodation prepared for a young lady who may come here at any
        time to-day. She may ask for Mr. Jarvis Lorry, or she may only ask for a
        gentleman from Tellson's Bank. Please to let me know."
        </p>
        <p>
        "Yes, sir. Tellson's Bank in London, sir?"
        </p>
        <p>
        "Yes."
        </p>
        <p>
        "Yes, sir. We have oftentimes the honour to entertain your gentlemen in
        their travelling backwards and forwards betwixt London and Paris, sir. A
        vast deal of travelling, sir, in Tellson and Company's House."
        </p>

        <p>
        "Yes. We are quite a French House, as well as an English one."
        </p>
        <p>
        "Yes, sir. Not much in the habit of such travelling yourself, I think,
        sir?"
        </p>
        <p>
        "Not of late years. It is fifteen years since we&mdash;since I&mdash;came last
        from France."
        </p>
        <p>
        "Indeed, sir? That was before my time here, sir. Before our people's
        time here, sir. The George was in other hands at that time, sir."
        </p>
        <p>
        "I believe so."
        </p>

        <p>
        "But I would hold a pretty wager, sir, that a House like Tellson and
        Company was flourishing, a matter of fifty, not to speak of fifteen
        years ago?"
        </p>
        <p>
        "You might treble that, and say a hundred and fifty, yet not be far from
        the truth."
        </p>
        <p>
        "Indeed, sir!"
        </p>
        <p>
        Rounding his mouth and both his eyes, as he stepped backward from the
        table, the waiter shifted his napkin from his right arm to his left,
        dropped into a comfortable attitude, and stood surveying the guest while
        he ate and drank, as from an observatory or watchtower. According to the
        immemorial usage of waiters in all ages.
        </p>
        <p>
        When Mr. Lorry had finished his breakfast, he went out for a stroll on
        the beach. The little narrow, crooked town of Dover hid itself away
        from the beach, and ran its head into the chalk cliffs, like a marine
        ostrich. The beach was a desert of heaps of sea and stones tumbling
        wildly about, and the sea did what it liked, and what it liked was
        destruction. It thundered at the town, and thundered at the cliffs, and
        brought the coast down, madly. The air among the houses was of so strong
        a piscatory flavour that one might have supposed sick fish went up to be
        dipped in it, as sick people went down to be dipped in the sea. A little
        fishing was done in the port, and a quantity of strolling about by
        night, and looking seaward: particularly at those times when the tide
        made, and was near flood. Small tradesmen, who did no business whatever,
        sometimes unaccountably realised large fortunes, and it was remarkable
        that nobody in the neighbourhood could endure a lamplighter.
        </p>
        <p>
        As the day declined into the afternoon, and the air, which had been
        at intervals clear enough to allow the French coast to be seen, became
        again charged with mist and vapour, Mr. Lorry's thoughts seemed to cloud
        too. When it was dark, and he sat before the coffee-room fire, awaiting
        his dinner as he had awaited his breakfast, his mind was busily digging,
        digging, digging, in the live red coals.

        </p>
        <p>
        A bottle of good claret after dinner does a digger in the red coals no
        harm, otherwise than as it has a tendency to throw him out of work.
        Mr. Lorry had been idle a long time, and had just poured out his last
        glassful of wine with as complete an appearance of satisfaction as is
        ever to be found in an elderly gentleman of a fresh complexion who has
        got to the end of a bottle, when a rattling of wheels came up the narrow
        street, and rumbled into the inn-yard.
        </p>
        <p>
        He set down his glass untouched. "This is Mam'selle!" said he.
        </p>
        <p>
        In a very few minutes the waiter came in to announce that Miss Manette
        had arrived from London, and would be happy to see the gentleman from
        Tellson's.
        </p>
        <p>
        "So soon?"
        </p>
        <p>
        Miss Manette had taken some refreshment on the road, and required none
        then, and was extremely anxious to see the gentleman from Tellson's
        immediately, if it suited his pleasure and convenience.
        </p>
        <p>

        The gentleman from Tellson's had nothing left for it but to empty his
        glass with an air of stolid desperation, settle his odd little flaxen
        wig at the ears, and follow the waiter to Miss Manette's apartment.
        It was a large, dark room, furnished in a funereal manner with black
        horsehair, and loaded with heavy dark tables. These had been oiled and
        oiled, until the two tall candles on the table in the middle of the room
        were gloomily reflected on every leaf; as if <i>they</i> were buried, in deep
        graves of black mahogany, and no light to speak of could be expected
        from them until they were dug out.
        </p>
        <p>
        The obscurity was so difficult to penetrate that Mr. Lorry, picking his
        way over the well-worn Turkey carpet, supposed Miss Manette to be, for
        the moment, in some adjacent room, until, having got past the two tall
        candles, he saw standing to receive him by the table between them and
        the fire, a young lady of not more than seventeen, in a riding-cloak,
        and still holding her straw travelling-hat by its ribbon in her hand. As
        his eyes rested on a short, slight, pretty figure, a quantity of golden
        hair, a pair of blue eyes that met his own with an inquiring look, and
        a forehead with a singular capacity (remembering how young and smooth
        it was), of rifting and knitting itself into an expression that was
        not quite one of perplexity, or wonder, or alarm, or merely of a bright
        fixed attention, though it included all the four expressions&mdash;as his
        eyes rested on these things, a sudden vivid likeness passed before him,
        of a child whom he had held in his arms on the passage across that very
        Channel, one cold time, when the hail drifted heavily and the sea ran
        high. The likeness passed away, like a breath along the surface of
        the gaunt pier-glass behind her, on the frame of which, a hospital
        procession of negro cupids, several headless and all cripples, were
        offering black baskets of Dead Sea fruit to black divinities of the
        feminine gender&mdash;and he made his formal bow to Miss Manette.
        </p>
        <p>
        "Pray take a seat, sir." In a very clear and pleasant young voice; a
        little foreign in its accent, but a very little indeed.
        </p>
        <p>
        "I kiss your hand, miss," said Mr. Lorry, with the manners of an earlier
        date, as he made his formal bow again, and took his seat.
        </p>
        <p>

        "I received a letter from the Bank, sir, yesterday, informing me that
        some intelligence&mdash;or discovery&mdash;"
        </p>
        <p>
        "The word is not material, miss; either word will do."
        </p>
        <p>
        "&mdash;respecting the small property of my poor father, whom I never saw&mdash;so
        long dead&mdash;"
        </p>
        <p>
        Mr. Lorry moved in his chair, and cast a troubled look towards the
        hospital procession of negro cupids. As if <i>they</i> had any help for
        anybody in their absurd baskets!

        </p>
        <p>
        "&mdash;rendered it necessary that I should go to Paris, there to communicate
        with a gentleman of the Bank, so good as to be despatched to Paris for
        the purpose."
        </p>
        <p>
        "Myself."
        </p>
        <p>
        "As I was prepared to hear, sir."
        </p>
        <p>
        She curtseyed to him (young ladies made curtseys in those days), with a
        pretty desire to convey to him that she felt how much older and wiser he
        was than she. He made her another bow.
        </p>
        <p>
        "I replied to the Bank, sir, that as it was considered necessary, by
        those who know, and who are so kind as to advise me, that I should go to
        France, and that as I am an orphan and have no friend who could go with
        me, I should esteem it highly if I might be permitted to place myself,
        during the journey, under that worthy gentleman's protection. The
        gentleman had left London, but I think a messenger was sent after him to
        beg the favour of his waiting for me here."
        </p>

        <p>
        "I was happy," said Mr. Lorry, "to be entrusted with the charge. I shall
        be more happy to execute it."
        </p>
        <p>
        "Sir, I thank you indeed. I thank you very gratefully. It was told me
        by the Bank that the gentleman would explain to me the details of the
        business, and that I must prepare myself to find them of a surprising
        nature. I have done my best to prepare myself, and I naturally have a
        strong and eager interest to know what they are."
        </p>
        <p>
        "Naturally," said Mr. Lorry. "Yes&mdash;I&mdash;"
        </p>
        <p>
        After a pause, he added, again settling the crisp flaxen wig at the
        ears, "It is very difficult to begin."
        </p>
        <p>
        He did not begin, but, in his indecision, met her glance. The young
        forehead lifted itself into that singular expression&mdash;but it was pretty
        and characteristic, besides being singular&mdash;and she raised her hand,
        as if with an involuntary action she caught at, or stayed some passing
        shadow.

        </p>
        <p>
        "Are you quite a stranger to me, sir?"
        </p>
        <p>
        "Am I not?" Mr. Lorry opened his hands, and extended them outwards with
        an argumentative smile.
        </p>
        <p>
        Between the eyebrows and just over the little feminine nose, the line of
        which was as delicate and fine as it was possible to be, the expression
        deepened itself as she took her seat thoughtfully in the chair by which
        she had hitherto remained standing. He watched her as she mused, and the
        moment she raised her eyes again, went on:
        </p>
        <p>
        "In your adopted country, I presume, I cannot do better than address you
        as a young English lady, Miss Manette?"
        </p>
        <p>
        "If you please, sir."
        </p>
        <p>

        "Miss Manette, I am a man of business. I have a business charge to
        acquit myself of. In your reception of it, don't heed me any more than
        if I was a speaking machine&mdash;truly, I am not much else. I will, with
        your leave, relate to you, miss, the story of one of our customers."
        </p>
        <p>
        "Story!"
        </p>
        <p>
        He seemed wilfully to mistake the word she had repeated, when he added,
        in a hurry, "Yes, customers; in the banking business we usually call
        our connection our customers. He was a French gentleman; a scientific
        gentleman; a man of great acquirements&mdash;a Doctor."
        </p>
        <p>
        "Not of Beauvais?"
        </p>
        <p>
        "Why, yes, of Beauvais. Like Monsieur Manette, your father, the
        gentleman was of Beauvais. Like Monsieur Manette, your father, the
        gentleman was of repute in Paris. I had the honour of knowing him there.
        Our relations were business relations, but confidential. I was at that
        time in our French House, and had been&mdash;oh! twenty years."
        </p>

        <p>
        "At that time&mdash;I may ask, at what time, sir?"
        </p>
        <p>
        "I speak, miss, of twenty years ago. He married&mdash;an English lady&mdash;and
        I was one of the trustees. His affairs, like the affairs of many other
        French gentlemen and French families, were entirely in Tellson's hands.
        In a similar way I am, or I have been, trustee of one kind or other for
        scores of our customers. These are mere business relations, miss;
        there is no friendship in them, no particular interest, nothing like
        sentiment. I have passed from one to another, in the course of my
        business life, just as I pass from one of our customers to another in
        the course of my business day; in short, I have no feelings; I am a mere
        machine. To go on&mdash;"
        </p>
        <p>
        "But this is my father's story, sir; and I begin to think"&mdash;the
        curiously roughened forehead was very intent upon him&mdash;"that when I was
        left an orphan through my mother's surviving my father only two years,
        it was you who brought me to England. I am almost sure it was you."
        </p>
        <p>
        Mr. Lorry took the hesitating little hand that confidingly advanced
        to take his, and he put it with some ceremony to his lips. He then
        conducted the young lady straightway to her chair again, and, holding
        the chair-back with his left hand, and using his right by turns to rub
        his chin, pull his wig at the ears, or point what he said, stood looking
        down into her face while she sat looking up into his.

        </p>
        <p>
        "Miss Manette, it <i>was</i> I. And you will see how truly I spoke of myself
        just now, in saying I had no feelings, and that all the relations I hold
        with my fellow-creatures are mere business relations, when you reflect
        that I have never seen you since. No; you have been the ward of
        Tellson's House since, and I have been busy with the other business of
        Tellson's House since. Feelings! I have no time for them, no chance
        of them. I pass my whole life, miss, in turning an immense pecuniary
        Mangle."
        </p>
        <p>
        After this odd description of his daily routine of employment, Mr. Lorry
        flattened his flaxen wig upon his head with both hands (which was most
        unnecessary, for nothing could be flatter than its shining surface was
        before), and resumed his former attitude.
        </p>
        <p>
        "So far, miss (as you have remarked), this is the story of your
        regretted father. Now comes the difference. If your father had not died
        when he did&mdash;Don't be frightened! How you start!"
        </p>
        <p>
        She did, indeed, start. And she caught his wrist with both her hands.
        </p>

        <p>
        "Pray," said Mr. Lorry, in a soothing tone, bringing his left hand from
        the back of the chair to lay it on the supplicatory fingers that clasped
        him in so violent a tremble: "pray control your agitation&mdash;a matter of
        business. As I was saying&mdash;"
        </p>
        <p>
        Her look so discomposed him that he stopped, wandered, and began anew:
        </p>
        <p>
        "As I was saying; if Monsieur Manette had not died; if he had suddenly
        and silently disappeared; if he had been spirited away; if it had not
        been difficult to guess to what dreadful place, though no art could
        trace him; if he had an enemy in some compatriot who could exercise a
        privilege that I in my own time have known the boldest people afraid
        to speak of in a whisper, across the water there; for instance, the
        privilege of filling up blank forms for the consignment of any one
        to the oblivion of a prison for any length of time; if his wife had
        implored the king, the queen, the court, the clergy, for any tidings of
        him, and all quite in vain;&mdash;then the history of your father would have
        been the history of this unfortunate gentleman, the Doctor of Beauvais."
        </p>
        <p>
        "I entreat you to tell me more, sir."
        </p>
        <p>
        "I will. I am going to. You can bear it?"

        </p>
        <p>
        "I can bear anything but the uncertainty you leave me in at this
        moment."
        </p>
        <p>
        "You speak collectedly, and you&mdash;<i>are</i> collected. That's good!" (Though
        his manner was less satisfied than his words.) "A matter of business.
        Regard it as a matter of business&mdash;business that must be done. Now
        if this doctor's wife, though a lady of great courage and spirit,
        had suffered so intensely from this cause before her little child was
        born&mdash;"
        </p>
        <p>
        "The little child was a daughter, sir."
        </p>
        <p>
        "A daughter. A-a-matter of business&mdash;don't be distressed. Miss, if the
        poor lady had suffered so intensely before her little child was born,
        that she came to the determination of sparing the poor child the
        inheritance of any part of the agony she had known the pains of, by
        rearing her in the belief that her father was dead&mdash;No, don't kneel! In
        Heaven's name why should you kneel to me!"

        </p>
        <p>
        "For the truth. O dear, good, compassionate sir, for the truth!"
        </p>
        <p>
        "A&mdash;a matter of business. You confuse me, and how can I transact
        business if I am confused? Let us be clear-headed. If you could kindly
        mention now, for instance, what nine times ninepence are, or how many
        shillings in twenty guineas, it would be so encouraging. I should be so
        much more at my ease about your state of mind."
        </p>
        <p>
        Without directly answering to this appeal, she sat so still when he had
        very gently raised her, and the hands that had not ceased to clasp
        his wrists were so much more steady than they had been, that she
        communicated some reassurance to Mr. Jarvis Lorry.
        </p>
        <p>
        "That's right, that's right. Courage! Business! You have business before
        you; useful business. Miss Manette, your mother took this course with
        you. And when she died&mdash;I believe broken-hearted&mdash;having never slackened
        her unavailing search for your father, she left you, at two years old,
        to grow to be blooming, beautiful, and happy, without the dark cloud
        upon you of living in uncertainty whether your father soon wore his
        heart out in prison, or wasted there through many lingering years."
        </p>
        <p>

        As he said the words he looked down, with an admiring pity, on the
        flowing golden hair; as if he pictured to himself that it might have
        been already tinged with grey.
        </p>
        <p>
        "You know that your parents had no great possession, and that what
        they had was secured to your mother and to you. There has been no new
        discovery, of money, or of any other property; but&mdash;"
        </p>
        <p>
        He felt his wrist held closer, and he stopped. The expression in the
        forehead, which had so particularly attracted his notice, and which was
        now immovable, had deepened into one of pain and horror.
        </p>
        <p>
        "But he has been&mdash;been found. He is alive. Greatly changed, it is too
        probable; almost a wreck, it is possible; though we will hope the best.
        Still, alive. Your father has been taken to the house of an old servant
        in Paris, and we are going there: I, to identify him if I can: you, to
        restore him to life, love, duty, rest, comfort."
        </p>
        <p>
        A shiver ran through her frame, and from it through his. She said, in a
        low, distinct, awe-stricken voice, as if she were saying it in a dream,
        </p>
        <p>

        "I am going to see his Ghost! It will be his Ghost&mdash;not him!"
        </p>
        <p>
        Mr. Lorry quietly chafed the hands that held his arm. "There, there,
        there! See now, see now! The best and the worst are known to you, now.
        You are well on your way to the poor wronged gentleman, and, with a fair
        sea voyage, and a fair land journey, you will be soon at his dear side."
        </p>
        <p>
        She repeated in the same tone, sunk to a whisper, "I have been free, I
        have been happy, yet his Ghost has never haunted me!"
        </p>
        <p>
        "Only one thing more," said Mr. Lorry, laying stress upon it as a
        wholesome means of enforcing her attention: "he has been found under
        another name; his own, long forgotten or long concealed. It would be
        worse than useless now to inquire which; worse than useless to seek to
        know whether he has been for years overlooked, or always designedly
        held prisoner. It would be worse than useless now to make any inquiries,
        because it would be dangerous. Better not to mention the subject,
        anywhere or in any way, and to remove him&mdash;for a while at all
        events&mdash;out of France. Even I, safe as an Englishman, and even
        Tellson's, important as they are to French credit, avoid all naming of
        the matter. I carry about me, not a scrap of writing openly referring
        to it. This is a secret service altogether. My credentials, entries,
        and memoranda, are all comprehended in the one line, 'Recalled to Life;'
        which may mean anything. But what is the matter! She doesn't notice a
        word! Miss Manette!"
        </p>
        <p>
        Perfectly still and silent, and not even fallen back in her chair, she
        sat under his hand, utterly insensible; with her eyes open and fixed
        upon him, and with that last expression looking as if it were carved or
        branded into her forehead. So close was her hold upon his arm, that he
        feared to detach himself lest he should hurt her; therefore he called
        out loudly for assistance without moving.
        </p>

        <p>
        A wild-looking woman, whom even in his agitation, Mr. Lorry observed to
        be all of a red colour, and to have red hair, and to be dressed in some
        extraordinary tight-fitting fashion, and to have on her head a most
        wonderful bonnet like a Grenadier wooden measure, and good measure too,
        or a great Stilton cheese, came running into the room in advance of the
        inn servants, and soon settled the question of his detachment from the
        poor young lady, by laying a brawny hand upon his chest, and sending him
        flying back against the nearest wall.
        </p>
        <p>
        ("I really think this must be a man!" was Mr. Lorry's breathless
        reflection, simultaneously with his coming against the wall.)
        </p>
        <p>
        "Why, look at you all!" bawled this figure, addressing the inn servants.
        "Why don't you go and fetch things, instead of standing there staring
        at me? I am not so much to look at, am I? Why don't you go and fetch
        things? I'll let you know, if you don't bring smelling-salts, cold
        water, and vinegar, quick, I will."
        </p>
        <p>
        There was an immediate dispersal for these restoratives, and she
        softly laid the patient on a sofa, and tended her with great skill and
        gentleness: calling her "my precious!" and "my bird!" and spreading her
        golden hair aside over her shoulders with great pride and care.
        </p>
        <p>
        "And you in brown!" she said, indignantly turning to Mr. Lorry;
        "couldn't you tell her what you had to tell her, without frightening her
        to death? Look at her, with her pretty pale face and her cold hands. Do
        you call <i>that</i> being a Banker?"

        </p>
        <p>
        Mr. Lorry was so exceedingly disconcerted by a question so hard to
        answer, that he could only look on, at a distance, with much feebler
        sympathy and humility, while the strong woman, having banished the inn
        servants under the mysterious penalty of "letting them know" something
        not mentioned if they stayed there, staring, recovered her charge by a
        regular series of gradations, and coaxed her to lay her drooping head
        upon her shoulder.
        </p>
        <p>
        "I hope she will do well now," said Mr. Lorry.
        </p>
        <p>
        "No thanks to you in brown, if she does. My darling pretty!"
        </p>
        <p>
        "I hope," said Mr. Lorry, after another pause of feeble sympathy and
        humility, "that you accompany Miss Manette to France?"
        </p>
        <p>
        "A likely thing, too!" replied the strong woman. "If it was ever
        intended that I should go across salt water, do you suppose Providence
        would have cast my lot in an island?"
        </p>
        <p>

        This being another question hard to answer, Mr. Jarvis Lorry withdrew to
        consider it.
        </p>
      </div>

      <div id="part1-V">
        <h2>
            V. The Wine-shop
        </h2>
        <p>
        A large cask of wine had been dropped and broken, in the street. The
        accident had happened in getting it out of a cart; the cask had tumbled
        out with a run, the hoops had burst, and it lay on the stones just
        outside the door of the wine-shop, shattered like a walnut-shell.
        </p>
        <p>
        All the people within reach had suspended their business, or their
        idleness, to run to the spot and drink the wine. The rough, irregular
        stones of the street, pointing every way, and designed, one might have
        thought, expressly to lame all living creatures that approached them,
        had dammed it into little pools; these were surrounded, each by its own
        jostling group or crowd, according to its size. Some men kneeled down,
        made scoops of their two hands joined, and sipped, or tried to help
        women, who bent over their shoulders, to sip, before the wine had all
        run out between their fingers. Others, men and women, dipped in
        the puddles with little mugs of mutilated earthenware, or even with
        handkerchiefs from women's heads, which were squeezed dry into infants'
        mouths; others made small mud-embankments, to stem the wine as it ran;
        others, directed by lookers-on up at high windows, darted here and
        there, to cut off little streams of wine that started away in new
        directions; others devoted themselves to the sodden and lee-dyed
        pieces of the cask, licking, and even champing the moister wine-rotted
        fragments with eager relish. There was no drainage to carry off the
        wine, and not only did it all get taken up, but so much mud got taken up
        along with it, that there might have been a scavenger in the street,
        if anybody acquainted with it could have believed in such a miraculous
        presence.
        </p>
        <p>

        A shrill sound of laughter and of amused voices&mdash;voices of men, women,
        and children&mdash;resounded in the street while this wine game lasted. There
        was little roughness in the sport, and much playfulness. There was a
        special companionship in it, an observable inclination on the part
        of every one to join some other one, which led, especially among the
        luckier or lighter-hearted, to frolicsome embraces, drinking of healths,
        shaking of hands, and even joining of hands and dancing, a dozen
        together. When the wine was gone, and the places where it had been
        most abundant were raked into a gridiron-pattern by fingers, these
        demonstrations ceased, as suddenly as they had broken out. The man who
        had left his saw sticking in the firewood he was cutting, set it in
        motion again; the women who had left on a door-step the little pot of
        hot ashes, at which she had been trying to soften the pain in her own
        starved fingers and toes, or in those of her child, returned to it; men
        with bare arms, matted locks, and cadaverous faces, who had emerged into
        the winter light from cellars, moved away, to descend again; and a gloom
        gathered on the scene that appeared more natural to it than sunshine.
        </p>
        <p>
        The wine was red wine, and had stained the ground of the narrow street
        in the suburb of Saint Antoine, in Paris, where it was spilled. It had
        stained many hands, too, and many faces, and many naked feet, and many
        wooden shoes. The hands of the man who sawed the wood, left red marks
        on the billets; and the forehead of the woman who nursed her baby, was
        stained with the stain of the old rag she wound about her head again.
        Those who had been greedy with the staves of the cask, had acquired a
        tigerish smear about the mouth; and one tall joker so besmirched, his
        head more out of a long squalid bag of a nightcap than in it, scrawled
        upon a wall with his finger dipped in muddy wine-lees&mdash;BLOOD.
        </p>
        <p>
        The time was to come, when that wine too would be spilled on the
        street-stones, and when the stain of it would be red upon many there.
        </p>
        <p>
        And now that the cloud settled on Saint Antoine, which a momentary
        gleam had driven from his sacred countenance, the darkness of it was
        heavy&mdash;cold, dirt, sickness, ignorance, and want, were the lords in
        waiting on the saintly presence&mdash;nobles of great power all of them;
        but, most especially the last. Samples of a people that had undergone a
        terrible grinding and regrinding in the mill, and certainly not in the
        fabulous mill which ground old people young, shivered at every corner,
        passed in and out at every doorway, looked from every window, fluttered
        in every vestige of a garment that the wind shook. The mill which
        had worked them down, was the mill that grinds young people old; the
        children had ancient faces and grave voices; and upon them, and upon the
        grown faces, and ploughed into every furrow of age and coming up afresh,
        was the sigh, Hunger. It was prevalent everywhere. Hunger was pushed out
        of the tall houses, in the wretched clothing that hung upon poles and
        lines; Hunger was patched into them with straw and rag and wood and
        paper; Hunger was repeated in every fragment of the small modicum of
        firewood that the man sawed off; Hunger stared down from the smokeless
        chimneys, and started up from the filthy street that had no offal,
        among its refuse, of anything to eat. Hunger was the inscription on the
        baker's shelves, written in every small loaf of his scanty stock of
        bad bread; at the sausage-shop, in every dead-dog preparation that
        was offered for sale. Hunger rattled its dry bones among the roasting
        chestnuts in the turned cylinder; Hunger was shred into atomics in every
        farthing porringer of husky chips of potato, fried with some reluctant
        drops of oil.
        </p>
        <p>

        Its abiding place was in all things fitted to it. A narrow winding
        street, full of offence and stench, with other narrow winding streets
        diverging, all peopled by rags and nightcaps, and all smelling of rags
        and nightcaps, and all visible things with a brooding look upon them
        that looked ill. In the hunted air of the people there was yet some
        wild-beast thought of the possibility of turning at bay. Depressed and
        slinking though they were, eyes of fire were not wanting among them; nor
        compressed lips, white with what they suppressed; nor foreheads knitted
        into the likeness of the gallows-rope they mused about enduring, or
        inflicting. The trade signs (and they were almost as many as the shops)
        were, all, grim illustrations of Want. The butcher and the porkman
        painted up, only the leanest scrags of meat; the baker, the coarsest of
        meagre loaves. The people rudely pictured as drinking in the wine-shops,
        croaked over their scanty measures of thin wine and beer, and were
        gloweringly confidential together. Nothing was represented in a
        flourishing condition, save tools and weapons; but, the cutler's knives
        and axes were sharp and bright, the smith's hammers were heavy, and the
        gunmaker's stock was murderous. The crippling stones of the pavement,
        with their many little reservoirs of mud and water, had no footways, but
        broke off abruptly at the doors. The kennel, to make amends, ran down
        the middle of the street&mdash;when it ran at all: which was only after heavy
        rains, and then it ran, by many eccentric fits, into the houses. Across
        the streets, at wide intervals, one clumsy lamp was slung by a rope and
        pulley; at night, when the lamplighter had let these down, and lighted,
        and hoisted them again, a feeble grove of dim wicks swung in a sickly
        manner overhead, as if they were at sea. Indeed they were at sea, and
        the ship and crew were in peril of tempest.
        </p>
        <p>
        For, the time was to come, when the gaunt scarecrows of that region
        should have watched the lamplighter, in their idleness and hunger, so
        long, as to conceive the idea of improving on his method, and hauling
        up men by those ropes and pulleys, to flare upon the darkness of their
        condition. But, the time was not come yet; and every wind that blew over
        France shook the rags of the scarecrows in vain, for the birds, fine of
        song and feather, took no warning.
        </p>
        <p>
        The wine-shop was a corner shop, better than most others in its
        appearance and degree, and the master of the wine-shop had stood outside
        it, in a yellow waistcoat and green breeches, looking on at the struggle
        for the lost wine. "It's not my affair," said he, with a final shrug
        of the shoulders. "The people from the market did it. Let them bring
        another."
        </p>
        <p>
        There, his eyes happening to catch the tall joker writing up his joke,
        he called to him across the way:
        </p>
        <p>
        "Say, then, my Gaspard, what do you do there?"
        </p>
        <p>
        The fellow pointed to his joke with immense significance, as is often
        the way with his tribe. It missed its mark, and completely failed, as is
        often the way with his tribe too.

        </p>
        <p>
        "What now? Are you a subject for the mad hospital?" said the wine-shop
        keeper, crossing the road, and obliterating the jest with a handful of
        mud, picked up for the purpose, and smeared over it. "Why do you write
        in the public streets? Is there&mdash;tell me thou&mdash;is there no other place
        to write such words in?"
        </p>
        <p>
        In his expostulation he dropped his cleaner hand (perhaps accidentally,
        perhaps not) upon the joker's heart. The joker rapped it with his
        own, took a nimble spring upward, and came down in a fantastic dancing
        attitude, with one of his stained shoes jerked off his foot into his
        hand, and held out. A joker of an extremely, not to say wolfishly
        practical character, he looked, under those circumstances.
        </p>
        <p>
        "Put it on, put it on," said the other. "Call wine, wine; and finish
        there." With that advice, he wiped his soiled hand upon the joker's
        dress, such as it was&mdash;quite deliberately, as having dirtied the hand on
        his account; and then recrossed the road and entered the wine-shop.
        </p>
        <p>
        This wine-shop keeper was a bull-necked, martial-looking man of thirty,
        and he should have been of a hot temperament, for, although it was a
        bitter day, he wore no coat, but carried one slung over his shoulder.
        His shirt-sleeves were rolled up, too, and his brown arms were bare to
        the elbows. Neither did he wear anything more on his head than his own
        crisply-curling short dark hair. He was a dark man altogether, with good
        eyes and a good bold breadth between them. Good-humoured looking on
        the whole, but implacable-looking, too; evidently a man of a strong
        resolution and a set purpose; a man not desirable to be met, rushing
        down a narrow pass with a gulf on either side, for nothing would turn
        the man.
        </p>
        <p>

        Madame Defarge, his wife, sat in the shop behind the counter as he
        came in. Madame Defarge was a stout woman of about his own age, with
        a watchful eye that seldom seemed to look at anything, a large hand
        heavily ringed, a steady face, strong features, and great composure of
        manner. There was a character about Madame Defarge, from which one might
        have predicated that she did not often make mistakes against herself
        in any of the reckonings over which she presided. Madame Defarge being
        sensitive to cold, was wrapped in fur, and had a quantity of bright
        shawl twined about her head, though not to the concealment of her large
        earrings. Her knitting was before her, but she had laid it down to pick
        her teeth with a toothpick. Thus engaged, with her right elbow supported
        by her left hand, Madame Defarge said nothing when her lord came in, but
        coughed just one grain of cough. This, in combination with the lifting
        of her darkly defined eyebrows over her toothpick by the breadth of a
        line, suggested to her husband that he would do well to look round the
        shop among the customers, for any new customer who had dropped in while
        he stepped over the way.
        </p>
        <p>
        The wine-shop keeper accordingly rolled his eyes about, until they
        rested upon an elderly gentleman and a young lady, who were seated in
        a corner. Other company were there: two playing cards, two playing
        dominoes, three standing by the counter lengthening out a short supply
        of wine. As he passed behind the counter, he took notice that the
        elderly gentleman said in a look to the young lady, "This is our man."
        </p>
        <p>
        "What the devil do <i>you</i> do in that galley there?" said Monsieur Defarge
        to himself; "I don't know you."
        </p>
        <p>
        But, he feigned not to notice the two strangers, and fell into discourse
        with the triumvirate of customers who were drinking at the counter.
        </p>
        <p>
        "How goes it, Jacques?" said one of these three to Monsieur Defarge. "Is
        all the spilt wine swallowed?"
        </p>

        <p>
        "Every drop, Jacques," answered Monsieur Defarge.
        </p>
        <p>
        When this interchange of Christian name was effected, Madame Defarge,
        picking her teeth with her toothpick, coughed another grain of cough,
        and raised her eyebrows by the breadth of another line.
        </p>
        <p>
        "It is not often," said the second of the three, addressing Monsieur
        Defarge, "that many of these miserable beasts know the taste of wine, or
        of anything but black bread and death. Is it not so, Jacques?"
        </p>
        <p>
        "It is so, Jacques," Monsieur Defarge returned.
        </p>
        <p>
        At this second interchange of the Christian name, Madame Defarge, still
        using her toothpick with profound composure, coughed another grain of
        cough, and raised her eyebrows by the breadth of another line.
        </p>
        <p>
        The last of the three now said his say, as he put down his empty
        drinking vessel and smacked his lips.

        </p>
        <p>
        "Ah! So much the worse! A bitter taste it is that such poor cattle
        always have in their mouths, and hard lives they live, Jacques. Am I
        right, Jacques?"
        </p>
        <p>
        "You are right, Jacques," was the response of Monsieur Defarge.
        </p>
        <p>
        This third interchange of the Christian name was completed at the moment
        when Madame Defarge put her toothpick by, kept her eyebrows up, and
        slightly rustled in her seat.
        </p>
        <p>
        "Hold then! True!" muttered her husband. "Gentlemen&mdash;my wife!"
        </p>
        <p>
        The three customers pulled off their hats to Madame Defarge, with three
        flourishes. She acknowledged their homage by bending her head, and
        giving them a quick look. Then she glanced in a casual manner round the
        wine-shop, took up her knitting with great apparent calmness and repose
        of spirit, and became absorbed in it.
        </p>

        <p>
        "Gentlemen," said her husband, who had kept his bright eye observantly
        upon her, "good day. The chamber, furnished bachelor-fashion, that you
        wished to see, and were inquiring for when I stepped out, is on the
        fifth floor. The doorway of the staircase gives on the little courtyard
        close to the left here," pointing with his hand, "near to the window of
        my establishment. But, now that I remember, one of you has already been
        there, and can show the way. Gentlemen, adieu!"
        </p>
        <p>
        They paid for their wine, and left the place. The eyes of Monsieur
        Defarge were studying his wife at her knitting when the elderly
        gentleman advanced from his corner, and begged the favour of a word.
        </p>
        <p>
        "Willingly, sir," said Monsieur Defarge, and quietly stepped with him to
        the door.
        </p>
        <p>
        Their conference was very short, but very decided. Almost at the first
        word, Monsieur Defarge started and became deeply attentive. It had
        not lasted a minute, when he nodded and went out. The gentleman then
        beckoned to the young lady, and they, too, went out. Madame Defarge
        knitted with nimble fingers and steady eyebrows, and saw nothing.
        </p>
        <p>
        Mr. Jarvis Lorry and Miss Manette, emerging from the wine-shop thus,
        joined Monsieur Defarge in the doorway to which he had directed his own
        company just before. It opened from a stinking little black courtyard,
        and was the general public entrance to a great pile of houses, inhabited
        by a great number of people. In the gloomy tile-paved entry to the
        gloomy tile-paved staircase, Monsieur Defarge bent down on one knee
        to the child of his old master, and put her hand to his lips. It was
        a gentle action, but not at all gently done; a very remarkable
        transformation had come over him in a few seconds. He had no good-humour
        in his face, nor any openness of aspect left, but had become a secret,
        angry, dangerous man.
        </p>
        <p>
        "It is very high; it is a little difficult. Better to begin slowly."
        Thus, Monsieur Defarge, in a stern voice, to Mr. Lorry, as they began
        ascending the stairs.

        </p>
        <p>
        "Is he alone?" the latter whispered.
        </p>
        <p>
        "Alone! God help him, who should be with him!" said the other, in the
        same low voice.
        </p>
        <p>
        "Is he always alone, then?"
        </p>
        <p>
        "Yes."
        </p>
        <p>
        "Of his own desire?"
        </p>
        <p>

        "Of his own necessity. As he was, when I first saw him after they
        found me and demanded to know if I would take him, and, at my peril be
        discreet&mdash;as he was then, so he is now."
        </p>
        <p>
        "He is greatly changed?"
        </p>
        <p>
        "Changed!"
        </p>
        <p>
        The keeper of the wine-shop stopped to strike the wall with his hand,
        and mutter a tremendous curse. No direct answer could have been half so
        forcible. Mr. Lorry's spirits grew heavier and heavier, as he and his
        two companions ascended higher and higher.
        </p>
        <p>
        Such a staircase, with its accessories, in the older and more crowded
        parts of Paris, would be bad enough now; but, at that time, it was vile
        indeed to unaccustomed and unhardened senses. Every little habitation
        within the great foul nest of one high building&mdash;that is to say,
        the room or rooms within every door that opened on the general
        staircase&mdash;left its own heap of refuse on its own landing, besides
        flinging other refuse from its own windows. The uncontrollable and
        hopeless mass of decomposition so engendered, would have polluted
        the air, even if poverty and deprivation had not loaded it with their
        intangible impurities; the two bad sources combined made it almost
        insupportable. Through such an atmosphere, by a steep dark shaft of dirt
        and poison, the way lay. Yielding to his own disturbance of mind, and to
        his young companion's agitation, which became greater every instant, Mr.
        Jarvis Lorry twice stopped to rest. Each of these stoppages was made
        at a doleful grating, by which any languishing good airs that were left
        uncorrupted, seemed to escape, and all spoilt and sickly vapours seemed
        to crawl in. Through the rusted bars, tastes, rather than glimpses, were
        caught of the jumbled neighbourhood; and nothing within range, nearer
        or lower than the summits of the two great towers of Notre-Dame, had any
        promise on it of healthy life or wholesome aspirations.
        </p>

        <p>
        At last, the top of the staircase was gained, and they stopped for the
        third time. There was yet an upper staircase, of a steeper inclination
        and of contracted dimensions, to be ascended, before the garret story
        was reached. The keeper of the wine-shop, always going a little in
        advance, and always going on the side which Mr. Lorry took, as though he
        dreaded to be asked any question by the young lady, turned himself about
        here, and, carefully feeling in the pockets of the coat he carried over
        his shoulder, took out a key.
        </p>
        <p>
        "The door is locked then, my friend?" said Mr. Lorry, surprised.
        </p>
        <p>
        "Ay. Yes," was the grim reply of Monsieur Defarge.
        </p>
        <p>
        "You think it necessary to keep the unfortunate gentleman so retired?"
        </p>
        <p>
        "I think it necessary to turn the key." Monsieur Defarge whispered it
        closer in his ear, and frowned heavily.
        </p>
        <p>
        "Why?"

        </p>
        <p>
        "Why! Because he has lived so long, locked up, that he would be
        frightened&mdash;rave&mdash;tear himself to pieces&mdash;die&mdash;come to I know not what
        harm&mdash;if his door was left open."
        </p>
        <p>
        "Is it possible!" exclaimed Mr. Lorry.
        </p>
        <p>
        "Is it possible!" repeated Defarge, bitterly. "Yes. And a beautiful
        world we live in, when it <i>is</i> possible, and when many other such things
        are possible, and not only possible, but done&mdash;done, see you!&mdash;under
        that sky there, every day. Long live the Devil. Let us go on."

        </p>
        <p>
        This dialogue had been held in so very low a whisper, that not a word
        of it had reached the young lady's ears. But, by this time she trembled
        under such strong emotion, and her face expressed such deep anxiety,
        and, above all, such dread and terror, that Mr. Lorry felt it incumbent
        on him to speak a word or two of reassurance.
        </p>
        <p>
        "Courage, dear miss! Courage! Business! The worst will be over in a
        moment; it is but passing the room-door, and the worst is over. Then,
        all the good you bring to him, all the relief, all the happiness you
        bring to him, begin. Let our good friend here, assist you on that side.
        That's well, friend Defarge. Come, now. Business, business!"
        </p>
        <p>
        They went up slowly and softly. The staircase was short, and they were
        soon at the top. There, as it had an abrupt turn in it, they came all at
        once in sight of three men, whose heads were bent down close together at
        the side of a door, and who were intently looking into the room to which
        the door belonged, through some chinks or holes in the wall. On hearing
        footsteps close at hand, these three turned, and rose, and showed
        themselves to be the three of one name who had been drinking in the
        wine-shop.
        </p>
        <p>
        "I forgot them in the surprise of your visit," explained Monsieur
        Defarge. "Leave us, good boys; we have business here."
        </p>
        <p>
        The three glided by, and went silently down.
        </p>
        <p>

        There appearing to be no other door on that floor, and the keeper of
        the wine-shop going straight to this one when they were left alone, Mr.
        Lorry asked him in a whisper, with a little anger:
        </p>
        <p>
        "Do you make a show of Monsieur Manette?"
        </p>
        <p>
        "I show him, in the way you have seen, to a chosen few."
        </p>
        <p>
        "Is that well?"
        </p>
        <p>
        "<i>I</i> think it is well."
        </p>

        <p>
        "Who are the few? How do you choose them?"
        </p>
        <p>
        "I choose them as real men, of my name&mdash;Jacques is my name&mdash;to whom the
        sight is likely to do good. Enough; you are English; that is another
        thing. Stay there, if you please, a little moment."
        </p>
        <p>
        With an admonitory gesture to keep them back, he stooped, and looked in
        through the crevice in the wall. Soon raising his head again, he struck
        twice or thrice upon the door&mdash;evidently with no other object than to
        make a noise there. With the same intention, he drew the key across it,
        three or four times, before he put it clumsily into the lock, and turned
        it as heavily as he could.
        </p>
        <p>
        The door slowly opened inward under his hand, and he looked into the
        room and said something. A faint voice answered something. Little more
        than a single syllable could have been spoken on either side.
        </p>
        <p>
        He looked back over his shoulder, and beckoned them to enter. Mr. Lorry
        got his arm securely round the daughter's waist, and held her; for he
        felt that she was sinking.

        </p>
        <p>
        "A-a-a-business, business!" he urged, with a moisture that was not of
        business shining on his cheek. "Come in, come in!"
        </p>
        <p>
        "I am afraid of it," she answered, shuddering.
        </p>
        <p>
        "Of it? What?"
        </p>
        <p>
        "I mean of him. Of my father."
        </p>
        <p>
        Rendered in a manner desperate, by her state and by the beckoning of
        their conductor, he drew over his neck the arm that shook upon his
        shoulder, lifted her a little, and hurried her into the room. He sat her
        down just within the door, and held her, clinging to him.
        </p>
        <p>

        Defarge drew out the key, closed the door, locked it on the inside,
        took out the key again, and held it in his hand. All this he did,
        methodically, and with as loud and harsh an accompaniment of noise as he
        could make. Finally, he walked across the room with a measured tread to
        where the window was. He stopped there, and faced round.
        </p>
        <p>
        The garret, built to be a depository for firewood and the like, was dim
        and dark: for, the window of dormer shape, was in truth a door in the
        roof, with a little crane over it for the hoisting up of stores from
        the street: unglazed, and closing up the middle in two pieces, like any
        other door of French construction. To exclude the cold, one half of this
        door was fast closed, and the other was opened but a very little way.
        Such a scanty portion of light was admitted through these means, that it
        was difficult, on first coming in, to see anything; and long habit
        alone could have slowly formed in any one, the ability to do any work
        requiring nicety in such obscurity. Yet, work of that kind was being
        done in the garret; for, with his back towards the door, and his face
        towards the window where the keeper of the wine-shop stood looking at
        him, a white-haired man sat on a low bench, stooping forward and very
        busy, making shoes.
        </p>

      </div>

      <div id="part1-VI">
        <h2>
            VI. The Shoemaker
        </h2>
        <p>
        "Good day!" said Monsieur Defarge, looking down at the white head that
        bent low over the shoemaking.
        </p>
        <p>

        It was raised for a moment, and a very faint voice responded to the
        salutation, as if it were at a distance:
        </p>
        <p>
        "Good day!"
        </p>
        <p>
        "You are still hard at work, I see?"
        </p>
        <p>
        After a long silence, the head was lifted for another moment, and the
        voice replied, "Yes&mdash;I am working." This time, a pair of haggard eyes
        had looked at the questioner, before the face had dropped again.
        </p>
        <p>
        The faintness of the voice was pitiable and dreadful. It was not the
        faintness of physical weakness, though confinement and hard fare no
        doubt had their part in it. Its deplorable peculiarity was, that it was
        the faintness of solitude and disuse. It was like the last feeble echo
        of a sound made long and long ago. So entirely had it lost the life and
        resonance of the human voice, that it affected the senses like a once
        beautiful colour faded away into a poor weak stain. So sunken and
        suppressed it was, that it was like a voice underground. So expressive
        it was, of a hopeless and lost creature, that a famished traveller,
        wearied out by lonely wandering in a wilderness, would have remembered
        home and friends in such a tone before lying down to die.
        </p>
        <p>
        Some minutes of silent work had passed: and the haggard eyes had looked
        up again: not with any interest or curiosity, but with a dull mechanical
        perception, beforehand, that the spot where the only visitor they were
        aware of had stood, was not yet empty.

        </p>
        <p>
        "I want," said Defarge, who had not removed his gaze from the shoemaker,
        "to let in a little more light here. You can bear a little more?"
        </p>
        <p>
        The shoemaker stopped his work; looked with a vacant air of listening,
        at the floor on one side of him; then similarly, at the floor on the
        other side of him; then, upward at the speaker.
        </p>
        <p>
        "What did you say?"
        </p>
        <p>
        "You can bear a little more light?"
        </p>
        <p>
        "I must bear it, if you let it in." (Laying the palest shadow of a
        stress upon the second word.)
        </p>
        <p>

        The opened half-door was opened a little further, and secured at that
        angle for the time. A broad ray of light fell into the garret, and
        showed the workman with an unfinished shoe upon his lap, pausing in his
        labour. His few common tools and various scraps of leather were at his
        feet and on his bench. He had a white beard, raggedly cut, but not very
        long, a hollow face, and exceedingly bright eyes. The hollowness and
        thinness of his face would have caused them to look large, under his yet
        dark eyebrows and his confused white hair, though they had been really
        otherwise; but, they were naturally large, and looked unnaturally so.
        His yellow rags of shirt lay open at the throat, and showed his body
        to be withered and worn. He, and his old canvas frock, and his loose
        stockings, and all his poor tatters of clothes, had, in a long seclusion
        from direct light and air, faded down to such a dull uniformity of
        parchment-yellow, that it would have been hard to say which was which.
        </p>
        <p>
        He had put up a hand between his eyes and the light, and the very bones
        of it seemed transparent. So he sat, with a steadfastly vacant gaze,
        pausing in his work. He never looked at the figure before him, without
        first looking down on this side of himself, then on that, as if he had
        lost the habit of associating place with sound; he never spoke, without
        first wandering in this manner, and forgetting to speak.
        </p>
        <p>
        "Are you going to finish that pair of shoes to-day?" asked Defarge,
        motioning to Mr. Lorry to come forward.
        </p>
        <p>
        "What did you say?"
        </p>
        <p>
        "Do you mean to finish that pair of shoes to-day?"
        </p>
        <p>
        "I can't say that I mean to. I suppose so. I don't know."
        </p>

        <p>
        But, the question reminded him of his work, and he bent over it again.
        </p>
        <p>
        Mr. Lorry came silently forward, leaving the daughter by the door. When
        he had stood, for a minute or two, by the side of Defarge, the shoemaker
        looked up. He showed no surprise at seeing another figure, but the
        unsteady fingers of one of his hands strayed to his lips as he looked at
        it (his lips and his nails were of the same pale lead-colour), and then
        the hand dropped to his work, and he once more bent over the shoe. The
        look and the action had occupied but an instant.
        </p>
        <p>
        "You have a visitor, you see," said Monsieur Defarge.
        </p>
        <p>
        "What did you say?"
        </p>
        <p>
        "Here is a visitor."
        </p>
        <p>
        The shoemaker looked up as before, but without removing a hand from his
        work.

        </p>
        <p>
        "Come!" said Defarge. "Here is monsieur, who knows a well-made shoe when
        he sees one. Show him that shoe you are working at. Take it, monsieur."
        </p>
        <p>
        Mr. Lorry took it in his hand.
        </p>
        <p>
        "Tell monsieur what kind of shoe it is, and the maker's name."
        </p>
        <p>
        There was a longer pause than usual, before the shoemaker replied:
        </p>
        <p>
        "I forget what it was you asked me. What did you say?"
        </p>
        <p>

        "I said, couldn't you describe the kind of shoe, for monsieur's
        information?"
        </p>
        <p>
        "It is a lady's shoe. It is a young lady's walking-shoe. It is in the
        present mode. I never saw the mode. I have had a pattern in my hand." He
        glanced at the shoe with some little passing touch of pride.
        </p>
        <p>
        "And the maker's name?" said Defarge.
        </p>
        <p>
        Now that he had no work to hold, he laid the knuckles of the right hand
        in the hollow of the left, and then the knuckles of the left hand in the
        hollow of the right, and then passed a hand across his bearded chin, and
        so on in regular changes, without a moment's intermission. The task of
        recalling him from the vagrancy into which he always sank when he
        had spoken, was like recalling some very weak person from a swoon, or
        endeavouring, in the hope of some disclosure, to stay the spirit of a
        fast-dying man.
        </p>
        <p>
        "Did you ask me for my name?"
        </p>
        <p>
        "Assuredly I did."
        </p>

        <p>
        "One Hundred and Five, North Tower."
        </p>
        <p>
        "Is that all?"
        </p>
        <p>
        "One Hundred and Five, North Tower."
        </p>
        <p>
        With a weary sound that was not a sigh, nor a groan, he bent to work
        again, until the silence was again broken.
        </p>
        <p>
        "You are not a shoemaker by trade?" said Mr. Lorry, looking steadfastly
        at him.
        </p>
        <p>
        His haggard eyes turned to Defarge as if he would have transferred the
        question to him: but as no help came from that quarter, they turned back
        on the questioner when they had sought the ground.

        </p>
        <p>
        "I am not a shoemaker by trade? No, I was not a shoemaker by trade. I-I
        learnt it here. I taught myself. I asked leave to&mdash;"
        </p>
        <p>
        He lapsed away, even for minutes, ringing those measured changes on his
        hands the whole time. His eyes came slowly back, at last, to the face
        from which they had wandered; when they rested on it, he started, and
        resumed, in the manner of a sleeper that moment awake, reverting to a
        subject of last night.
        </p>
        <p>
        "I asked leave to teach myself, and I got it with much difficulty after
        a long while, and I have made shoes ever since."
        </p>
        <p>
        As he held out his hand for the shoe that had been taken from him, Mr.
        Lorry said, still looking steadfastly in his face:
        </p>
        <p>
        "Monsieur Manette, do you remember nothing of me?"
        </p>

        <p>
        The shoe dropped to the ground, and he sat looking fixedly at the
        questioner.
        </p>
        <p>
        "Monsieur Manette"; Mr. Lorry laid his hand upon Defarge's arm; "do you
        remember nothing of this man? Look at him. Look at me. Is there no old
        banker, no old business, no old servant, no old time, rising in your
        mind, Monsieur Manette?"
        </p>
        <p>
        As the captive of many years sat looking fixedly, by turns, at Mr.
        Lorry and at Defarge, some long obliterated marks of an actively intent
        intelligence in the middle of the forehead, gradually forced themselves
        through the black mist that had fallen on him. They were overclouded
        again, they were fainter, they were gone; but they had been there. And
        so exactly was the expression repeated on the fair young face of her who
        had crept along the wall to a point where she could see him, and where
        she now stood looking at him, with hands which at first had been only
        raised in frightened compassion, if not even to keep him off and
        shut out the sight of him, but which were now extending towards him,
        trembling with eagerness to lay the spectral face upon her warm young
        breast, and love it back to life and hope&mdash;so exactly was the expression
        repeated (though in stronger characters) on her fair young face, that it
        looked as though it had passed like a moving light, from him to her.
        </p>
        <p>
        Darkness had fallen on him in its place. He looked at the two, less and
        less attentively, and his eyes in gloomy abstraction sought the ground
        and looked about him in the old way. Finally, with a deep long sigh, he
        took the shoe up, and resumed his work.
        </p>
        <p>
        "Have you recognised him, monsieur?" asked Defarge in a whisper.
        </p>
        <p>

        "Yes; for a moment. At first I thought it quite hopeless, but I have
        unquestionably seen, for a single moment, the face that I once knew so
        well. Hush! Let us draw further back. Hush!"
        </p>
        <p>
        She had moved from the wall of the garret, very near to the bench on
        which he sat. There was something awful in his unconsciousness of the
        figure that could have put out its hand and touched him as he stooped
        over his labour.
        </p>
        <p>
        Not a word was spoken, not a sound was made. She stood, like a spirit,
        beside him, and he bent over his work.
        </p>
        <p>
        It happened, at length, that he had occasion to change the instrument
        in his hand, for his shoemaker's knife. It lay on that side of him
        which was not the side on which she stood. He had taken it up, and was
        stooping to work again, when his eyes caught the skirt of her dress. He
        raised them, and saw her face. The two spectators started forward,
        but she stayed them with a motion of her hand. She had no fear of his
        striking at her with the knife, though they had.
        </p>
        <p>
        He stared at her with a fearful look, and after a while his lips began
        to form some words, though no sound proceeded from them. By degrees, in
        the pauses of his quick and laboured breathing, he was heard to say:
        </p>
        <p>
        "What is this?"
        </p>

        <p>
        With the tears streaming down her face, she put her two hands to her
        lips, and kissed them to him; then clasped them on her breast, as if she
        laid his ruined head there.
        </p>
        <p>
        "You are not the gaoler's daughter?"
        </p>
        <p>
        She sighed "No."
        </p>
        <p>
        "Who are you?"
        </p>
        <p>
        Not yet trusting the tones of her voice, she sat down on the bench
        beside him. He recoiled, but she laid her hand upon his arm. A strange
        thrill struck him when she did so, and visibly passed over his frame; he
        laid the knife down softly, as he sat staring at her.
        </p>
        <p>
        Her golden hair, which she wore in long curls, had been hurriedly pushed
        aside, and fell down over her neck. Advancing his hand by little and
        little, he took it up and looked at it. In the midst of the action
        he went astray, and, with another deep sigh, fell to work at his
        shoemaking.

        </p>
        <p>
        But not for long. Releasing his arm, she laid her hand upon his
        shoulder. After looking doubtfully at it, two or three times, as if to
        be sure that it was really there, he laid down his work, put his hand
        to his neck, and took off a blackened string with a scrap of folded rag
        attached to it. He opened this, carefully, on his knee, and it contained
        a very little quantity of hair: not more than one or two long golden
        hairs, which he had, in some old day, wound off upon his finger.
        </p>
        <p>
        He took her hair into his hand again, and looked closely at it. "It is
        the same. How can it be! When was it! How was it!"
        </p>
        <p>
        As the concentrated expression returned to his forehead, he seemed to
        become conscious that it was in hers too. He turned her full to the
        light, and looked at her.
        </p>
        <p>
        "She had laid her head upon my shoulder, that night when I was summoned
        out&mdash;she had a fear of my going, though I had none&mdash;and when I was
        brought to the North Tower they found these upon my sleeve. 'You will
        leave me them? They can never help me to escape in the body, though they
        may in the spirit.' Those were the words I said. I remember them very
        well."
        </p>
        <p>
        He formed this speech with his lips many times before he could utter it.
        But when he did find spoken words for it, they came to him coherently,
        though slowly.

        </p>
        <p>
        "How was this?&mdash;<i>Was it you</i>?"
        </p>
        <p>
        Once more, the two spectators started, as he turned upon her with a
        frightful suddenness. But she sat perfectly still in his grasp, and only
        said, in a low voice, "I entreat you, good gentlemen, do not come near
        us, do not speak, do not move!"
        </p>
        <p>
        "Hark!" he exclaimed. "Whose voice was that?"
        </p>
        <p>
        His hands released her as he uttered this cry, and went up to his white
        hair, which they tore in a frenzy. It died out, as everything but his
        shoemaking did die out of him, and he refolded his little packet and
        tried to secure it in his breast; but he still looked at her, and
        gloomily shook his head.
        </p>
        <p>
        "No, no, no; you are too young, too blooming. It can't be. See what the
        prisoner is. These are not the hands she knew, this is not the face
        she knew, this is not a voice she ever heard. No, no. She was&mdash;and He
        was&mdash;before the slow years of the North Tower&mdash;ages ago. What is your
        name, my gentle angel?"

        </p>
        <p>
        Hailing his softened tone and manner, his daughter fell upon her knees
        before him, with her appealing hands upon his breast.
        </p>
        <p>
        "O, sir, at another time you shall know my name, and who my mother was,
        and who my father, and how I never knew their hard, hard history. But I
        cannot tell you at this time, and I cannot tell you here. All that I may
        tell you, here and now, is, that I pray to you to touch me and to bless
        me. Kiss me, kiss me! O my dear, my dear!"
        </p>
        <p>
        His cold white head mingled with her radiant hair, which warmed and
        lighted it as though it were the light of Freedom shining on him.
        </p>
        <p>
        "If you hear in my voice&mdash;I don't know that it is so, but I hope it
        is&mdash;if you hear in my voice any resemblance to a voice that once was
        sweet music in your ears, weep for it, weep for it! If you touch, in
        touching my hair, anything that recalls a beloved head that lay on your
        breast when you were young and free, weep for it, weep for it! If, when
        I hint to you of a Home that is before us, where I will be true to you
        with all my duty and with all my faithful service, I bring back the
        remembrance of a Home long desolate, while your poor heart pined away,
        weep for it, weep for it!"
        </p>
        <p>
        She held him closer round the neck, and rocked him on her breast like a
        child.

        </p>
        <p>
        "If, when I tell you, dearest dear, that your agony is over, and that I
        have come here to take you from it, and that we go to England to be at
        peace and at rest, I cause you to think of your useful life laid waste,
        and of our native France so wicked to you, weep for it, weep for it! And
        if, when I shall tell you of my name, and of my father who is living,
        and of my mother who is dead, you learn that I have to kneel to my
        honoured father, and implore his pardon for having never for his sake
        striven all day and lain awake and wept all night, because the love of
        my poor mother hid his torture from me, weep for it, weep for it! Weep
        for her, then, and for me! Good gentlemen, thank God! I feel his sacred
        tears upon my face, and his sobs strike against my heart. O, see! Thank
        God for us, thank God!"
        </p>
        <p>
        He had sunk in her arms, and his face dropped on her breast: a sight so
        touching, yet so terrible in the tremendous wrong and suffering which
        had gone before it, that the two beholders covered their faces.
        </p>
        <p>
        When the quiet of the garret had been long undisturbed, and his heaving
        breast and shaken form had long yielded to the calm that must follow all
        storms&mdash;emblem to humanity, of the rest and silence into which the storm
        called Life must hush at last&mdash;they came forward to raise the father and
        daughter from the ground. He had gradually dropped to the floor, and lay
        there in a lethargy, worn out. She had nestled down with him, that his
        head might lie upon her arm; and her hair drooping over him curtained
        him from the light.
        </p>
        <p>
        "If, without disturbing him," she said, raising her hand to Mr. Lorry as
        he stooped over them, after repeated blowings of his nose, "all could be
        arranged for our leaving Paris at once, so that, from the very door, he
        could be taken away&mdash;"
        </p>
        <p>

        "But, consider. Is he fit for the journey?" asked Mr. Lorry.
        </p>
        <p>
        "More fit for that, I think, than to remain in this city, so dreadful to
        him."
        </p>
        <p>
        "It is true," said Defarge, who was kneeling to look on and hear. "More
        than that; Monsieur Manette is, for all reasons, best out of France.
        Say, shall I hire a carriage and post-horses?"
        </p>
        <p>
        "That's business," said Mr. Lorry, resuming on the shortest notice his
        methodical manners; "and if business is to be done, I had better do it."
        </p>
        <p>
        "Then be so kind," urged Miss Manette, "as to leave us here. You see how
        composed he has become, and you cannot be afraid to leave him with me
        now. Why should you be? If you will lock the door to secure us from
        interruption, I do not doubt that you will find him, when you come back,
        as quiet as you leave him. In any case, I will take care of him until
        you return, and then we will remove him straight."
        </p>
        <p>
        Both Mr. Lorry and Defarge were rather disinclined to this course, and
        in favour of one of them remaining. But, as there were not only carriage
        and horses to be seen to, but travelling papers; and as time pressed,
        for the day was drawing to an end, it came at last to their hastily
        dividing the business that was necessary to be done, and hurrying away
        to do it.
        </p>

        <p>
        Then, as the darkness closed in, the daughter laid her head down on the
        hard ground close at the father's side, and watched him. The darkness
        deepened and deepened, and they both lay quiet, until a light gleamed
        through the chinks in the wall.
        </p>
        <p>
        Mr. Lorry and Monsieur Defarge had made all ready for the journey, and
        had brought with them, besides travelling cloaks and wrappers, bread and
        meat, wine, and hot coffee. Monsieur Defarge put this provender, and the
        lamp he carried, on the shoemaker's bench (there was nothing else in the
        garret but a pallet bed), and he and Mr. Lorry roused the captive, and
        assisted him to his feet.
        </p>
        <p>
        No human intelligence could have read the mysteries of his mind, in
        the scared blank wonder of his face. Whether he knew what had happened,
        whether he recollected what they had said to him, whether he knew that
        he was free, were questions which no sagacity could have solved. They
        tried speaking to him; but, he was so confused, and so very slow to
        answer, that they took fright at his bewilderment, and agreed for
        the time to tamper with him no more. He had a wild, lost manner of
        occasionally clasping his head in his hands, that had not been seen
        in him before; yet, he had some pleasure in the mere sound of his
        daughter's voice, and invariably turned to it when she spoke.
        </p>
        <p>
        In the submissive way of one long accustomed to obey under coercion, he
        ate and drank what they gave him to eat and drink, and put on the cloak
        and other wrappings, that they gave him to wear. He readily responded to
        his daughter's drawing her arm through his, and took&mdash;and kept&mdash;her hand
        in both his own.
        </p>
        <p>
        They began to descend; Monsieur Defarge going first with the lamp, Mr.
        Lorry closing the little procession. They had not traversed many steps
        of the long main staircase when he stopped, and stared at the roof and
        round at the walls.
        </p>

        <p>
        "You remember the place, my father? You remember coming up here?"
        </p>
        <p>
        "What did you say?"
        </p>
        <p>
        But, before she could repeat the question, he murmured an answer as if
        she had repeated it.
        </p>
        <p>
        "Remember? No, I don't remember. It was so very long ago."
        </p>
        <p>
        That he had no recollection whatever of his having been brought from his
        prison to that house, was apparent to them. They heard him mutter,
        "One Hundred and Five, North Tower;" and when he looked about him, it
        evidently was for the strong fortress-walls which had long encompassed
        him. On their reaching the courtyard he instinctively altered his
        tread, as being in expectation of a drawbridge; and when there was
        no drawbridge, and he saw the carriage waiting in the open street, he
        dropped his daughter's hand and clasped his head again.
        </p>
        <p>
        No crowd was about the door; no people were discernible at any of the
        many windows; not even a chance passerby was in the street. An unnatural
        silence and desertion reigned there. Only one soul was to be seen, and
        that was Madame Defarge&mdash;who leaned against the door-post, knitting, and
        saw nothing.

        </p>
        <p>
        The prisoner had got into a coach, and his daughter had followed
        him, when Mr. Lorry's feet were arrested on the step by his asking,
        miserably, for his shoemaking tools and the unfinished shoes. Madame
        Defarge immediately called to her husband that she would get them, and
        went, knitting, out of the lamplight, through the courtyard. She quickly
        brought them down and handed them in;&mdash;and immediately afterwards leaned
        against the door-post, knitting, and saw nothing.
        </p>
        <p>
        Defarge got upon the box, and gave the word "To the Barrier!" The
        postilion cracked his whip, and they clattered away under the feeble
        over-swinging lamps.
        </p>
        <p>
        Under the over-swinging lamps&mdash;swinging ever brighter in the better
        streets, and ever dimmer in the worse&mdash;and by lighted shops, gay crowds,
        illuminated coffee-houses, and theatre-doors, to one of the city
        gates. Soldiers with lanterns, at the guard-house there. "Your papers,
        travellers!" "See here then, Monsieur the Officer," said Defarge,
        getting down, and taking him gravely apart, "these are the papers of
        monsieur inside, with the white head. They were consigned to me, with
        him, at the&mdash;" He dropped his voice, there was a flutter among the
        military lanterns, and one of them being handed into the coach by an arm
        in uniform, the eyes connected with the arm looked, not an every day
        or an every night look, at monsieur with the white head. "It is well.
        Forward!" from the uniform. "Adieu!" from Defarge. And so, under a short
        grove of feebler and feebler over-swinging lamps, out under the great
        grove of stars.
        </p>
        <p>
        Beneath that arch of unmoved and eternal lights; some, so remote from
        this little earth that the learned tell us it is doubtful whether their
        rays have even yet discovered it, as a point in space where anything
        is suffered or done: the shadows of the night were broad and black.
        All through the cold and restless interval, until dawn, they once more
        whispered in the ears of Mr. Jarvis Lorry&mdash;sitting opposite the buried
        man who had been dug out, and wondering what subtle powers were for ever
        lost to him, and what were capable of restoration&mdash;the old inquiry:

        </p>
        <p>
        "I hope you care to be recalled to life?"
        </p>
        <p>
        And the old answer:
        </p>
        <p>
        "I can't say."
        </p>
        <p>
        The end of the first book.
        </p>

      </div>

      <div id="part2">
        <h2>
            Book the Second&mdash;the Golden Thread
        </h2>

        <h2 id="part2-I">
            I. Five Years Later
        </h2>
        <p>
        Tellson's Bank by Temple Bar was an old-fashioned place, even in the
        year one thousand seven hundred and eighty. It was very small, very
        dark, very ugly, very incommodious. It was an old-fashioned place,
        moreover, in the moral attribute that the partners in the House were
        proud of its smallness, proud of its darkness, proud of its ugliness,
        proud of its incommodiousness. They were even boastful of its eminence
        in those particulars, and were fired by an express conviction that, if
        it were less objectionable, it would be less respectable. This was
        no passive belief, but an active weapon which they flashed at more
        convenient places of business. Tellson's (they said) wanted
        no elbow-room, Tellson's wanted no light, Tellson's wanted no
        embellishment. Noakes and Co.'s might, or Snooks Brothers' might; but
        Tellson's, thank Heaven&mdash;!
        </p>

        <p>
        Any one of these partners would have disinherited his son on the
        question of rebuilding Tellson's. In this respect the House was much
        on a par with the Country; which did very often disinherit its sons for
        suggesting improvements in laws and customs that had long been highly
        objectionable, but were only the more respectable.
        </p>
        <p>
        Thus it had come to pass, that Tellson's was the triumphant perfection
        of inconvenience. After bursting open a door of idiotic obstinacy with
        a weak rattle in its throat, you fell into Tellson's down two steps,
        and came to your senses in a miserable little shop, with two little
        counters, where the oldest of men made your cheque shake as if the
        wind rustled it, while they examined the signature by the dingiest of
        windows, which were always under a shower-bath of mud from Fleet-street,
        and which were made the dingier by their own iron bars proper, and the
        heavy shadow of Temple Bar. If your business necessitated your seeing
        "the House," you were put into a species of Condemned Hold at the back,
        where you meditated on a misspent life, until the House came with its
        hands in its pockets, and you could hardly blink at it in the dismal
        twilight. Your money came out of, or went into, wormy old wooden
        drawers, particles of which flew up your nose and down your throat when
        they were opened and shut. Your bank-notes had a musty odour, as if they
        were fast decomposing into rags again. Your plate was stowed away among
        the neighbouring cesspools, and evil communications corrupted its good
        polish in a day or two. Your deeds got into extemporised strong-rooms
        made of kitchens and sculleries, and fretted all the fat out of their
        parchments into the banking-house air. Your lighter boxes of family
        papers went up-stairs into a Barmecide room, that always had a great
        dining-table in it and never had a dinner, and where, even in the year
        one thousand seven hundred and eighty, the first letters written to you
        by your old love, or by your little children, were but newly released
        from the horror of being ogled through the windows, by the heads
        exposed on Temple Bar with an insensate brutality and ferocity worthy of
        Abyssinia or Ashantee.
        </p>
        <p>
        But indeed, at that time, putting to death was a recipe much in vogue
        with all trades and professions, and not least of all with Tellson's.
        Death is Nature's remedy for all things, and why not Legislation's?
        Accordingly, the forger was put to Death; the utterer of a bad note
        was put to Death; the unlawful opener of a letter was put to Death; the
        purloiner of forty shillings and sixpence was put to Death; the holder
        of a horse at Tellson's door, who made off with it, was put to
        Death; the coiner of a bad shilling was put to Death; the sounders of
        three-fourths of the notes in the whole gamut of Crime, were put to
        Death. Not that it did the least good in the way of prevention&mdash;it
        might almost have been worth remarking that the fact was exactly the
        reverse&mdash;but, it cleared off (as to this world) the trouble of each
        particular case, and left nothing else connected with it to be looked
        after. Thus, Tellson's, in its day, like greater places of business,
        its contemporaries, had taken so many lives, that, if the heads laid
        low before it had been ranged on Temple Bar instead of being privately
        disposed of, they would probably have excluded what little light the
        ground floor had, in a rather significant manner.
        </p>
        <p>
        Cramped in all kinds of dun cupboards and hutches at Tellson's, the
        oldest of men carried on the business gravely. When they took a young
        man into Tellson's London house, they hid him somewhere till he was
        old. They kept him in a dark place, like a cheese, until he had the full
        Tellson flavour and blue-mould upon him. Then only was he permitted to
        be seen, spectacularly poring over large books, and casting his breeches
        and gaiters into the general weight of the establishment.
        </p>
        <p>
        Outside Tellson's&mdash;never by any means in it, unless called in&mdash;was an
        odd-job-man, an occasional porter and messenger, who served as the live
        sign of the house. He was never absent during business hours, unless
        upon an errand, and then he was represented by his son: a grisly urchin
        of twelve, who was his express image. People understood that Tellson's,
        in a stately way, tolerated the odd-job-man. The house had always
        tolerated some person in that capacity, and time and tide had drifted
        this person to the post. His surname was Cruncher, and on the youthful
        occasion of his renouncing by proxy the works of darkness, in the
        easterly parish church of Hounsditch, he had received the added
        appellation of Jerry.

        </p>
        <p>
        The scene was Mr. Cruncher's private lodging in Hanging-sword-alley,
        Whitefriars: the time, half-past seven of the clock on a windy March
        morning, Anno Domini seventeen hundred and eighty. (Mr. Cruncher himself
        always spoke of the year of our Lord as Anna Dominoes: apparently under
        the impression that the Christian era dated from the invention of a
        popular game, by a lady who had bestowed her name upon it.)
        </p>
        <p>
        Mr. Cruncher's apartments were not in a savoury neighbourhood, and were
        but two in number, even if a closet with a single pane of glass in it
        might be counted as one. But they were very decently kept. Early as
        it was, on the windy March morning, the room in which he lay abed was
        already scrubbed throughout; and between the cups and saucers arranged
        for breakfast, and the lumbering deal table, a very clean white cloth
        was spread.
        </p>
        <p>
        Mr. Cruncher reposed under a patchwork counterpane, like a Harlequin
        at home. At first, he slept heavily, but, by degrees, began to roll
        and surge in bed, until he rose above the surface, with his spiky hair
        looking as if it must tear the sheets to ribbons. At which juncture, he
        exclaimed, in a voice of dire exasperation:
        </p>
        <p>
        "Bust me, if she ain't at it agin!"
        </p>
        <p>
        A woman of orderly and industrious appearance rose from her knees in a
        corner, with sufficient haste and trepidation to show that she was the
        person referred to.
        </p>
        <p>

        "What!" said Mr. Cruncher, looking out of bed for a boot. "You're at it
        agin, are you?"
        </p>
        <p>
        After hailing the mom with this second salutation, he threw a boot at
        the woman as a third. It was a very muddy boot, and may introduce the
        odd circumstance connected with Mr. Cruncher's domestic economy, that,
        whereas he often came home after banking hours with clean boots, he
        often got up next morning to find the same boots covered with clay.
        </p>
        <p>
        "What," said Mr. Cruncher, varying his apostrophe after missing his
        mark&mdash;"what are you up to, Aggerawayter?"
        </p>
        <p>
        "I was only saying my prayers."
        </p>
        <p>
        "Saying your prayers! You're a nice woman! What do you mean by flopping
        yourself down and praying agin me?"
        </p>
        <p>
        "I was not praying against you; I was praying for you."

        </p>
        <p>
        "You weren't. And if you were, I won't be took the liberty with. Here!
        your mother's a nice woman, young Jerry, going a praying agin your
        father's prosperity. You've got a dutiful mother, you have, my son.
        You've got a religious mother, you have, my boy: going and flopping
        herself down, and praying that the bread-and-butter may be snatched out
        of the mouth of her only child."
        </p>
        <p>
        Master Cruncher (who was in his shirt) took this very ill, and, turning
        to his mother, strongly deprecated any praying away of his personal
        board.
        </p>
        <p>
        "And what do you suppose, you conceited female," said Mr. Cruncher, with
        unconscious inconsistency, "that the worth of <i>your</i> prayers may be?
        Name the price that you put <i>your</i> prayers at!"
        </p>
        <p>

        "They only come from the heart, Jerry. They are worth no more than
        that."
        </p>
        <p>
        "Worth no more than that," repeated Mr. Cruncher. "They ain't worth
        much, then. Whether or no, I won't be prayed agin, I tell you. I can't
        afford it. I'm not a going to be made unlucky by <i>your</i> sneaking. If
        you must go flopping yourself down, flop in favour of your husband and
        child, and not in opposition to 'em. If I had had any but a unnat'ral
        wife, and this poor boy had had any but a unnat'ral mother, I might
        have made some money last week instead of being counter-prayed and
        countermined and religiously circumwented into the worst of luck.
        B-u-u-ust me!" said Mr. Cruncher, who all this time had been putting
        on his clothes, "if I ain't, what with piety and one blowed thing and
        another, been choused this last week into as bad luck as ever a poor
        devil of a honest tradesman met with! Young Jerry, dress yourself, my
        boy, and while I clean my boots keep a eye upon your mother now and
        then, and if you see any signs of more flopping, give me a call. For, I
        tell you," here he addressed his wife once more, "I won't be gone agin,
        in this manner. I am as rickety as a hackney-coach, I'm as sleepy as
        laudanum, my lines is strained to that degree that I shouldn't know, if
        it wasn't for the pain in 'em, which was me and which somebody else, yet
        I'm none the better for it in pocket; and it's my suspicion that you've
        been at it from morning to night to prevent me from being the better for
        it in pocket, and I won't put up with it, Aggerawayter, and what do you
        say now!"
        </p>
        <p>
        Growling, in addition, such phrases as "Ah! yes! You're religious, too.
        You wouldn't put yourself in opposition to the interests of your husband
        and child, would you? Not you!" and throwing off other sarcastic sparks
        from the whirling grindstone of his indignation, Mr. Cruncher betook
        himself to his boot-cleaning and his general preparation for business.
        In the meantime, his son, whose head was garnished with tenderer spikes,
        and whose young eyes stood close by one another, as his father's did,
        kept the required watch upon his mother. He greatly disturbed that poor
        woman at intervals, by darting out of his sleeping closet, where he made
        his toilet, with a suppressed cry of "You are going to flop, mother.
        &mdash;Halloa, father!" and, after raising this fictitious alarm, darting in
        again with an undutiful grin.
        </p>
        <p>
        Mr. Cruncher's temper was not at all improved when he came to his
        breakfast. He resented Mrs. Cruncher's saying grace with particular
        animosity.
        </p>
        <p>
        "Now, Aggerawayter! What are you up to? At it again?"

        </p>
        <p>
        His wife explained that she had merely "asked a blessing."
        </p>
        <p>
        "Don't do it!" said Mr. Crunches looking about, as if he rather expected
        to see the loaf disappear under the efficacy of his wife's petitions. "I
        ain't a going to be blest out of house and home. I won't have my wittles
        blest off my table. Keep still!"
        </p>
        <p>
        Exceedingly red-eyed and grim, as if he had been up all night at a party
        which had taken anything but a convivial turn, Jerry Cruncher worried
        his breakfast rather than ate it, growling over it like any four-footed
        inmate of a menagerie. Towards nine o'clock he smoothed his ruffled
        aspect, and, presenting as respectable and business-like an exterior as
        he could overlay his natural self with, issued forth to the occupation
        of the day.
        </p>
        <p>
        It could scarcely be called a trade, in spite of his favourite
        description of himself as "a honest tradesman." His stock consisted of
        a wooden stool, made out of a broken-backed chair cut down, which stool,
        young Jerry, walking at his father's side, carried every morning to
        beneath the banking-house window that was nearest Temple Bar: where,
        with the addition of the first handful of straw that could be gleaned
        from any passing vehicle to keep the cold and wet from the odd-job-man's
        feet, it formed the encampment for the day. On this post of his, Mr.
        Cruncher was as well known to Fleet-street and the Temple, as the Bar
        itself,&mdash;and was almost as in-looking.
        </p>
        <p>
        Encamped at a quarter before nine, in good time to touch his
        three-cornered hat to the oldest of men as they passed in to Tellson's,
        Jerry took up his station on this windy March morning, with young Jerry
        standing by him, when not engaged in making forays through the Bar, to
        inflict bodily and mental injuries of an acute description on passing
        boys who were small enough for his amiable purpose. Father and son,
        extremely like each other, looking silently on at the morning traffic
        in Fleet-street, with their two heads as near to one another as the two
        eyes of each were, bore a considerable resemblance to a pair of monkeys.
        The resemblance was not lessened by the accidental circumstance, that
        the mature Jerry bit and spat out straw, while the twinkling eyes of the
        youthful Jerry were as restlessly watchful of him as of everything else
        in Fleet-street.
        </p>

        <p>
        The head of one of the regular indoor messengers attached to Tellson's
        establishment was put through the door, and the word was given:
        </p>
        <p>
        "Porter wanted!"
        </p>
        <p>
        "Hooray, father! Here's an early job to begin with!"
        </p>
        <p>
        Having thus given his parent God speed, young Jerry seated himself on
        the stool, entered on his reversionary interest in the straw his father
        had been chewing, and cogitated.
        </p>
        <p>
        "Al-ways rusty! His fingers is al-ways rusty!" muttered young Jerry.
        "Where does my father get all that iron rust from? He don't get no iron
        rust here!"
        </p>

      </div>


      <div id="part2-II">
        <h2>
            II. A Sight
        </h2>
        <p>
        "You know the Old Bailey, well, no doubt?" said one of the oldest of
        clerks to Jerry the messenger.
        </p>
        <p>
        "Ye-es, sir," returned Jerry, in something of a dogged manner. "I <i>do</i>
        know the Bailey."
        </p>
        <p>
        "Just so. And you know Mr. Lorry."

        </p>
        <p>
        "I know Mr. Lorry, sir, much better than I know the Bailey. Much
        better," said Jerry, not unlike a reluctant witness at the establishment
        in question, "than I, as a honest tradesman, wish to know the Bailey."
        </p>
        <p>
        "Very well. Find the door where the witnesses go in, and show the
        door-keeper this note for Mr. Lorry. He will then let you in."
        </p>
        <p>
        "Into the court, sir?"
        </p>
        <p>
        "Into the court."
        </p>
        <p>
        Mr. Cruncher's eyes seemed to get a little closer to one another, and to
        interchange the inquiry, "What do you think of this?"
        </p>
        <p>

        "Am I to wait in the court, sir?" he asked, as the result of that
        conference.
        </p>
        <p>
        "I am going to tell you. The door-keeper will pass the note to Mr.
        Lorry, and do you make any gesture that will attract Mr. Lorry's
        attention, and show him where you stand. Then what you have to do, is,
        to remain there until he wants you."
        </p>
        <p>
        "Is that all, sir?"
        </p>
        <p>
        "That's all. He wishes to have a messenger at hand. This is to tell him
        you are there."
        </p>
        <p>
        As the ancient clerk deliberately folded and superscribed the note,
        Mr. Cruncher, after surveying him in silence until he came to the
        blotting-paper stage, remarked:
        </p>
        <p>
        "I suppose they'll be trying Forgeries this morning?"
        </p>

        <p>
        "Treason!"
        </p>
        <p>
        "That's quartering," said Jerry. "Barbarous!"
        </p>
        <p>
        "It is the law," remarked the ancient clerk, turning his surprised
        spectacles upon him. "It is the law."
        </p>
        <p>
        "It's hard in the law to spile a man, I think. It's hard enough to kill
        him, but it's wery hard to spile him, sir."
        </p>
        <p>
        "Not at all," retained the ancient clerk. "Speak well of the law. Take
        care of your chest and voice, my good friend, and leave the law to take
        care of itself. I give you that advice."
        </p>
        <p>
        "It's the damp, sir, what settles on my chest and voice," said Jerry. "I
        leave you to judge what a damp way of earning a living mine is."

        </p>
        <p>
        "Well, well," said the old clerk; "we all have our various ways of
        gaining a livelihood. Some of us have damp ways, and some of us have dry
        ways. Here is the letter. Go along."
        </p>
        <p>
        Jerry took the letter, and, remarking to himself with less internal
        deference than he made an outward show of, "You are a lean old one,
        too," made his bow, informed his son, in passing, of his destination,
        and went his way.
        </p>
        <p>
        They hanged at Tyburn, in those days, so the street outside Newgate had
        not obtained one infamous notoriety that has since attached to it.
        But, the gaol was a vile place, in which most kinds of debauchery and
        villainy were practised, and where dire diseases were bred, that came
        into court with the prisoners, and sometimes rushed straight from the
        dock at my Lord Chief Justice himself, and pulled him off the bench. It
        had more than once happened, that the Judge in the black cap pronounced
        his own doom as certainly as the prisoner's, and even died before him.
        For the rest, the Old Bailey was famous as a kind of deadly inn-yard,
        from which pale travellers set out continually, in carts and coaches, on
        a violent passage into the other world: traversing some two miles and a
        half of public street and road, and shaming few good citizens, if any.
        So powerful is use, and so desirable to be good use in the beginning. It
        was famous, too, for the pillory, a wise old institution, that inflicted
        a punishment of which no one could foresee the extent; also, for
        the whipping-post, another dear old institution, very humanising and
        softening to behold in action; also, for extensive transactions in
        blood-money, another fragment of ancestral wisdom, systematically
        leading to the most frightful mercenary crimes that could be committed
        under Heaven. Altogether, the Old Bailey, at that date, was a choice
        illustration of the precept, that "Whatever is is right;" an aphorism
        that would be as final as it is lazy, did it not include the troublesome
        consequence, that nothing that ever was, was wrong.
        </p>
        <p>
        Making his way through the tainted crowd, dispersed up and down this
        hideous scene of action, with the skill of a man accustomed to make his
        way quietly, the messenger found out the door he sought, and handed in
        his letter through a trap in it. For, people then paid to see the play
        at the Old Bailey, just as they paid to see the play in Bedlam&mdash;only the
        former entertainment was much the dearer. Therefore, all the Old Bailey
        doors were well guarded&mdash;except, indeed, the social doors by which the
        criminals got there, and those were always left wide open.
        </p>
        <p>
        After some delay and demur, the door grudgingly turned on its hinges a
        very little way, and allowed Mr. Jerry Cruncher to squeeze himself into
        court.

        </p>
        <p>
        "What's on?" he asked, in a whisper, of the man he found himself next
        to.
        </p>
        <p>
        "Nothing yet."
        </p>
        <p>
        "What's coming on?"
        </p>
        <p>
        "The Treason case."
        </p>
        <p>
        "The quartering one, eh?"
        </p>
        <p>

        "Ah!" returned the man, with a relish; "he'll be drawn on a hurdle to
        be half hanged, and then he'll be taken down and sliced before his own
        face, and then his inside will be taken out and burnt while he looks on,
        and then his head will be chopped off, and he'll be cut into quarters.
        That's the sentence."
        </p>
        <p>
        "If he's found Guilty, you mean to say?" Jerry added, by way of proviso.
        </p>
        <p>
        "Oh! they'll find him guilty," said the other. "Don't you be afraid of
        that."
        </p>
        <p>
        Mr. Cruncher's attention was here diverted to the door-keeper, whom he
        saw making his way to Mr. Lorry, with the note in his hand. Mr. Lorry
        sat at a table, among the gentlemen in wigs: not far from a wigged
        gentleman, the prisoner's counsel, who had a great bundle of papers
        before him: and nearly opposite another wigged gentleman with his hands
        in his pockets, whose whole attention, when Mr. Cruncher looked at him
        then or afterwards, seemed to be concentrated on the ceiling of the
        court. After some gruff coughing and rubbing of his chin and signing
        with his hand, Jerry attracted the notice of Mr. Lorry, who had stood up
        to look for him, and who quietly nodded and sat down again.
        </p>
        <p>
        "What's <i>he</i> got to do with the case?" asked the man he had spoken with.
        </p>

        <p>
        "Blest if I know," said Jerry.
        </p>
        <p>
        "What have <i>you</i> got to do with it, then, if a person may inquire?"
        </p>
        <p>
        "Blest if I know that either," said Jerry.
        </p>
        <p>
        The entrance of the Judge, and a consequent great stir and settling
        down in the court, stopped the dialogue. Presently, the dock became the
        central point of interest. Two gaolers, who had been standing there,
        went out, and the prisoner was brought in, and put to the bar.
        </p>
        <p>
        Everybody present, except the one wigged gentleman who looked at the
        ceiling, stared at him. All the human breath in the place, rolled
        at him, like a sea, or a wind, or a fire. Eager faces strained round
        pillars and corners, to get a sight of him; spectators in back rows
        stood up, not to miss a hair of him; people on the floor of the court,
        laid their hands on the shoulders of the people before them, to help
        themselves, at anybody's cost, to a view of him&mdash;stood a-tiptoe, got
        upon ledges, stood upon next to nothing, to see every inch of him.
        Conspicuous among these latter, like an animated bit of the spiked wall
        of Newgate, Jerry stood: aiming at the prisoner the beery breath of a
        whet he had taken as he came along, and discharging it to mingle with
        the waves of other beer, and gin, and tea, and coffee, and what not,
        that flowed at him, and already broke upon the great windows behind him
        in an impure mist and rain.

        </p>
        <p>
        The object of all this staring and blaring, was a young man of about
        five-and-twenty, well-grown and well-looking, with a sunburnt cheek and
        a dark eye. His condition was that of a young gentleman. He was plainly
        dressed in black, or very dark grey, and his hair, which was long and
        dark, was gathered in a ribbon at the back of his neck; more to be out
        of his way than for ornament. As an emotion of the mind will express
        itself through any covering of the body, so the paleness which his
        situation engendered came through the brown upon his cheek, showing the
        soul to be stronger than the sun. He was otherwise quite self-possessed,
        bowed to the Judge, and stood quiet.
        </p>
        <p>
        The sort of interest with which this man was stared and breathed at,
        was not a sort that elevated humanity. Had he stood in peril of a less
        horrible sentence&mdash;had there been a chance of any one of its savage
        details being spared&mdash;by just so much would he have lost in his
        fascination. The form that was to be doomed to be so shamefully mangled,
        was the sight; the immortal creature that was to be so butchered
        and torn asunder, yielded the sensation. Whatever gloss the various
        spectators put upon the interest, according to their several arts and
        powers of self-deceit, the interest was, at the root of it, Ogreish.
        </p>
        <p>
        Silence in the court! Charles Darnay had yesterday pleaded Not Guilty to
        an indictment denouncing him (with infinite jingle and jangle) for that
        he was a false traitor to our serene, illustrious, excellent, and so
        forth, prince, our Lord the King, by reason of his having, on divers
        occasions, and by divers means and ways, assisted Lewis, the French
        King, in his wars against our said serene, illustrious, excellent, and
        so forth; that was to say, by coming and going, between the dominions of
        our said serene, illustrious, excellent, and so forth, and those of the
        said French Lewis, and wickedly, falsely, traitorously, and otherwise
        evil-adverbiously, revealing to the said French Lewis what forces our
        said serene, illustrious, excellent, and so forth, had in preparation
        to send to Canada and North America. This much, Jerry, with his head
        becoming more and more spiky as the law terms bristled it, made out with
        huge satisfaction, and so arrived circuitously at the understanding that
        the aforesaid, and over and over again aforesaid, Charles Darnay, stood
        there before him upon his trial; that the jury were swearing in; and
        that Mr. Attorney-General was making ready to speak.
        </p>
        <p>
        The accused, who was (and who knew he was) being mentally hanged,
        beheaded, and quartered, by everybody there, neither flinched from
        the situation, nor assumed any theatrical air in it. He was quiet and
        attentive; watched the opening proceedings with a grave interest;
        and stood with his hands resting on the slab of wood before him, so
        composedly, that they had not displaced a leaf of the herbs with which
        it was strewn. The court was all bestrewn with herbs and sprinkled with
        vinegar, as a precaution against gaol air and gaol fever.
        </p>
        <p>
        Over the prisoner's head there was a mirror, to throw the light down
        upon him. Crowds of the wicked and the wretched had been reflected in
        it, and had passed from its surface and this earth's together. Haunted
        in a most ghastly manner that abominable place would have been, if the
        glass could ever have rendered back its reflections, as the ocean is one
        day to give up its dead. Some passing thought of the infamy and disgrace
        for which it had been reserved, may have struck the prisoner's mind. Be
        that as it may, a change in his position making him conscious of a bar
        of light across his face, he looked up; and when he saw the glass his
        face flushed, and his right hand pushed the herbs away.

        </p>
        <p>
        It happened, that the action turned his face to that side of the court
        which was on his left. About on a level with his eyes, there sat,
        in that corner of the Judge's bench, two persons upon whom his look
        immediately rested; so immediately, and so much to the changing of his
        aspect, that all the eyes that were turned upon him, turned to them.
        </p>
        <p>
        The spectators saw in the two figures, a young lady of little more than
        twenty, and a gentleman who was evidently her father; a man of a very
        remarkable appearance in respect of the absolute whiteness of his hair,
        and a certain indescribable intensity of face: not of an active kind,
        but pondering and self-communing. When this expression was upon him, he
        looked as if he were old; but when it was stirred and broken up&mdash;as
        it was now, in a moment, on his speaking to his daughter&mdash;he became a
        handsome man, not past the prime of life.
        </p>
        <p>
        His daughter had one of her hands drawn through his arm, as she sat by
        him, and the other pressed upon it. She had drawn close to him, in her
        dread of the scene, and in her pity for the prisoner. Her forehead had
        been strikingly expressive of an engrossing terror and compassion
        that saw nothing but the peril of the accused. This had been so very
        noticeable, so very powerfully and naturally shown, that starers who
        had had no pity for him were touched by her; and the whisper went about,
        "Who are they?"
        </p>
        <p>
        Jerry, the messenger, who had made his own observations, in his own
        manner, and who had been sucking the rust off his fingers in his
        absorption, stretched his neck to hear who they were. The crowd about
        him had pressed and passed the inquiry on to the nearest attendant, and
        from him it had been more slowly pressed and passed back; at last it got
        to Jerry:
        </p>
        <p>
        "Witnesses."

        </p>
        <p>
        "For which side?"
        </p>
        <p>
        "Against."
        </p>
        <p>
        "Against what side?"
        </p>
        <p>
        "The prisoner's."
        </p>
        <p>
        The Judge, whose eyes had gone in the general direction, recalled them,
        leaned back in his seat, and looked steadily at the man whose life was
        in his hand, as Mr. Attorney-General rose to spin the rope, grind the
        axe, and hammer the nails into the scaffold.
        </p>

      </div>

      <div id="part2-III">
        <h2>
            III. A Disappointment
        </h2>
        <p>
        Mr. Attorney-General had to inform the jury, that the prisoner before
        them, though young in years, was old in the treasonable practices which
        claimed the forfeit of his life. That this correspondence with the
        public enemy was not a correspondence of to-day, or of yesterday, or
        even of last year, or of the year before. That, it was certain the
        prisoner had, for longer than that, been in the habit of passing and
        repassing between France and England, on secret business of which
        he could give no honest account. That, if it were in the nature of
        traitorous ways to thrive (which happily it never was), the real
        wickedness and guilt of his business might have remained undiscovered.
        That Providence, however, had put it into the heart of a person who
        was beyond fear and beyond reproach, to ferret out the nature of the
        prisoner's schemes, and, struck with horror, to disclose them to his
        Majesty's Chief Secretary of State and most honourable Privy Council.
        That, this patriot would be produced before them. That, his position and
        attitude were, on the whole, sublime. That, he had been the prisoner's
        friend, but, at once in an auspicious and an evil hour detecting his
        infamy, had resolved to immolate the traitor he could no longer cherish
        in his bosom, on the sacred altar of his country. That, if statues
        were decreed in Britain, as in ancient Greece and Rome, to public
        benefactors, this shining citizen would assuredly have had one. That, as
        they were not so decreed, he probably would not have one. That, Virtue,
        as had been observed by the poets (in many passages which he well
        knew the jury would have, word for word, at the tips of their tongues;
        whereat the jury's countenances displayed a guilty consciousness that
        they knew nothing about the passages), was in a manner contagious; more
        especially the bright virtue known as patriotism, or love of country.
        That, the lofty example of this immaculate and unimpeachable witness
        for the Crown, to refer to whom however unworthily was an honour, had
        communicated itself to the prisoner's servant, and had engendered in him
        a holy determination to examine his master's table-drawers and pockets,
        and secrete his papers. That, he (Mr. Attorney-General) was prepared to
        hear some disparagement attempted of this admirable servant; but that,
        in a general way, he preferred him to his (Mr. Attorney-General's)
        brothers and sisters, and honoured him more than his (Mr.
        Attorney-General's) father and mother. That, he called with confidence
        on the jury to come and do likewise. That, the evidence of these two
        witnesses, coupled with the documents of their discovering that would be
        produced, would show the prisoner to have been furnished with lists of
        his Majesty's forces, and of their disposition and preparation, both by
        sea and land, and would leave no doubt that he had habitually conveyed
        such information to a hostile power. That, these lists could not be
        proved to be in the prisoner's handwriting; but that it was all the
        same; that, indeed, it was rather the better for the prosecution, as
        showing the prisoner to be artful in his precautions. That, the proof
        would go back five years, and would show the prisoner already engaged
        in these pernicious missions, within a few weeks before the date of the
        very first action fought between the British troops and the Americans.
        That, for these reasons, the jury, being a loyal jury (as he knew they
        were), and being a responsible jury (as <i>they</i> knew they were), must
        positively find the prisoner Guilty, and make an end of him, whether
        they liked it or not. That, they never could lay their heads upon their
        pillows; that, they never could tolerate the idea of their wives laying
        their heads upon their pillows; that, they never could endure the notion
        of their children laying their heads upon their pillows; in short, that
        there never more could be, for them or theirs, any laying of heads upon
        pillows at all, unless the prisoner's head was taken off. That head
        Mr. Attorney-General concluded by demanding of them, in the name of
        everything he could think of with a round turn in it, and on the faith
        of his solemn asseveration that he already considered the prisoner as
        good as dead and gone.
        </p>
        <p>
        When the Attorney-General ceased, a buzz arose in the court as if
        a cloud of great blue-flies were swarming about the prisoner, in
        anticipation of what he was soon to become. When toned down again, the
        unimpeachable patriot appeared in the witness-box.
        </p>
        <p>

        Mr. Solicitor-General then, following his leader's lead, examined the
        patriot: John Barsad, gentleman, by name. The story of his pure soul was
        exactly what Mr. Attorney-General had described it to be&mdash;perhaps, if
        it had a fault, a little too exactly. Having released his noble bosom
        of its burden, he would have modestly withdrawn himself, but that the
        wigged gentleman with the papers before him, sitting not far from Mr.
        Lorry, begged to ask him a few questions. The wigged gentleman sitting
        opposite, still looking at the ceiling of the court.
        </p>
        <p>
        Had he ever been a spy himself? No, he scorned the base insinuation.
        What did he live upon? His property. Where was his property? He didn't
        precisely remember where it was. What was it? No business of anybody's.
        Had he inherited it? Yes, he had. From whom? Distant relation. Very
        distant? Rather. Ever been in prison? Certainly not. Never in a debtors'
        prison? Didn't see what that had to do with it. Never in a debtors'
        prison?&mdash;Come, once again. Never? Yes. How many times? Two or three
        times. Not five or six? Perhaps. Of what profession? Gentleman. Ever
        been kicked? Might have been. Frequently? No. Ever kicked downstairs?
        Decidedly not; once received a kick on the top of a staircase, and fell
        downstairs of his own accord. Kicked on that occasion for cheating at
        dice? Something to that effect was said by the intoxicated liar who
        committed the assault, but it was not true. Swear it was not true?
        Positively. Ever live by cheating at play? Never. Ever live by play? Not
        more than other gentlemen do. Ever borrow money of the prisoner? Yes.
        Ever pay him? No. Was not this intimacy with the prisoner, in reality a
        very slight one, forced upon the prisoner in coaches, inns, and packets?
        No. Sure he saw the prisoner with these lists? Certain. Knew no more
        about the lists? No. Had not procured them himself, for instance? No.
        Expect to get anything by this evidence? No. Not in regular government
        pay and employment, to lay traps? Oh dear no. Or to do anything? Oh dear
        no. Swear that? Over and over again. No motives but motives of sheer
        patriotism? None whatever.
        </p>
        <p>
        The virtuous servant, Roger Cly, swore his way through the case at a
        great rate. He had taken service with the prisoner, in good faith and
        simplicity, four years ago. He had asked the prisoner, aboard the Calais
        packet, if he wanted a handy fellow, and the prisoner had engaged him.
        He had not asked the prisoner to take the handy fellow as an act of
        charity&mdash;never thought of such a thing. He began to have suspicions of
        the prisoner, and to keep an eye upon him, soon afterwards. In arranging
        his clothes, while travelling, he had seen similar lists to these in the
        prisoner's pockets, over and over again. He had taken these lists from
        the drawer of the prisoner's desk. He had not put them there first. He
        had seen the prisoner show these identical lists to French gentlemen
        at Calais, and similar lists to French gentlemen, both at Calais and
        Boulogne. He loved his country, and couldn't bear it, and had given
        information. He had never been suspected of stealing a silver tea-pot;
        he had been maligned respecting a mustard-pot, but it turned out to be
        only a plated one. He had known the last witness seven or eight years;
        that was merely a coincidence. He didn't call it a particularly curious
        coincidence; most coincidences were curious. Neither did he call it a
        curious coincidence that true patriotism was <i>his</i> only motive too. He
        was a true Briton, and hoped there were many like him.
        </p>
        <p>
        The blue-flies buzzed again, and Mr. Attorney-General called Mr. Jarvis
        Lorry.
        </p>

        <p>
        "Mr. Jarvis Lorry, are you a clerk in Tellson's bank?"
        </p>
        <p>
        "I am."
        </p>
        <p>
        "On a certain Friday night in November one thousand seven hundred and
        seventy-five, did business occasion you to travel between London and
        Dover by the mail?"
        </p>
        <p>
        "It did."
        </p>
        <p>
        "Were there any other passengers in the mail?"
        </p>
        <p>
        "Two."

        </p>
        <p>
        "Did they alight on the road in the course of the night?"
        </p>
        <p>
        "They did."
        </p>
        <p>
        "Mr. Lorry, look upon the prisoner. Was he one of those two passengers?"
        </p>
        <p>
        "I cannot undertake to say that he was."
        </p>
        <p>
        "Does he resemble either of these two passengers?"
        </p>
        <p>

        "Both were so wrapped up, and the night was so dark, and we were all so
        reserved, that I cannot undertake to say even that."
        </p>
        <p>
        "Mr. Lorry, look again upon the prisoner. Supposing him wrapped up as
        those two passengers were, is there anything in his bulk and stature to
        render it unlikely that he was one of them?"
        </p>
        <p>
        "No."
        </p>
        <p>
        "You will not swear, Mr. Lorry, that he was not one of them?"
        </p>
        <p>
        "No."
        </p>
        <p>
        "So at least you say he may have been one of them?"
        </p>

        <p>
        "Yes. Except that I remember them both to have been&mdash;like
        myself&mdash;timorous of highwaymen, and the prisoner has not a timorous
        air."
        </p>
        <p>
        "Did you ever see a counterfeit of timidity, Mr. Lorry?"
        </p>
        <p>
        "I certainly have seen that."
        </p>
        <p>
        "Mr. Lorry, look once more upon the prisoner. Have you seen him, to your
        certain knowledge, before?"
        </p>
        <p>
        "I have."
        </p>

        <p>
        "When?"
        </p>
        <p>
        "I was returning from France a few days afterwards, and, at Calais, the
        prisoner came on board the packet-ship in which I returned, and made the
        voyage with me."
        </p>
        <p>
        "At what hour did he come on board?"
        </p>
        <p>
        "At a little after midnight."
        </p>
        <p>
        "In the dead of the night. Was he the only passenger who came on board
        at that untimely hour?"
        </p>
        <p>
        "He happened to be the only one."

        </p>
        <p>
        "Never mind about 'happening,' Mr. Lorry. He was the only passenger who
        came on board in the dead of the night?"
        </p>
        <p>
        "He was."
        </p>
        <p>
        "Were you travelling alone, Mr. Lorry, or with any companion?"
        </p>
        <p>
        "With two companions. A gentleman and lady. They are here."
        </p>
        <p>
        "They are here. Had you any conversation with the prisoner?"
        </p>
        <p>

        "Hardly any. The weather was stormy, and the passage long and rough, and
        I lay on a sofa, almost from shore to shore."
        </p>
        <p>
        "Miss Manette!"
        </p>
        <p>
        The young lady, to whom all eyes had been turned before, and were now
        turned again, stood up where she had sat. Her father rose with her, and
        kept her hand drawn through his arm.
        </p>
        <p>
        "Miss Manette, look upon the prisoner."
        </p>
        <p>
        To be confronted with such pity, and such earnest youth and beauty, was
        far more trying to the accused than to be confronted with all the crowd.
        Standing, as it were, apart with her on the edge of his grave, not all
        the staring curiosity that looked on, could, for the moment, nerve him
        to remain quite still. His hurried right hand parcelled out the herbs
        before him into imaginary beds of flowers in a garden; and his efforts
        to control and steady his breathing shook the lips from which the colour
        rushed to his heart. The buzz of the great flies was loud again.
        </p>
        <p>
        "Miss Manette, have you seen the prisoner before?"
        </p>

        <p>
        "Yes, sir."
        </p>
        <p>
        "Where?"
        </p>
        <p>
        "On board of the packet-ship just now referred to, sir, and on the same
        occasion."
        </p>
        <p>
        "You are the young lady just now referred to?"
        </p>
        <p>
        "O! most unhappily, I am!"
        </p>
        <p>
        The plaintive tone of her compassion merged into the less musical voice
        of the Judge, as he said something fiercely: "Answer the questions put
        to you, and make no remark upon them."

        </p>
        <p>
        "Miss Manette, had you any conversation with the prisoner on that
        passage across the Channel?"
        </p>
        <p>
        "Yes, sir."
        </p>
        <p>
        "Recall it."
        </p>
        <p>
        In the midst of a profound stillness, she faintly began: "When the
        gentleman came on board&mdash;"
        </p>
        <p>
        "Do you mean the prisoner?" inquired the Judge, knitting his brows.
        </p>

        <p>
        "Yes, my Lord."
        </p>
        <p>
        "Then say the prisoner."
        </p>
        <p>
        "When the prisoner came on board, he noticed that my father," turning
        her eyes lovingly to him as he stood beside her, "was much fatigued
        and in a very weak state of health. My father was so reduced that I was
        afraid to take him out of the air, and I had made a bed for him on the
        deck near the cabin steps, and I sat on the deck at his side to take
        care of him. There were no other passengers that night, but we four.
        The prisoner was so good as to beg permission to advise me how I could
        shelter my father from the wind and weather, better than I had done. I
        had not known how to do it well, not understanding how the wind would
        set when we were out of the harbour. He did it for me. He expressed
        great gentleness and kindness for my father's state, and I am sure he
        felt it. That was the manner of our beginning to speak together."
        </p>
        <p>
        "Let me interrupt you for a moment. Had he come on board alone?"
        </p>
        <p>
        "No."
        </p>
        <p>
        "How many were with him?"

        </p>
        <p>
        "Two French gentlemen."
        </p>
        <p>
        "Had they conferred together?"
        </p>
        <p>
        "They had conferred together until the last moment, when it was
        necessary for the French gentlemen to be landed in their boat."
        </p>
        <p>
        "Had any papers been handed about among them, similar to these lists?"
        </p>
        <p>
        "Some papers had been handed about among them, but I don't know what
        papers."
        </p>
        <p>

        "Like these in shape and size?"
        </p>
        <p>
        "Possibly, but indeed I don't know, although they stood whispering very
        near to me: because they stood at the top of the cabin steps to have the
        light of the lamp that was hanging there; it was a dull lamp, and they
        spoke very low, and I did not hear what they said, and saw only that
        they looked at papers."
        </p>
        <p>
        "Now, to the prisoner's conversation, Miss Manette."
        </p>
        <p>
        "The prisoner was as open in his confidence with me&mdash;which arose out
        of my helpless situation&mdash;as he was kind, and good, and useful to my
        father. I hope," bursting into tears, "I may not repay him by doing him
        harm to-day."
        </p>
        <p>
        Buzzing from the blue-flies.
        </p>
        <p>

        "Miss Manette, if the prisoner does not perfectly understand that
        you give the evidence which it is your duty to give&mdash;which you must
        give&mdash;and which you cannot escape from giving&mdash;with great unwillingness,
        he is the only person present in that condition. Please to go on."
        </p>
        <p>
        "He told me that he was travelling on business of a delicate and
        difficult nature, which might get people into trouble, and that he was
        therefore travelling under an assumed name. He said that this business
        had, within a few days, taken him to France, and might, at intervals,
        take him backwards and forwards between France and England for a long
        time to come."
        </p>
        <p>
        "Did he say anything about America, Miss Manette? Be particular."
        </p>
        <p>
        "He tried to explain to me how that quarrel had arisen, and he said
        that, so far as he could judge, it was a wrong and foolish one on
        England's part. He added, in a jesting way, that perhaps George
        Washington might gain almost as great a name in history as George the
        Third. But there was no harm in his way of saying this: it was said
        laughingly, and to beguile the time."
        </p>
        <p>
        Any strongly marked expression of face on the part of a chief actor in
        a scene of great interest to whom many eyes are directed, will be
        unconsciously imitated by the spectators. Her forehead was painfully
        anxious and intent as she gave this evidence, and, in the pauses when
        she stopped for the Judge to write it down, watched its effect upon
        the counsel for and against. Among the lookers-on there was the same
        expression in all quarters of the court; insomuch, that a great majority
        of the foreheads there, might have been mirrors reflecting the witness,
        when the Judge looked up from his notes to glare at that tremendous
        heresy about George Washington.
        </p>

        <p>
        Mr. Attorney-General now signified to my Lord, that he deemed it
        necessary, as a matter of precaution and form, to call the young lady's
        father, Doctor Manette. Who was called accordingly.
        </p>
        <p>
        "Doctor Manette, look upon the prisoner. Have you ever seen him before?"
        </p>
        <p>
        "Once. When he called at my lodgings in London. Some three years, or
        three years and a half ago."
        </p>
        <p>
        "Can you identify him as your fellow-passenger on board the packet, or
        speak to his conversation with your daughter?"
        </p>
        <p>
        "Sir, I can do neither."
        </p>
        <p>
        "Is there any particular and special reason for your being unable to do
        either?"

        </p>
        <p>
        He answered, in a low voice, "There is."
        </p>
        <p>
        "Has it been your misfortune to undergo a long imprisonment, without
        trial, or even accusation, in your native country, Doctor Manette?"
        </p>
        <p>
        He answered, in a tone that went to every heart, "A long imprisonment."
        </p>
        <p>
        "Were you newly released on the occasion in question?"
        </p>
        <p>
        "They tell me so."
        </p>
        <p>

        "Have you no remembrance of the occasion?"
        </p>
        <p>
        "None. My mind is a blank, from some time&mdash;I cannot even say what
        time&mdash;when I employed myself, in my captivity, in making shoes, to the
        time when I found myself living in London with my dear daughter
        here. She had become familiar to me, when a gracious God restored
        my faculties; but, I am quite unable even to say how she had become
        familiar. I have no remembrance of the process."
        </p>
        <p>
        Mr. Attorney-General sat down, and the father and daughter sat down
        together.
        </p>
        <p>
        A singular circumstance then arose in the case. The object in hand being
        to show that the prisoner went down, with some fellow-plotter untracked,
        in the Dover mail on that Friday night in November five years ago, and
        got out of the mail in the night, as a blind, at a place where he did
        not remain, but from which he travelled back some dozen miles or more,
        to a garrison and dockyard, and there collected information; a witness
        was called to identify him as having been at the precise time required,
        in the coffee-room of an hotel in that garrison-and-dockyard town,
        waiting for another person. The prisoner's counsel was cross-examining
        this witness with no result, except that he had never seen the prisoner
        on any other occasion, when the wigged gentleman who had all this time
        been looking at the ceiling of the court, wrote a word or two on a
        little piece of paper, screwed it up, and tossed it to him. Opening
        this piece of paper in the next pause, the counsel looked with great
        attention and curiosity at the prisoner.
        </p>
        <p>
        "You say again you are quite sure that it was the prisoner?"
        </p>
        <p>

        The witness was quite sure.
        </p>
        <p>
        "Did you ever see anybody very like the prisoner?"
        </p>
        <p>
        Not so like (the witness said) as that he could be mistaken.
        </p>
        <p>
        "Look well upon that gentleman, my learned friend there," pointing
        to him who had tossed the paper over, "and then look well upon the
        prisoner. How say you? Are they very like each other?"
        </p>
        <p>
        Allowing for my learned friend's appearance being careless and slovenly
        if not debauched, they were sufficiently like each other to surprise,
        not only the witness, but everybody present, when they were thus brought
        into comparison. My Lord being prayed to bid my learned friend lay aside
        his wig, and giving no very gracious consent, the likeness became
        much more remarkable. My Lord inquired of Mr. Stryver (the prisoner's
        counsel), whether they were next to try Mr. Carton (name of my learned
        friend) for treason? But, Mr. Stryver replied to my Lord, no; but he
        would ask the witness to tell him whether what happened once, might
        happen twice; whether he would have been so confident if he had seen
        this illustration of his rashness sooner, whether he would be so
        confident, having seen it; and more. The upshot of which, was, to smash
        this witness like a crockery vessel, and shiver his part of the case to
        useless lumber.
        </p>
        <p>
        Mr. Cruncher had by this time taken quite a lunch of rust off his
        fingers in his following of the evidence. He had now to attend while Mr.
        Stryver fitted the prisoner's case on the jury, like a compact suit
        of clothes; showing them how the patriot, Barsad, was a hired spy and
        traitor, an unblushing trafficker in blood, and one of the greatest
        scoundrels upon earth since accursed Judas&mdash;which he certainly did look
        rather like. How the virtuous servant, Cly, was his friend and partner,
        and was worthy to be; how the watchful eyes of those forgers and false
        swearers had rested on the prisoner as a victim, because some family
        affairs in France, he being of French extraction, did require his making
        those passages across the Channel&mdash;though what those affairs were, a
        consideration for others who were near and dear to him, forbade him,
        even for his life, to disclose. How the evidence that had been warped
        and wrested from the young lady, whose anguish in giving it they
        had witnessed, came to nothing, involving the mere little innocent
        gallantries and politenesses likely to pass between any young gentleman
        and young lady so thrown together;&mdash;with the exception of that
        reference to George Washington, which was altogether too extravagant and
        impossible to be regarded in any other light than as a monstrous joke.
        How it would be a weakness in the government to break down in this
        attempt to practise for popularity on the lowest national antipathies
        and fears, and therefore Mr. Attorney-General had made the most of it;
        how, nevertheless, it rested upon nothing, save that vile and infamous
        character of evidence too often disfiguring such cases, and of which the
        State Trials of this country were full. But, there my Lord interposed
        (with as grave a face as if it had not been true), saying that he could
        not sit upon that Bench and suffer those allusions.

        </p>
        <p>
        Mr. Stryver then called his few witnesses, and Mr. Cruncher had next to
        attend while Mr. Attorney-General turned the whole suit of clothes Mr.
        Stryver had fitted on the jury, inside out; showing how Barsad and
        Cly were even a hundred times better than he had thought them, and the
        prisoner a hundred times worse. Lastly, came my Lord himself, turning
        the suit of clothes, now inside out, now outside in, but on the whole
        decidedly trimming and shaping them into grave-clothes for the prisoner.
        </p>
        <p>
        And now, the jury turned to consider, and the great flies swarmed again.
        </p>
        <p>
        Mr. Carton, who had so long sat looking at the ceiling of the court,
        changed neither his place nor his attitude, even in this excitement.
        While his teamed friend, Mr. Stryver, massing his papers before him,
        whispered with those who sat near, and from time to time glanced
        anxiously at the jury; while all the spectators moved more or less, and
        grouped themselves anew; while even my Lord himself arose from his seat,
        and slowly paced up and down his platform, not unattended by a suspicion
        in the minds of the audience that his state was feverish; this one man
        sat leaning back, with his torn gown half off him, his untidy wig put
        on just as it had happened to fight on his head after its removal, his
        hands in his pockets, and his eyes on the ceiling as they had been all
        day. Something especially reckless in his demeanour, not only gave him
        a disreputable look, but so diminished the strong resemblance he
        undoubtedly bore to the prisoner (which his momentary earnestness,
        when they were compared together, had strengthened), that many of the
        lookers-on, taking note of him now, said to one another they would
        hardly have thought the two were so alike. Mr. Cruncher made the
        observation to his next neighbour, and added, "I'd hold half a guinea
        that <i>he</i> don't get no law-work to do. Don't look like the sort of one
        to get any, do he?"
        </p>
        <p>
        Yet, this Mr. Carton took in more of the details of the scene than he
        appeared to take in; for now, when Miss Manette's head dropped upon
        her father's breast, he was the first to see it, and to say audibly:
        "Officer! look to that young lady. Help the gentleman to take her out.
        Don't you see she will fall!"
        </p>
        <p>

        There was much commiseration for her as she was removed, and much
        sympathy with her father. It had evidently been a great distress to
        him, to have the days of his imprisonment recalled. He had shown
        strong internal agitation when he was questioned, and that pondering or
        brooding look which made him old, had been upon him, like a heavy cloud,
        ever since. As he passed out, the jury, who had turned back and paused a
        moment, spoke, through their foreman.
        </p>
        <p>
        They were not agreed, and wished to retire. My Lord (perhaps with George
        Washington on his mind) showed some surprise that they were not agreed,
        but signified his pleasure that they should retire under watch and ward,
        and retired himself. The trial had lasted all day, and the lamps in
        the court were now being lighted. It began to be rumoured that the
        jury would be out a long while. The spectators dropped off to get
        refreshment, and the prisoner withdrew to the back of the dock, and sat
        down.
        </p>
        <p>
        Mr. Lorry, who had gone out when the young lady and her father went out,
        now reappeared, and beckoned to Jerry: who, in the slackened interest,
        could easily get near him.
        </p>
        <p>
        "Jerry, if you wish to take something to eat, you can. But, keep in the
        way. You will be sure to hear when the jury come in. Don't be a moment
        behind them, for I want you to take the verdict back to the bank. You
        are the quickest messenger I know, and will get to Temple Bar long
        before I can."
        </p>
        <p>
        Jerry had just enough forehead to knuckle, and he knuckled it in
        acknowledgment of this communication and a shilling. Mr. Carton came up
        at the moment, and touched Mr. Lorry on the arm.
        </p>
        <p>
        "How is the young lady?"
        </p>

        <p>
        "She is greatly distressed; but her father is comforting her, and she
        feels the better for being out of court."
        </p>
        <p>
        "I'll tell the prisoner so. It won't do for a respectable bank gentleman
        like you, to be seen speaking to him publicly, you know."
        </p>
        <p>
        Mr. Lorry reddened as if he were conscious of having debated the point
        in his mind, and Mr. Carton made his way to the outside of the bar.
        The way out of court lay in that direction, and Jerry followed him, all
        eyes, ears, and spikes.
        </p>
        <p>
        "Mr. Darnay!"
        </p>
        <p>
        The prisoner came forward directly.
        </p>
        <p>
        "You will naturally be anxious to hear of the witness, Miss Manette. She
        will do very well. You have seen the worst of her agitation."

        </p>
        <p>
        "I am deeply sorry to have been the cause of it. Could you tell her so
        for me, with my fervent acknowledgments?"
        </p>
        <p>
        "Yes, I could. I will, if you ask it."
        </p>
        <p>
        Mr. Carton's manner was so careless as to be almost insolent. He stood,
        half turned from the prisoner, lounging with his elbow against the bar.
        </p>
        <p>
        "I do ask it. Accept my cordial thanks."
        </p>
        <p>
        "What," said Carton, still only half turned towards him, "do you expect,
        Mr. Darnay?"
        </p>
        <p>

        "The worst."
        </p>
        <p>
        "It's the wisest thing to expect, and the likeliest. But I think their
        withdrawing is in your favour."
        </p>
        <p>
        Loitering on the way out of court not being allowed, Jerry heard no
        more: but left them&mdash;so like each other in feature, so unlike each other
        in manner&mdash;standing side by side, both reflected in the glass above
        them.
        </p>
        <p>
        An hour and a half limped heavily away in the thief-and-rascal crowded
        passages below, even though assisted off with mutton pies and ale.
        The hoarse messenger, uncomfortably seated on a form after taking that
        refection, had dropped into a doze, when a loud murmur and a rapid tide
        of people setting up the stairs that led to the court, carried him along
        with them.
        </p>
        <p>
        "Jerry! Jerry!" Mr. Lorry was already calling at the door when he got
        there.
        </p>
        <p>

        "Here, sir! It's a fight to get back again. Here I am, sir!"
        </p>
        <p>
        Mr. Lorry handed him a paper through the throng. "Quick! Have you got
        it?"
        </p>
        <p>
        "Yes, sir."
        </p>
        <p>
        Hastily written on the paper was the word "AQUITTED."
        </p>
        <p>
        "If you had sent the message, 'Recalled to Life,' again," muttered
        Jerry, as he turned, "I should have known what you meant, this time."
        </p>
        <p>
        He had no opportunity of saying, or so much as thinking, anything else,
        until he was clear of the Old Bailey; for, the crowd came pouring out
        with a vehemence that nearly took him off his legs, and a loud buzz
        swept into the street as if the baffled blue-flies were dispersing in
        search of other carrion.
        </p>

      </div>

      <div id="part2-IV">

        <h2>
            IV. Congratulatory
        </h2>
        <p>
        From the dimly-lighted passages of the court, the last sediment of the
        human stew that had been boiling there all day, was straining off, when
        Doctor Manette, Lucie Manette, his daughter, Mr. Lorry, the solicitor
        for the defence, and its counsel, Mr. Stryver, stood gathered round Mr.
        Charles Darnay&mdash;just released&mdash;congratulating him on his escape from
        death.
        </p>
        <p>
        It would have been difficult by a far brighter light, to recognise
        in Doctor Manette, intellectual of face and upright of bearing, the
        shoemaker of the garret in Paris. Yet, no one could have looked at him
        twice, without looking again: even though the opportunity of observation
        had not extended to the mournful cadence of his low grave voice, and
        to the abstraction that overclouded him fitfully, without any apparent
        reason. While one external cause, and that a reference to his long
        lingering agony, would always&mdash;as on the trial&mdash;evoke this condition
        from the depths of his soul, it was also in its nature to arise of
        itself, and to draw a gloom over him, as incomprehensible to those
        unacquainted with his story as if they had seen the shadow of the actual
        Bastille thrown upon him by a summer sun, when the substance was three
        hundred miles away.

        </p>
        <p>
        Only his daughter had the power of charming this black brooding from
        his mind. She was the golden thread that united him to a Past beyond his
        misery, and to a Present beyond his misery: and the sound of her voice,
        the light of her face, the touch of her hand, had a strong beneficial
        influence with him almost always. Not absolutely always, for she could
        recall some occasions on which her power had failed; but they were few
        and slight, and she believed them over.
        </p>
        <p>
        Mr. Darnay had kissed her hand fervently and gratefully, and had turned
        to Mr. Stryver, whom he warmly thanked. Mr. Stryver, a man of little
        more than thirty, but looking twenty years older than he was, stout,
        loud, red, bluff, and free from any drawback of delicacy, had a pushing
        way of shouldering himself (morally and physically) into companies and
        conversations, that argued well for his shouldering his way up in life.
        </p>
        <p>
        He still had his wig and gown on, and he said, squaring himself at his
        late client to that degree that he squeezed the innocent Mr. Lorry clean
        out of the group: "I am glad to have brought you off with honour, Mr.
        Darnay. It was an infamous prosecution, grossly infamous; but not the
        less likely to succeed on that account."
        </p>
        <p>
        "You have laid me under an obligation to you for life&mdash;in two senses,"
        said his late client, taking his hand.
        </p>
        <p>
        "I have done my best for you, Mr. Darnay; and my best is as good as
        another man's, I believe."
        </p>

        <p>
        It clearly being incumbent on some one to say, "Much better," Mr. Lorry
        said it; perhaps not quite disinterestedly, but with the interested
        object of squeezing himself back again.
        </p>
        <p>
        "You think so?" said Mr. Stryver. "Well! you have been present all day,
        and you ought to know. You are a man of business, too."
        </p>
        <p>
        "And as such," quoth Mr. Lorry, whom the counsel learned in the law had
        now shouldered back into the group, just as he had previously shouldered
        him out of it&mdash;"as such I will appeal to Doctor Manette, to break up
        this conference and order us all to our homes. Miss Lucie looks ill, Mr.
        Darnay has had a terrible day, we are worn out."
        </p>
        <p>
        "Speak for yourself, Mr. Lorry," said Stryver; "I have a night's work to
        do yet. Speak for yourself."
        </p>
        <p>
        "I speak for myself," answered Mr. Lorry, "and for Mr. Darnay, and for
        Miss Lucie, and&mdash;Miss Lucie, do you not think I may speak for us all?"
        He asked her the question pointedly, and with a glance at her father.
        </p>

        <p>
        His face had become frozen, as it were, in a very curious look at
        Darnay: an intent look, deepening into a frown of dislike and distrust,
        not even unmixed with fear. With this strange expression on him his
        thoughts had wandered away.
        </p>
        <p>
        "My father," said Lucie, softly laying her hand on his.
        </p>
        <p>
        He slowly shook the shadow off, and turned to her.
        </p>
        <p>
        "Shall we go home, my father?"
        </p>
        <p>
        With a long breath, he answered "Yes."
        </p>
        <p>
        The friends of the acquitted prisoner had dispersed, under the
        impression&mdash;which he himself had originated&mdash;that he would not be
        released that night. The lights were nearly all extinguished in the
        passages, the iron gates were being closed with a jar and a rattle,
        and the dismal place was deserted until to-morrow morning's interest of
        gallows, pillory, whipping-post, and branding-iron, should repeople it.
        Walking between her father and Mr. Darnay, Lucie Manette passed into
        the open air. A hackney-coach was called, and the father and daughter
        departed in it.

        </p>
        <p>
        Mr. Stryver had left them in the passages, to shoulder his way back
        to the robing-room. Another person, who had not joined the group, or
        interchanged a word with any one of them, but who had been leaning
        against the wall where its shadow was darkest, had silently strolled
        out after the rest, and had looked on until the coach drove away. He now
        stepped up to where Mr. Lorry and Mr. Darnay stood upon the pavement.
        </p>
        <p>
        "So, Mr. Lorry! Men of business may speak to Mr. Darnay now?"
        </p>
        <p>
        Nobody had made any acknowledgment of Mr. Carton's part in the day's
        proceedings; nobody had known of it. He was unrobed, and was none the
        better for it in appearance.
        </p>
        <p>
        "If you knew what a conflict goes on in the business mind, when the
        business mind is divided between good-natured impulse and business
        appearances, you would be amused, Mr. Darnay."
        </p>
        <p>
        Mr. Lorry reddened, and said, warmly, "You have mentioned that before,
        sir. We men of business, who serve a House, are not our own masters. We
        have to think of the House more than ourselves."
        </p>
        <p>

        "<i>I</i> know, <i>I</i> know," rejoined Mr. Carton, carelessly. "Don't be
        nettled, Mr. Lorry. You are as good as another, I have no doubt: better,
        I dare say."
        </p>
        <p>
        "And indeed, sir," pursued Mr. Lorry, not minding him, "I really don't
        know what you have to do with the matter. If you'll excuse me, as very
        much your elder, for saying so, I really don't know that it is your
        business."
        </p>
        <p>
        "Business! Bless you, <i>I</i> have no business," said Mr. Carton.
        </p>

        <p>
        "It is a pity you have not, sir."
        </p>
        <p>
        "I think so, too."
        </p>
        <p>
        "If you had," pursued Mr. Lorry, "perhaps you would attend to it."
        </p>
        <p>
        "Lord love you, no!&mdash;I shouldn't," said Mr. Carton.
        </p>
        <p>
        "Well, sir!" cried Mr. Lorry, thoroughly heated by his indifference,
        "business is a very good thing, and a very respectable thing. And, sir,
        if business imposes its restraints and its silences and impediments, Mr.
        Darnay as a young gentleman of generosity knows how to make allowance
        for that circumstance. Mr. Darnay, good night, God bless you, sir!
        I hope you have been this day preserved for a prosperous and happy
        life.&mdash;Chair there!"
        </p>

        <p>
        Perhaps a little angry with himself, as well as with the barrister, Mr.
        Lorry bustled into the chair, and was carried off to Tellson's. Carton,
        who smelt of port wine, and did not appear to be quite sober, laughed
        then, and turned to Darnay:
        </p>
        <p>
        "This is a strange chance that throws you and me together. This must
        be a strange night to you, standing alone here with your counterpart on
        these street stones?"
        </p>
        <p>
        "I hardly seem yet," returned Charles Darnay, "to belong to this world
        again."
        </p>
        <p>
        "I don't wonder at it; it's not so long since you were pretty far
        advanced on your way to another. You speak faintly."
        </p>
        <p>
        "I begin to think I <i>am</i> faint."

        </p>
        <p>
        "Then why the devil don't you dine? I dined, myself, while those
        numskulls were deliberating which world you should belong to&mdash;this, or
        some other. Let me show you the nearest tavern to dine well at."
        </p>
        <p>
        Drawing his arm through his own, he took him down Ludgate-hill to
        Fleet-street, and so, up a covered way, into a tavern. Here, they were
        shown into a little room, where Charles Darnay was soon recruiting
        his strength with a good plain dinner and good wine: while Carton sat
        opposite to him at the same table, with his separate bottle of port
        before him, and his fully half-insolent manner upon him.
        </p>
        <p>
        "Do you feel, yet, that you belong to this terrestrial scheme again, Mr.
        Darnay?"
        </p>
        <p>
        "I am frightfully confused regarding time and place; but I am so far
        mended as to feel that."
        </p>
        <p>
        "It must be an immense satisfaction!"
        </p>

        <p>
        He said it bitterly, and filled up his glass again: which was a large
        one.
        </p>
        <p>
        "As to me, the greatest desire I have, is to forget that I belong to it.
        It has no good in it for me&mdash;except wine like this&mdash;nor I for it. So we
        are not much alike in that particular. Indeed, I begin to think we are
        not much alike in any particular, you and I."
        </p>
        <p>
        Confused by the emotion of the day, and feeling his being there with
        this Double of coarse deportment, to be like a dream, Charles Darnay was
        at a loss how to answer; finally, answered not at all.
        </p>
        <p>
        "Now your dinner is done," Carton presently said, "why don't you call a
        health, Mr. Darnay; why don't you give your toast?"
        </p>
        <p>
        "What health? What toast?"

        </p>
        <p>
        "Why, it's on the tip of your tongue. It ought to be, it must be, I'll
        swear it's there."
        </p>
        <p>
        "Miss Manette, then!"
        </p>
        <p>
        "Miss Manette, then!"
        </p>
        <p>
        Looking his companion full in the face while he drank the toast, Carton
        flung his glass over his shoulder against the wall, where it shivered to
        pieces; then, rang the bell, and ordered in another.
        </p>
        <p>
        "That's a fair young lady to hand to a coach in the dark, Mr. Darnay!"
        he said, ruing his new goblet.
        </p>
        <p>

        A slight frown and a laconic "Yes," were the answer.
        </p>
        <p>
        "That's a fair young lady to be pitied by and wept for by! How does it
        feel? Is it worth being tried for one's life, to be the object of such
        sympathy and compassion, Mr. Darnay?"
        </p>
        <p>
        Again Darnay answered not a word.
        </p>
        <p>
        "She was mightily pleased to have your message, when I gave it her. Not
        that she showed she was pleased, but I suppose she was."
        </p>
        <p>
        The allusion served as a timely reminder to Darnay that this
        disagreeable companion had, of his own free will, assisted him in the
        strait of the day. He turned the dialogue to that point, and thanked him
        for it.
        </p>
        <p>
        "I neither want any thanks, nor merit any," was the careless rejoinder.
        "It was nothing to do, in the first place; and I don't know why I did
        it, in the second. Mr. Darnay, let me ask you a question."
        </p>

        <p>
        "Willingly, and a small return for your good offices."
        </p>
        <p>
        "Do you think I particularly like you?"
        </p>
        <p>
        "Really, Mr. Carton," returned the other, oddly disconcerted, "I have
        not asked myself the question."
        </p>
        <p>
        "But ask yourself the question now."
        </p>
        <p>
        "You have acted as if you do; but I don't think you do."
        </p>
        <p>
        "<i>I</i> don't think I do," said Carton. "I begin to have a very good
        opinion of your understanding."

        </p>
        <p>
        "Nevertheless," pursued Darnay, rising to ring the bell, "there is
        nothing in that, I hope, to prevent my calling the reckoning, and our
        parting without ill-blood on either side."
        </p>
        <p>
        Carton rejoining, "Nothing in life!" Darnay rang. "Do you call the whole
        reckoning?" said Carton. On his answering in the affirmative, "Then
        bring me another pint of this same wine, drawer, and come and wake me at
        ten."
        </p>
        <p>
        The bill being paid, Charles Darnay rose and wished him good night.
        Without returning the wish, Carton rose too, with something of a threat
        of defiance in his manner, and said, "A last word, Mr. Darnay: you think
        I am drunk?"
        </p>
        <p>
        "I think you have been drinking, Mr. Carton."
        </p>
        <p>
        "Think? You know I have been drinking."
        </p>
        <p>

        "Since I must say so, I know it."
        </p>
        <p>
        "Then you shall likewise know why. I am a disappointed drudge, sir. I
        care for no man on earth, and no man on earth cares for me."
        </p>
        <p>
        "Much to be regretted. You might have used your talents better."
        </p>
        <p>
        "May be so, Mr. Darnay; may be not. Don't let your sober face elate you,
        however; you don't know what it may come to. Good night!"
        </p>
        <p>
        When he was left alone, this strange being took up a candle, went to a
        glass that hung against the wall, and surveyed himself minutely in it.
        </p>
        <p>
        "Do you particularly like the man?" he muttered, at his own image; "why
        should you particularly like a man who resembles you? There is nothing
        in you to like; you know that. Ah, confound you! What a change you have
        made in yourself! A good reason for taking to a man, that he shows you
        what you have fallen away from, and what you might have been! Change
        places with him, and would you have been looked at by those blue eyes as
        he was, and commiserated by that agitated face as he was? Come on, and
        have it out in plain words! You hate the fellow."
        </p>

        <p>
        He resorted to his pint of wine for consolation, drank it all in a few
        minutes, and fell asleep on his arms, with his hair straggling over the
        table, and a long winding-sheet in the candle dripping down upon him.
        </p>

      </div>
    </div>

  </body>



</html>
