<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Ward;

class WardComposer
{
    
    public function __construct()
    {
        $this->ward = Ward::all();
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('wards', $this->ward);
    }
}