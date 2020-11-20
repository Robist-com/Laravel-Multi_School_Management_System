<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DesignCertificates extends Model
{
    protected $table = 'design_certificates';
    protected $fillable = [
    "_token",
    'certificate_to',
    "certificate_type",
    "certificate_frame_width",
    "certificate_frame_height",
    "certificate_frame_margin",
    "certificate_frame_padding",
    "certificate_frame_box_shodow",
    "certificate_frame_border_radius",
    "certificate_frame_overflow",
    "certificate_frame_border_width",
    "certificate_frame_border_color",
    "certificate_frame_border_style",
    "certificate_frame_border",
    "certificate_frame_float",
    "certificate_frame_white_space",
    "certificate_frame_list_style_type",
    "certificate_framelist_style_image",
    "certificate_background_image",
    "certificate_background_width",
    "certificate_background_height",
    "certificate_background_size",
    "certificate_background_repeat",
    "certificate_background_margin",
    "certificate_background_padding",
    "certificate_background_opacity",
    "certificate_background_box_shodow",
    "certificate_background_border_radius",
    "certificate_background_overflow",
    "school_id",
    "created_at",
    "updated_at"];
}
