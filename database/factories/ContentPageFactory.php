<?php

namespace Database\Factories;

use App\Models\ContentPage;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ContentPageFactory extends Factory
{
    protected $model = ContentPage::class;

    private array $pages = [
        'About Us' => 'Learn about our company history, mission, and the team behind our products.',
        'Contact Us' => 'Get in touch with our team for questions, support, or wholesale inquiries.',
        'Privacy Policy' => 'Our commitment to protecting your personal information and data.',
        'Terms of Service' => 'The terms and conditions governing use of our website and services.',
        'Shipping Information' => 'Everything you need to know about our shipping policies and delivery times.',
        'Return Policy' => 'Our hassle-free return and exchange policy for your peace of mind.',
        'Wholesale Program' => 'Information about our wholesale program for qualified businesses.',
        'How to Order' => 'Step-by-step guide to placing orders on our website.',
    ];

    public function definition(): array
    {
        $title = $this->faker->unique()->randomElement(array_keys($this->pages));
        
        return [
            'title' => $title,
            'slug' => Str::slug($title),
            'excerpt' => $this->pages[$title],
            'page_text' => '<p>' . $this->pages[$title] . '</p><p>' . $this->faker->paragraphs(3, true) . '</p>',
            'page_type' => 'page',
            'published' => true,
            'is_fake' => true,
        ];
    }
}
