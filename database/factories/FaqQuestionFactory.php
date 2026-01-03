<?php

namespace Database\Factories;

use App\Models\FaqQuestion;
use Illuminate\Database\Eloquent\Factories\Factory;

class FaqQuestionFactory extends Factory
{
    protected $model = FaqQuestion::class;

    private array $questions = [
        'How do I place an order?' => 'You can place an order through our website by browsing our catalog, adding items to your cart, and proceeding to checkout. For wholesale orders, please contact our sales team.',
        'What are your shipping rates?' => 'Shipping rates vary based on order size and destination. We offer free shipping on orders over $500. Contact us for a custom quote on large orders.',
        'How long does delivery take?' => 'Standard delivery takes 3-5 business days. Express shipping is available for an additional fee with 1-2 day delivery.',
        'Can I return items?' => 'Yes, we accept returns within 30 days of purchase for unused items in original packaging. Please contact customer service to initiate a return.',
        'Do you offer wholesale pricing?' => 'Yes! We offer competitive wholesale pricing for qualified businesses. Please apply for a wholesale account to access special pricing.',
        'How do I track my order?' => 'Once your order ships, you will receive a tracking number via email. You can also track orders in your account dashboard.',
        'What payment methods do you accept?' => 'We accept all major credit cards, PayPal, and offer NET 30 terms for approved wholesale accounts.',
        'Do you ship internationally?' => 'Currently we only ship within the United States. International shipping may be available for large orders - please contact us.',
        'How do I create an account?' => 'Click the "Register" button in the top right corner and fill out the registration form. Wholesale customers will need to provide business documentation.',
        'What if my order arrives damaged?' => 'Please contact us within 48 hours of delivery with photos of the damage. We will arrange a replacement or refund.',
    ];

    public function definition(): array
    {
        $question = $this->faker->randomElement(array_keys($this->questions));
        
        return [
            'question' => $question,
            'answer' => $this->questions[$question],
            'published' => true,
            'is_fake' => true,
        ];
    }
}
