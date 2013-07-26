<?php

class AdminAdvertisersController extends AdminController
{

    /**
     * Advertiser Model
     * @var Advertiser
     */
    protected $advertiser;

    /**
     * Inject the models.
     * @param Advertiser $advertiser
     */
    public function __construct(Advertiser $advertiser)
    {
        parent::__construct();
        $this->advertiser = $advertiser;
    }

    /**
     * Show a list of all the advertiser posts.
     *
     * @return View
     */
    public function getIndex()
    {
        // Title
        $title = Lang::get('admin/advertisers/title.advertiser_management');

        // Grab all the advertiser posts
        $advertisers = $this->advertiser;

        // Show the page
        return View::make('admin/advertisers/index', compact('advertisers', 'title'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function getCreate()
    {

        // Title
        $title = Lang::get('admin/advertisers/title.create_a_new_advertiser');

        // Show the page
        return View::make('admin/advertisers/create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function postCreate()
    {

        // Declare the rules for the form validation
        $rules = array(
            'name' => 'required'
        );

        // Validate the inputs
        $validator = Validator::make(Input::all(), $rules);
        // Check if the form validates with success
        if ($validator->passes())
        {
            // Get the inputs, with some exceptions
            $inputs = Input::except('csrf_token');

            $this->advertiser->name = $inputs['name'];
            $this->advertiser->description = $inputs['description'];
            $this->advertiser->save();

            // Was the advertiser created?
            if ($this->advertiser->id)
            {
                // Redirect to the new advertiser page
                return Redirect::to('admin/advertisers/' . $this->advertiser->id . '/edit')->with('success', Lang::get('admin/advertisers/messages.create.success'));
            }

            // Redirect to the new advertiser page
            return Redirect::to('admin/advertisers/create')->with('error', Lang::get('admin/advertisers/messages.create.error'));

            // Redirect to the advertiser create page
            return Redirect::to('admin/advertisers/create')->withInput()->with('error', Lang::get('admin/advertisers/messages.' . $error));
        }

        // Form validation failed
        return Redirect::to('admin/advertisers/create')->withInput()->withErrors($validator);
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param $advertiser
     * @return Response
     */
    public function getEdit($advertiser)
    {
        // Title
        $title = Lang::get('admin/advertisers/title.advertiser_update');

        // Show the page
        return View::make('admin/advertisers/edit', compact('advertiser', 'title'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param $advertiser
     * @return Response
     */
    public function postEdit($advertiser)
    {
        // Declare the rules for the form validation
        $rules = array(
            'name' => 'required|min:3'
        );

        // Validate the inputs
        $validator = Validator::make(Input::all(), $rules);

        // Check if the form validates with success
        if ($validator->passes())
        {
            // Update the advertiser post data
            $advertiser->name = Input::get('name');
            $advertiser->description = Input::get('description');

            // Was the advertiser post updated?
            if($advertiser->save())
            {
                // Redirect to the new advertiser post page
                return Redirect::to('admin/advertisers/' . $advertiser->id . '/edit')->with('success', Lang::get('admin/advertisers/messages.update.success'));
            }

            // Redirect to the advertisers post management page
            return Redirect::to('admin/advertisers/' . $advertiser->id . '/edit')->with('error', Lang::get('admin/advertisers/messages.update.error'));
        }

        // Form validation failed
        return Redirect::to('admin/advertisers/' . $advertiser->id . '/edit')->withInput()->withErrors($validator);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $advertiser
     * @return Response
     */
    public function getDelete($advertiser)
    {
        // Title
        $title = Lang::get('admin/advertisers/title.advertiser_delete');

        // Show the page
        return View::make('admin/advertisers/delete', compact('advertiser', 'title'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $advertiser
     * @return Response
     */
    public function postDelete($advertiser)
    {
        // Declare the rules for the form validation
        $rules = array(
            'id' => 'required|integer'
        );

        // Validate the inputs
        $validator = Validator::make(Input::all(), $rules);

        // Check if the form validates with success
        if ($validator->passes())
        {
            $id = $advertiser->id;
            $advertiser->delete();

            // Was the advertiser post deleted?
            $advertiser = Advertiser::find($id);
            if(empty($advertiser))
            {
                // Redirect to the advertiser posts management page
                return Redirect::to('admin/successful-delete')->with('success', Lang::get('admin/advertisers/messages.delete.success'));
            }
        }
        // There was a problem deleting the advertiser post
        return Redirect::to('admin/advertisers/' . $id . '/delete')->with('error', Lang::get('admin/advertisers/messages.delete.error'));
    }

    /*
     * Show a list of all the advertisers formatted for Datatables.
     *
     * @return Datatables JSON
     */
    public function getData()
    {
        $advertisers = Advertiser::select(array('advertisers.id',  'advertisers.name', 'advertisers.description', 'advertisers.created_at'));

        return Datatables::of($advertisers)


        ->add_column('actions', '<a href="{{{ URL::to(\'admin/advertisers/\' . $id . \'/edit\' ) }}}" class="iframe btn btn-mini">{{{ Lang::get(\'button.edit\') }}}</a>
                                <a href="{{{ URL::to(\'admin/advertisers/\' . $id . \'/delete\' ) }}}" class="iframe btn btn-mini btn-danger">{{{ Lang::get(\'button.delete\') }}}</a>
                    ')

        ->remove_column('id')

        ->make();
    }

}