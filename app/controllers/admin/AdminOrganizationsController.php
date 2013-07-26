<?php

class AdminOrganizationsController extends AdminController
{

    /**
     * Organization Model
     * @var Organization
     */
    protected $organization;

    /**
     * Inject the models.
     * @param Organization $organization
     */
    public function __construct(Organization $organization)
    {
        parent::__construct();
        $this->organization = $organization;
    }

    /**
     * Show a list of all the organization posts.
     *
     * @return View
     */
    public function getIndex()
    {
        // Title
        $title = Lang::get('admin/organizations/title.organization_management');

        // Grab all the organization posts
        $organizations = $this->organization;

        // Show the page
        return View::make('admin/organizations/index', compact('organizations', 'title'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function getCreate()
    {

        // Title
        $title = Lang::get('admin/organizations/title.create_a_new_organization');

        // Show the page
        return View::make('admin/organizations/create', compact('title'));
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

            $this->organization->name = $inputs['name'];
            $this->organization->description = $inputs['description'];
            $this->organization->save();

            // Was the organization created?
            if ($this->organization->id)
            {
                // Redirect to the new organization page
                return Redirect::to('admin/organizations/' . $this->organization->id . '/edit')->with('success', Lang::get('admin/organizations/messages.create.success'));
            }

            // Redirect to the new organization page
            return Redirect::to('admin/organizations/create')->with('error', Lang::get('admin/organizations/messages.create.error'));

            // Redirect to the organization create page
            return Redirect::to('admin/organizations/create')->withInput()->with('error', Lang::get('admin/organizations/messages.' . $error));
        }

        // Form validation failed
        return Redirect::to('admin/organizations/create')->withInput()->withErrors($validator);
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param $organization
     * @return Response
     */
    public function getEdit($organization)
    {
        // Title
        $title = Lang::get('admin/organizations/title.organization_update');

        // Show the page
        return View::make('admin/organizations/edit', compact('organization', 'title'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param $organization
     * @return Response
     */
    public function postEdit($organization)
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
            // Update the organization post data
            $organization->name = Input::get('name');
            $organization->description = Input::get('description');

            // Was the organization post updated?
            if($organization->save())
            {
                // Redirect to the new organization post page
                return Redirect::to('admin/organizations/' . $organization->id . '/edit')->with('success', Lang::get('admin/organizations/messages.update.success'));
            }

            // Redirect to the organizations post management page
            return Redirect::to('admin/organizations/' . $organization->id . '/edit')->with('error', Lang::get('admin/organizations/messages.update.error'));
        }

        // Form validation failed
        return Redirect::to('admin/organizations/' . $organization->id . '/edit')->withInput()->withErrors($validator);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $organization
     * @return Response
     */
    public function getDelete($organization)
    {
        // Title
        $title = Lang::get('admin/organizations/title.organization_delete');

        // Show the page
        return View::make('admin/organizations/delete', compact('organization', 'title'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $organization
     * @return Response
     */
    public function postDelete($organization)
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
            $id = $organization->id;
            $organization->delete();

            // Was the organization post deleted?
            $organization = Organization::find($id);
            if(empty($organization))
            {
                // Redirect to the organization posts management page
                return Redirect::to('admin/successful-delete')->with('success', Lang::get('admin/organizations/messages.delete.success'));
            }
        }
        // There was a problem deleting the organization post
        return Redirect::to('admin/organizations/' . $id . '/delete')->with('error', Lang::get('admin/organizations/messages.delete.error'));
    }

    /*
     * Show a list of all the organizations formatted for Datatables.
     *
     * @return Datatables JSON
     */
    public function getData()
    {
        $organizations = Organization::select(array('organizations.id',  'organizations.name', 'organizations.description', 'organizations.created_at'));

        return Datatables::of($organizations)


        ->add_column('actions', '<a href="{{{ URL::to(\'admin/organizations/\' . $id . \'/edit\' ) }}}" class="iframe btn btn-mini">{{{ Lang::get(\'button.edit\') }}}</a>
                                <a href="{{{ URL::to(\'admin/organizations/\' . $id . \'/delete\' ) }}}" class="iframe btn btn-mini btn-danger">{{{ Lang::get(\'button.delete\') }}}</a>
                    ')

        ->remove_column('id')

        ->make();
    }

}