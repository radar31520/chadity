<?php

class AdminDashboardController extends AdminController {

	/**
	 * Admin dashboard
	 *
	 */
	public function getIndex()
	{
        return View::make('admin/dashboard');
	}

	public function getSuccessfulDelete()
	{
		$title = " ";
		return View::make('admin/successful-delete', compact('title'));
	}
}