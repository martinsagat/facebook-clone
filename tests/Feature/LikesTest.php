<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Models\User;
use App\Models\Post;

class LikesTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_user_can_like_a_post()
    {
        $this->withoutExceptionHandling();
        $this->actingAs($user = User::factory()->create(), 'api');
        $post = Post::factory()->create(['id' => 123]);

        $response = $this->post('/api/posts/'.$post->id.'/like')
            ->assertStatus(200);
        
        $this->assertCount(1, $user->likedPosts);
        $response->assertJson([
            'data' => [
                [
                    'data' => [
                        'type' => 'likes',
                        'like_id' => 1,
                        'attributes' => [],
                    ],
                    'links' => [
                        'self' => url('/posts/123'),
                    ]
                ]
            ],
            'links' => [
                'self' => url('/posts'),
            ]

        ]);
    }

    /** @test */
    public function posts_are_returned_with_likes()
    {
        $this->withoutExceptionHandling();
        $this->actingAs($user = User::factory()->create(), 'api');
        $post = Post::factory()->create(['id' => 123, 'user_id' => $user->id]);

        $response = $this->post('/api/posts/'.$post->id.'/like')
            ->assertStatus(200);
        
        
        $response = $this->get('/api/posts')
            ->assertStatus(200)
            ->assertJson([
                'data' => [
                    [
                        'data' => [
                            'type' => 'posts',
                            'attributes' => [
                                
                                'likes' => [
                                    'data' => [
                                        [
                                            'data' => [
                                                'type' => 'likes',
                                                'like_id' => 1,
                                                'attributes' => []
                                            ]
                                        ]
                                    ],
                                    'like_count' => 1,
                                    'user_likes_post' => true,
                                ]
                            ]
                        ]
                    ]
                ]
            ]);
    }
}
