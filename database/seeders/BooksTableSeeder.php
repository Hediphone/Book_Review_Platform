<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BooksTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('books')->insert([
            [
                'title' => 'The Hunger Games',
                'author' => 'Suzanne Collins',
                'genre' => 'Action, Sci-fi, Fantasy',
                'description' => 'Could you survive on your own in the wild, with every one out to make sure you don\'t live to see the morning? In the ruins of a place once known as North America lies the nation of Panem, a shining Capitol surrounded by twelve outlying districts. The Capitol is harsh and cruel and keeps the districts in line by forcing them all to send one boy and one girl between the ages of twelve and eighteen to participate in the annual Hunger Games, a fight to the death on live TV. Sixteen-year-old Katniss Everdeen, who lives alone with her mother and younger sister, regards it as a death sentence when she steps forward to take her sister\'s place in the Games. But Katniss has been close to dead before—and survival, for her, is second nature. Without really meaning to, she becomes a contender. But if she is to win, she will have to start making choices that weight survival against humanity and life against love.',
                'cover' => 'assets\\covers\\The Hunger Games.jpg',
                'created_at' => now(),
                'updated_at' => now(),
                'release_date' => NULL,
            ],
            [
                'title' => 'Catching Fire',
                'author' => 'Suzanne Collins',
                'genre' => 'Action, Sci-fi, Fantasy, Romance',
                'description' => 'Sparks are igniting. Flames are spreading. And the Capitol wants revenge. Against all odds, Katniss Everdeen has won the Hunger Games. She and fellow District 12 tribute Peeta Mellark are miraculously still alive. Katniss should be relieved, happy even. After all, she has returned to her family and her longtime friend, Gale. Yet nothing is the way Katniss wishes it to be. Gale holds her at an icy distance. Peeta has turned his back on her completely. And there are whispers of a rebellion against the Capitol—a rebellion that Katniss and Peeta may have helped create. Much to her shock, Katniss has fueled an unrest that she\'s afraid she cannot stop. And what scares her even more is that she\'s not entirely convinced she should try. As time draws near for Katniss and Peeta to visit the districts on the Capitol\'s cruel Victory Tour, the stakes are higher than ever. If they can\'t prove, without a shadow of a doubt, that they are lost in their love for each other, the consequences will be horrifying.',
                'cover' => 'assets\\covers\\Catching Fire.jpg',
                'created_at' => now(),
                'updated_at' => now(),
                'release_date' => NULL,
            ],
            [
                'title' => 'Mockingjay',
                'author' => 'Suzanne Collins',
                'genre' => 'Action, Sci-fi, Fantasy, Adventure, Fiction, Romance',
                'description' => 'My name is Katniss Everdeen. Why am I not dead? I should be dead. Katniss Everdeen, girl on fire, has survived, even though her home has been destroyed. Gale has escaped. Katniss\'s family is safe. Peeta has been captured by the Capitol. District 13 really does exist. There are rebels. There are new leaders. A revolution is unfolding. It is by design that Katniss was rescued from the arena in the cruel and haunting Quarter Quell, and it is by design that she has long been part of the revolution without knowing it. District 13 has come out of the shadows and is plotting to overthrow the Capitol. Everyone, it seems, has had a hand in the carefully laid plans—except Katniss. The success of the rebellion hinges on Katniss\'s willingness to be a pawn, to accept responsibility for countless lives, and to change the course of the future of Panem. To do this, she must put aside her feelings of anger and distrust. She must become the rebels\' Mockingjay—no matter what the personal cost.',
                'cover' => 'assets\\covers\\Mockingjay.jpg',
                'created_at' => now(),
                'updated_at' => now(),
                'release_date' => NULL,
            ],
            [
                'title' => 'Divergent',
                'author' => 'Veronica Roth',
                'genre' => 'Action, Fiction, Fantasy, Sci-Fi, Romance',
                'description' => 'In Beatrice Prior\'s dystopian Chicago world, society is divided into five factions, each dedicated to the cultivation of a particular virtue—Candor (the honest), Abnegation (the selfless), Dauntless (the brave), Amity (the peaceful), and Erudite (the intelligent). On an appointed day of every year, all sixteen-year-olds must select the faction to which they will devote the rest of their lives. For Beatrice, the decision is between staying with her family and being who she really is—she can\'t have both. So she makes a choice that surprises everyone, including herself. During the highly competitive initiation that follows, Beatrice renames herself Tris and struggles alongside her fellow initiates to live out the choice they have made. Together they must undergo extreme physical tests of endurance and intense psychological simulations, some with devastating consequences. As initiation transforms them all, Tris must determine who her friends really are—and where, exactly, a romance with a sometimes fascinating, sometimes exasperating boy fits into the life she\'s chosen. But Tris also has a secret, one she\'s kept hidden from everyone because she\'s been warned it can mean death. And as she discovers unrest and growing conflict that threaten to unravel her seemingly perfect society, she also learns that her secret might help her save those she loves . . . or it might destroy her.',
                'cover' => 'assets\\covers\\Divergent.jpg',
                'created_at' => now(),
                'updated_at' => now(),
                'release_date' => NULL,
            ],
            // Continue inserting for all other books in a similar way.
        ]);
    }
}
