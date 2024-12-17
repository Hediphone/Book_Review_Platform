<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BooksController extends Controller
{
    public function loadBooks()
    {
        $posts = [
            [
                'book_id' => 1,
                'title' => "Omniscient Reader's Viewpoint",
                'author' => 'Sing Shong',
                'rating' => 4.5,
                'cover' => 'asset/images/orv.jpg',
                'description' => "Only I know the end of this world.One day our MC finds himself stuck in the world of his favorite webnovel. What does he do to survive? It is a world struck by catastrophe and danger all around.\nHis edge? He knows the plot of the story to the end. Because he was the sole reader that stuck with it. Read his story to see how he survives!",
                'num_ratings' => 121212,
                'num_reviews' => 20212,
                'genres' => ['Fantasy', 'Manga', 'Light Novel', 'Science Fiction', 'Manhwa', 'Fiction'],
                'comments' => [
                    ['reader' => 'Renato Jr.', 
                    'text' => 'An incredible read! So many twists and unforgettable moments!', 
                    'time' => '1 day ago']
                ]
            ],
            [
                'book_id' => 2,
                'title' => 'Lord of the Mysteries',
                'author' => 'Yuan Ye',
                'rating' => 4,
                'cover' => 'asset/images/lotm.jpg',
                'description' => "Waking up to be faced with a string of mysteries, Zhou Mingrui finds himself reincarnated as Klein Moretti in an alternate Victorian era world where he sees a world filled with machinery, cannons, dreadnoughts, airships, difference machines, as well as Potions, Divination, Hexes, Tarot Cards, Sealed Artifacts… The Light continues to shine but the mystery has never gone far. Follow Klein as he finds himself entangled with the Churches of the world—both orthodox and unorthodox—while he slowly develops newfound powers thanks to the Beyonder potions.",
                'num_ratings' => 121212,
                'num_reviews' => 20212,
                'genres' => ['Mystery','Fantasy', 'Light Novel', 'Steampunk', 'Fiction'],
                'comments' => [
                    ['reader' => 'Renato Jr.', 
                    'text' => 'A thrilling mystery that keeps you on the edge of your seat. Highly recommend!', 
                    'time' => '2 days ago']
                ]
            ],
            [
                'book_id' => 3,
                'title' => 'A Gentle Reminder',
                'author' => 'Bianca Sparacino',
                'rating' => 2,
                'cover' => 'asset/images/gentle-reminder.jpg',
                'description' => "A gentle reminder, for the days you feel light in this world, and for the days in which the sun rises a little slower. A gentle reminder for when your heart is full of hope, and for when you are learning how to heal it. A gentle reminder for when you finally begin to trust in the goodness, and for when you need the kind of words that hug your broken pieces back together. A gentle reminder for when growth hangs heavy in the air, for when you need to tuck your strength into your bones just to make it to tomorrow. A gentle reminder for when you are balancing the messiness, and the beauty, of what it means to be human, when you are teaching yourself that it is okay to be both happy and sad, that you are real, not perfect. A gentle reminder for when you seek the words you needed when you were younger. A gentle reminder for when you need to hear that you deserve to be loved the way you love others. ",
                'num_ratings' => 121212,
                'num_reviews' => 20212,
                'genres' => ['Poetry','Self-Help', 'Non-Fiction', 'Love'],
                'comments' => [
                    ['reader' => 'Renato Jr.', 
                    'text' => 'It\'s a beautiful book with gentle life lessons. Very thought-provoking.', 
                    'time' => '2 days ago']
                ]
            ],
            [
                'book_id' => 4,
                'title' => 'Pride and Prejudice',
                'author' => 'Jane Austen',
                'rating' => 3,
                'cover' => 'asset/images/pride-prejudice.jpg',
                'description' => "Since its immediate success in 1813, Pride and Prejudice has remained one of the most popular novels in the English language. Jane Austen called this brilliant work her own darling child and its vivacious heroine, Elizabeth Bennet, as delightful a creature as ever appeared in print. The romantic clash between the opinionated Elizabeth and her proud beau, Mr. Darcy, is a splendid performance of civilized sparring. And Jane Austen's radiant wit sparkles as her characters dance a delicate quadrille of flirtation and intrigue, making this book the most superb comedy of manners of Regency England.",
                'num_ratings' => 121212,
                'num_reviews' => 20212,
                'genres' => ['Historical Fiction','AudioBook', 'Novel', 'Love'],
                'comments' => [
                    ['reader' => 'Renato Jr.', 
                    'text' => 'A classic with timeless romance and witty characters. A must-read!', 
                    'time' => '3 days ago']
                ]
            ],
            [
                'book_id' => 5,
                'title' => 'First Lie Wins',
                'author' => 'Ashley Elston',
                'rating' => 4,
                'cover' => 'asset/images/first-lie-wins.jpg',
                'description' => "Evie Porter has everything a nice, Southern girl could want: a perfect, doting boyfriend, a house with a white picket fence and a garden, a fancy group of friends. The only catch: Evie Porter doesn’t exist. The identity comes first: Evie Porter. Once she’s given a name and location by her mysterious boss Mr. Smith, she learns everything there is to know about the town and the people in it. Then the mark: Ryan Sumner. The last piece of the puzzle is the job. Evie isn’t privy to Mr. Smith’s real identity, but she knows this job will be different. Ryan has gotten under her skin, and she’s starting to envision a different sort of life for herself. But Evie can’t make any mistakes—especially after what happened last time.", 
                'num_ratings' => 121212,
                'num_reviews' => 20212,
                'genres' => ['Thriller','Mystery', 'Suspense', 'Adult'],
                'comments' => [
                    ['reader' => 'Renato Jr.', 
                    'text' => 'A fast-paced, exciting thriller. Great book!', 
                    'time' => '5 days ago']
                ]
            ],
            [
                'book_id' => 6,
                'title' => 'Funny Story',
                'author' => 'Emily Henry',
                'rating' => 4,
                'cover' => 'asset/images/funny-story.jpg',
                'description' => "A shimmering, joyful new novel about a pair of opposites with the wrong thing in common. Daphne always loved the way her fiancé Peter told their story. How they met (on a blustery day), fell in love (over an errant hat), and moved back to his lakeside hometown to begin their life together. He really was good at telling it…right up until the moment he realized he was actually in love with his childhood best friend Petra. Which is how Daphne begins her new story: Stranded in beautiful Waning Bay, Michigan, without friends or family but with a dream job as a children’s librarian (that barely pays the bills), and proposing to be roommates with the only person who could possibly understand her predicament: Petra’s ex, Miles Nowak.",  'num_ratings' => 121212,
                'num_reviews' => 20212,
                'genres' => ['Romance','Fiction', 'Contemporary', 'Adult'],
                'comments' => [
                    ['reader' => 'Renato Jr.', 
                    'text' => 'Great book! It\'s light and fun.', 
                    'time' => '5 days ago']
                ]
            ],
            [
                'book_id' => 7,
                'title' => 'The Women',
                'author' => 'Kristin Hannah',
                'rating' => 2,
                'cover' => 'asset/images/the-women.jpg',
                'description' => "Women can be heroes. When twenty-year-old nursing student Frances “Frankie” McGrath hears these words, it is a revelation. Raised in the sun-drenched, idyllic world of Southern California and sheltered by her conservative parents, she has always prided herself on doing the right thing. But in 1965, the world is changing, and she suddenly dares to imagine a different future for herself. When her brother ships out to serve in Vietnam, she joins the Army Nurse Corps and follows his path. As green and inexperienced as the men sent to Vietnam to fight, Frankie is over- whelmed by the chaos and destruction of war. Each day is a gamble of life and death, hope and betrayal; friendships run deep and can be shattered in an instant. In war, she meets—and becomes one of—the lucky, the brave, the broken, and the lost." ,
                'num_ratings' => 121212,
                'num_reviews' => 20212,
                'genres' => ['Historical Fiction','AudioBook', 'War', 'Historical'],
                'comments' => [
                    ['reader' => 'Renato Jr.', 
                    'text' => 'A heartfelt drama. The story really stays with you after finishing it', 
                    'time' => '7 days ago']
                ]
            ],
            [
                'book_id' => 8,
                'title' => 'The Teacher',
                'author' => 'Freida McFadden',
                'rating' => 5,
                'cover' => 'asset/images/the-teacher.jpg',
                'description' => "From the New York Times bestselling author Freida McFadden comes a chilling story of twisted secrets and long-awaited revenge. Lesson #1: Trust no one. Eve has a good life. She wakes up each day, kisses her husband Nate, and heads off to teach math at the local high school. All is as it should be. Except… Last year, Caseham High was rocked by a scandal involving a student-teacher affair, with one student, Addie, at its center. But Eve knows there is far more to these ugly rumors than meets the eye.",
                'num_ratings' => 121212,
                'num_reviews' => 20212,
                'genres' => ['Thriller','Mystery', 'Suspense', 'Adult'],
                'comments' => [
                    ['reader' => 'Renato Jr.', 
                    'text' => 'I loved this mystery! It\'s suspenseful and keeps you guessing.', 
                    'time' => '7 days ago']
                ]
            ],
            [
                'book_id' => 9,
                'title' => 'The Cruel Prince',
                'author' => 'Holly Black',
                'rating' => 3,
                'cover' => 'asset/images/dashboard/cruel_prince.png',
                'description' => "Jude was seven when her parents were murdered and she and her two sisters were stolen away to live in the treacherous High Court of Faerie. Ten years later, Jude wants nothing more than to belong there, despite her mortality. But many of the fey despise humans. Especially Prince Cardan, the youngest and wickedest son of the High King. To win a place at the Court, she must defy him–and face the consequences. As Jude becomes more deeply embroiled in palace intrigues and deceptions, she discovers her own capacity for trickery and bloodshed. But as betrayal threatens to drown the Courts of Faerie in violence, Jude will need to risk her life in a dangerous alliance to save her sisters, and Faerie itself.",
                'num_ratings' => 121212,
                'num_reviews' => 20212,
                'genres' => ['Young Adult','Mystery', 'Romance', 'Adult'],
                'comments' => [
                    ['reader' => 'Renato Jr.', 
                    'text' => 'A captivating fantasy! The world-building is amazing.', 
                    'time' => '2 weeks ago']
                ]
            ],
            [
                'book_id' => 10,
                'title' => 'Storm and Silence',
                'author' => 'Robert Thier',
                'rating' => 3,
                'cover' => 'asset/images/dashboard/storm_and_silence.png',
                'description' => "Freedom—that is what Lilly Linton wants most in life. Not marriage, not a brood of squalling brats, and certainly not love, thank you very much! But freedom is a rare commodity in 19th-century London, where girls are expected to spend their lives sitting at home, fully occupied with looking pretty. Lilly is at her wits’ end—until a chance encounter with a dark, dangerous and powerful stranger changes her life forever... Enter the world of Mr Rikkard Ambrose, where the only rule is: Knowledge is power is time is money!",
                'num_ratings' => 121212,
                'num_reviews' => 20212,
                'genres' => ['Romance','Historical', 'Fiction', 'Adult'],
                'comments' => [
                    ['reader' => 'Renato Jr.', 
                    'text' => 'A charming historical fiction with a strong heroine. Loved every moment.', 
                    'time' => '1 month ago']
                ]
            ],
            [
                'book_id' => 11,
                'title' => 'Waves of Memories',
                'author' => 'Jonaxx',
                'rating' => 3,
                'cover' => 'asset/images/dashboard/waves_of_memories.png',
                'description' => "Without her memories, Thraia Gabriella Fortunato doesn’t have a clue about her past. Kung paano siya dinala ng mga alon sa isang lugar na hindi pamilyar sa kanya ay lagpas sa kanyang pang-unawa. With only a stranger who says he is her husband, and friends who don’t have any clue of her past, too, she started to doubt everything. Paanong may napapanaginipan siyang ibang lalaki? At paanong halong pait at saya ang nararamdaman niya? And every time she looks at her husband’s eyes, the stanger, Ali marcadejas, she feels nothing but indifference-very opposite to the way the man of her dreams make her feel.", 'num_ratings' => 121212,
                'num_reviews' => 20212,
                'genres' => ['Romance','Mystery', 'Wattpad', 'Adult'],
                'comments' => [
                    ['reader' => 'Renato Jr.', 
                    'text' => 'A beautiful romance! It\'ll pull at your heartstrings.', 
                    'time' => '1 month ago']
                ]
            ],
            [
                'book_id' => 12,
                'title' => 'The Invisible Girl',
                'author' => 'Alexisse Rose',
                'rating' => 3,
                'cover' => 'asset/images/dashboard/invisible_girl.png',
                'description' => "Muriel was forced by her Boss to be her son's PRETEND GIRLFRIEND because of one reason- her VOICE. His Ex and her voice sounds very alike. Ang tanging konsolasyon lamang niya ay hindi siya nakikita ng binata. He will not recognize her. He lost his sight in a car accident after his Ex left him And her MISSION-  convince him to undergo the surgery.",
                'num_ratings' => 121212,
                'num_reviews' => 20212,
                'genres' => ['Romance','Mystery'],
                'comments' => [
                    ['reader' => 'Renato Jr.', 
                    'text' => 'A sweet romance with an intriguing plot. Loved it!', 
                    'time' => '2 months ago']
                ]
            ],
        ];
        return $posts;
    }



    

    public function show($id)
    {

        $posts = $this->loadBooks();

        $book = collect($posts)->firstWhere('book_id', $id);

        if (!$book) {
            abort(404); 
        }

        return view('book-details', compact('book'));


    }
}

