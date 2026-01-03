<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class PageSection extends Model implements HasMedia
{
    use SoftDeletes, InteractsWithMedia;

    public $table = 'page_sections';

    protected $fillable = [
        'content_page_id',
        'section_type',
        'title',
        'subtitle',
        'content',
        'button_text',
        'button_url',
        'button_style',
        'background_color',
        'background_image',
        'text_color',
        'alignment',
        'container_width',
        'padding',
        'settings',
        'sort_order',
        'published',
    ];

    protected $casts = [
        'settings' => 'array',
        'published' => 'boolean',
    ];

    public function contentPage()
    {
        return $this->belongsTo(ContentPage::class);
    }

    public function registerMediaConversions(\Spatie\MediaLibrary\MediaCollections\Models\Media $media = null): void
    {
        $this->addMediaConversion('thumb')->fit('crop', 150, 150);
        $this->addMediaConversion('preview')->fit('crop', 400, 300);
    }

    public const SECTION_TYPES = [
        'hero' => [
            'label' => 'Hero Banner',
            'icon' => 'fas fa-image',
            'description' => 'Large banner with title, subtitle, and call-to-action',
        ],
        'text' => [
            'label' => 'Text Content',
            'icon' => 'fas fa-align-left',
            'description' => 'Rich text content block',
        ],
        'text_image' => [
            'label' => 'Text + Image (Left)',
            'icon' => 'fas fa-columns',
            'description' => 'Text on left, image on right',
        ],
        'image_text' => [
            'label' => 'Image + Text (Right)',
            'icon' => 'fas fa-columns',
            'description' => 'Image on left, text on right',
        ],
        'gallery' => [
            'label' => 'Image Gallery',
            'icon' => 'fas fa-th',
            'description' => 'Grid of images with lightbox',
        ],
        'cta' => [
            'label' => 'Call to Action',
            'icon' => 'fas fa-bullhorn',
            'description' => 'Highlighted call-to-action section',
        ],
        'features' => [
            'label' => 'Features/Icons',
            'icon' => 'fas fa-th-large',
            'description' => 'Grid of feature boxes with icons',
        ],
        'testimonials' => [
            'label' => 'Testimonials',
            'icon' => 'fas fa-quote-right',
            'description' => 'Customer testimonials carousel',
        ],
        'faq' => [
            'label' => 'FAQ Accordion',
            'icon' => 'fas fa-question-circle',
            'description' => 'Frequently asked questions',
        ],
        'products' => [
            'label' => 'Product Showcase',
            'icon' => 'fas fa-shopping-bag',
            'description' => 'Display selected products',
        ],
        'categories' => [
            'label' => 'Category Showcase',
            'icon' => 'fas fa-folder',
            'description' => 'Display product categories',
        ],
        'contact' => [
            'label' => 'Contact Info',
            'icon' => 'fas fa-envelope',
            'description' => 'Contact information block',
        ],
        'video' => [
            'label' => 'Video Embed',
            'icon' => 'fas fa-video',
            'description' => 'Embedded video (YouTube/Vimeo)',
        ],
        'spacer' => [
            'label' => 'Spacer',
            'icon' => 'fas fa-arrows-alt-v',
            'description' => 'Empty space between sections',
        ],
        'divider' => [
            'label' => 'Divider Line',
            'icon' => 'fas fa-minus',
            'description' => 'Horizontal divider line',
        ],
    ];

    public const BUTTON_STYLES = [
        'primary' => 'Primary (Green)',
        'secondary' => 'Secondary (Dark)',
        'outline-primary' => 'Outline Primary',
        'outline-secondary' => 'Outline Secondary',
        'light' => 'Light',
        'link' => 'Link Style',
    ];

    public const ALIGNMENTS = [
        'left' => 'Left',
        'center' => 'Center',
        'right' => 'Right',
    ];

    public const CONTAINER_WIDTHS = [
        'container' => 'Standard Container',
        'container-fluid' => 'Full Width Container',
        'container-lg' => 'Large Container',
        'full' => 'Full Width (No Container)',
    ];

    public const PADDINGS = [
        'none' => 'No Padding',
        'small' => 'Small (py-3)',
        'normal' => 'Normal (py-5)',
        'large' => 'Large (content-inner)',
    ];
}
