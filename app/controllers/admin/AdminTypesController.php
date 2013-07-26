<?php

class AdminTypesController extends AdminController
{

    /**
     * Type Model
     * @var Type
     */
    protected $type;

    /**
     * Inject the models.
     * @param Type $type
     */
    public function __construct(Type $type)
    {
        parent::__construct();
        $this->type = $type;
    }

    /**
     * Show a list of all the type posts.
     *
     * @return View
     */
    public function getIndex()
    {
        // Title
        $title = Lang::get('admin/types/title.type_management');

        // Grab all the type posts
        $types = $this->type;

        // Show the page
        return View::make('admin/types/index', compact('types', 'title'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function getCreate()
    {

        // Title
        $title = Lang::get('admin/types/title.create_a_new_type');

        // Show the page
        return View::make('admin/types/create', compact('title'));
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

            $this->type->name = $inputs['name'];
            $this->type->save();

            // Was the type created?
            if ($this->type->id)
            {
                // Redirect to the new type page
                return Redirect::to('admin/types/' . $this->type->id . '/edit')->with('success', Lang::get('admin/types/messages.create.success'));
            }

            // Redirect to the new type page
            return Redirect::to('admin/types/create')->with('error', Lang::get('admin/types/messages.create.error'));

            // Redirect to the type create page
            return Redirect::to('admin/types/create')->withInput()->with('error', Lang::get('admin/types/messages.' . $error));
        }

        // Form validation failed
        return Redirect::to('admin/types/create')->withInput()->withErrors($validator);
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param $type
     * @return Response
     */
    public function getEdit($type)
    {
        // Title
        $title = Lang::get('admin/types/title.type_update');

        // Show the page
        return View::make('admin/types/edit', compact('type', 'title'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param $type
     * @return Response
     */
    public function postEdit($type)
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
            // Update the type post data
            $this->$type->name = Input::get('name');

            // Was the type post updated?
            if($this->$type->save())
            {
                // Redirect to the new type post page
                return Redirect::to('admin/types/' . $type->id . '/edit')->with('success', Lang::get('admin/types/messages.update.success'));
            }

            // Redirect to the types post management page
            return Redirect::to('admin/types/' . $type->id . '/edit')->with('error', Lang::get('admin/types/messages.update.error'));
        }

        // Form validation failed
        return Redirect::to('admin/types/' . $type->id . '/edit')->withInput()->withErrors($validator);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $type
     * @return Response
     */
    public function getDelete($type)
    {
        // Title
        $title = Lang::get('admin/types/title.type_delete');

        // Show the page
        return View::make('admin/types/delete', compact('type', 'title'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $type
     * @return Response
     */
    public function postDelete($type)
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
            $id = $type->id;
            $type->delete();

            // Was the type post deleted?
            $type = Type::find($id);
            if(empty($type))
            {
                // Redirect to the type posts management page
                return Redirect::to('admin/successful-delete')->with('success', Lang::get('admin/types/messages.delete.success'));
            }
        }
        // There was a problem deleting the type post
        return Redirect::to('admin/types/' . $id . '/delete')->with('error', Lang::get('admin/types/messages.delete.error'));
    }

    /*
     * Show a list of all the types formatted for Datatables.
     *
     * @return Datatables JSON
     */
    public function getData()
    {
        $types = Type::select(array('types.id',  'types.name', 'types.created_at'));

        return Datatables::of($types)


        ->add_column('actions', '<a href="{{{ URL::to(\'admin/types/\' . $id . \'/edit\' ) }}}" class="iframe btn btn-mini">{{{ Lang::get(\'button.edit\') }}}</a>
                                <a href="{{{ URL::to(\'admin/types/\' . $id . \'/delete\' ) }}}" class="iframe btn btn-mini btn-danger">{{{ Lang::get(\'button.delete\') }}}</a>
                    ')

        ->remove_column('id')

        ->make();
    }

}