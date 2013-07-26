<?php

use Robbo\Presenter\PresentableInterface;

class Type extends Eloquent implements  PresentableInterface {
   








	public function getPresenter()
    {
        return new TypePresenter($this);
    }
}