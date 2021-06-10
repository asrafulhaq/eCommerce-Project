<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    /**
     * Get Slug Name
     */
    protected function getSlug($slug_data){
        return str_replace(' ', '-', $slug_data);
    }


    /**
     * Embeded youtube and vimeo link
     */
    protected function getEmbed($link){

        if (str_contains($link, 'youtube')) {


            return str_replace('watch?v=', 'embed/', $link);
        } else if (str_contains($link, 'vimeo')) {
            return str_replace('vimeo.com', 'player.vimeo.com/video', $link);
        }else {
            return 'invalid video link' ;
        }

    }


}
