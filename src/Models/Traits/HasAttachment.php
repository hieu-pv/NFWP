<?php

namespace NFWP\Models\Traits;

trait HasAttachment
{
    public $defaultImage = '';
    
    public function thumbnail()
    {
        return $this->belongsToMany(self::class, NFWP_DB_TABLE_PREFIX . 'postmeta', 'post_id', 'meta_value')->wherePivot('meta_key', '_thumbnail_id');
    }
    public function getThumbnail()
    {
        return $this->thumbnail->first()->guid ? $this->thumbnail->first()->guid : $this->defaultImage;
    }
    public function getThePostThumbnail($size = 'thumbnail', $attr = '')
    {
        if ($this->thumbnail->first()->guid) {
            return get_the_post_thumbnail(new WP_Post((object) $this->getAttributes()), $size, $attr);
        } else {
            return "<img src=\"{$this->defaultImage}\" class=\"nf-default-thumbnail\"/>";
        }
    }
}
