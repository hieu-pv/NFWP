<?php

namespace NFWP\Models\Traits;

trait HasAttachment
{
    public function thumbnail()
    {
        return $this->belongsToMany(self::class, NFWP_DB_TABLE_PREFIX . 'postmeta', 'post_id', 'meta_value')->wherePivot('meta_key', '_thumbnail_id');
    }
    public function getThumbnail()
    {
        return $this->thumbnail->first()->guid ? $this->thumbnail->first()->guid : $this->getDefaultAttachment();
    }
    public function getThePostThumbnail($size = 'thumbnail', $attr = '')
    {
        if ($this->thumbnail->first()->guid) {
            return get_the_post_thumbnail((object) $this->getAttributes(), $size, $attr);
        } else {
            return "<img src=\"{$this->getDefaultAttachment()}\" class=\"nf-default-thumbnail\"/>";
        }
    }
    public function getDefaultAttachment()
    {
        if ($this->defaultAttachment) {
            if (is_int($this->defaultAttachment)) {
                $this->findOrFail($this->defaultAttachment)->guid;
            } else {
                return $this->defaultAttachment;
            }
        } else {
            return '';
        }
    }
}
