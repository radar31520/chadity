<?php

use Robbo\Presenter\PresentableInterface;

class Interaction extends Eloquent implements PresentableInterface {

	public function user()
    {
        return $this->hasOne('User');
    }

    public function ad()
    {
        return $this->hasOne('Ad');
    }

    public function organization()
    {
        return $this->hasOne('Organization');
    }

	public function getPresenter()
    {
        return new InteractionPresenter($this);
    }

}