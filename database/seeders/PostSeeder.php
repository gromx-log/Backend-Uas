<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class PostSeeder extends Seeder
{
    //Seeder khusus untuk 
    public function run(): void
    {
        $faker = Faker::create();
        
        // Get all user IDs
        $userIds = DB::table('users')->pluck('userId')->toArray();
        
        if (empty($userIds)) {
            $this->command->warn('No users found. Please run UserSeeder first.');
            return;
        }
        
        // Sample tweet. Bisa diubah
        $allTweets = [
            "Mata kuliah Back End Programming hari ini SERU BANGET!!! Menyala PHP.",
            "When will you make another album, Mr Frank Ocean??? :(",
            "And I'm back on my GRIND!",
            "I think, Life, is the friends we made along the way",
            "Apakah ada yang bisa bantu saya di Back End?",
            "I am a person who has become unfamiliar with the art of love, someone who has caught a glimpse of the very summit of human intellect." , 
            "Hiduplah seperti manusia, be human",
            "We forget about spilled wine, but the stain will not be gone",
            "Kenapa bola basket ga boleh basah? karena harus dilempar ke-ring xixixixixixi",
            "97-Year-Old NYC Diner Still Serves Their Coke the Old Fashioned Way",
            "I have conceived an idea most ingenius, sancho",
            "My love for you is bulletproof, but you're the one who shot me",
            "Kenapa Why Selalu Always",
            "Karena Because Tidak Pernah Never",
        ];
        
        // Bikin 20 post
        $createdPosts = [];
        for ($i = 0; $i < 200; $i++) {
            $userId = $faker->randomElement($userIds);
            $content = $faker->randomElement($allTweets);
            
            // Untuk modify sedikit konten
            // Jadi ada kemungkinan untuk punya isi lebih panjang
            if ($faker->boolean(30)) {
                $content = $faker->sentence(rand(5, 15));
                if (strlen($content) > 280) {
                    $content = substr($content, 0, 277) . '...';
                }
            }
            
            $postId = DB::table('posts')->insertGetId([
                'userId' => $userId,
                'content' => $content,
                'likeCount' => $faker->numberBetween(0, 500),
                'repostCount' => $faker->numberBetween(0, 100),
                'bookmarkCount' => $faker->numberBetween(0, 150),
                'replyCount' => $faker->numberBetween(0, 50),
                'created_at' => $faker->dateTimeBetween('-6 months', 'now'),
                'parent_post_id' => null, // Main posts have no parent
            ]);
            
            $createdPosts[] = $postId;
        }
        
        // Seeder untuk replies
        // Replies akan muncul untuk 30% dari post yang dibuat
        foreach ($createdPosts as $postId) {
            if ($faker->boolean(30)) { // 30% chance of having replies
                $numReplies = $faker->numberBetween(1, 3);
                
                for ($j = 0; $j < $numReplies; $j++) {
                    $replyUserId = $faker->randomElement($userIds);
                    
                    $replyTemplates = [
                        "Great point! I totally agree with this",
                        "REALLLL!!!!!",
                        "Kamu menjatuhkan mahkotamu, KING",
                        "Love this!",
                        "So true! Relatable banget",
                        "No CAP, FRRR!",
                        "This made my day! Thank you",
                        "Exactly what I needed to hear today",
                        "This is gold!"
                    ];
                    
                    $replyContent = $faker->randomElement($replyTemplates);
                    
                    // Sometimes add a longer reply
                    if ($faker->boolean(40)) {
                        $replyContent = $faker->sentence(rand(8, 20));
                        if (strlen($replyContent) > 280) {
                            $replyContent = substr($replyContent, 0, 277) . '...';
                        }
                    }
                    
                    DB::table('posts')->insert([
                        'userId' => $replyUserId,
                        'content' => $replyContent,
                        'likeCount' => $faker->numberBetween(0, 100),
                        'repostCount' => $faker->numberBetween(0, 20),
                        'bookmarkCount' => $faker->numberBetween(0, 30),
                        'replyCount' => 0, // Replies don't have replies in this seeder
                        'created_at' => $faker->dateTimeBetween('-6 months', 'now'),
                        'parent_post_id' => $postId,
                    ]);
                }
            }
        }
        
        $this->command->info('Created ' . count($createdPosts) . ' main posts with replies');
    }
}