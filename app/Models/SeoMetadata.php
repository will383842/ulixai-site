<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SeoMetadata extends Model
{
    protected $table = 'seo_metadata';

    protected $fillable = [
        'url', 'locale', 'page_type', 'title', 'description',
        'keywords', 'og_title', 'og_description', 'og_image', 'og_type',
        'twitter_card', 'twitter_site', 'twitter_creator', 'canonical_url',
    ];
}
