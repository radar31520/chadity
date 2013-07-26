<?php

use Robbo\Presenter\PresentableInterface;

class Advertiser extends Eloquent implements PresentableInterface {














	public function getPresenter()
    {
        return new AdvertiserPresenter($this);
    }

}