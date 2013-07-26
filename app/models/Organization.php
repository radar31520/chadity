<?php

use Robbo\Presenter\PresentableInterface;

class Organization extends Eloquent implements PresentableInterface {



	
	public function getPresenter()
    {
        return new OrganizationPresenter($this);
    }
}