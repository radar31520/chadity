<?php

use Robbo\Presenter\PresentableInterface;

class Ad extends Eloquent implements PresentableInterface {

	public function advertiser()
    {
        return $this->hasOne('Advertiser');
    }

    public function type()
    {
        return $this->hasOne('Type');
    }


	public function getPresenter()
    {
        return new AdPresenter($this);
    }

}