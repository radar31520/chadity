<?php

class AdminAdsController extends AdminController {

    /**
     * Ad Model
     * @var Ad
     */
    protected $ad;

    /**
     * Advertiser Model
     * @var Advertiser
     */
    protected $advertiser;


    /**
     * Type Model
     * @var type
     */
    protected $type;

    /**
     * Inject the models.
     * @param Ad $ad
     * @param Advertiser $advertiser
     * @param Type $type
     */
    public function __construct(Ad $ad, Advertiser $advertiser, Type $type)
    {
        parent::__construct();
        $this->ad = $ad;
        $this->advertiser = $advertiser;
        $this->type = $type;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function getIndex()
    {
        // Title
        $title = Lang::get('admin/ads/title.ad_management');

        // Grab all the groups
        $ads = $this->ad;

        // Show the page
        return View::make('admin/ads/index', compact('ads', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function getCreate()
    {
        // All advertiser
        $advertisers = $this->advertiser->all();

        // Get all the available permissions
        $types = $this->type->all();

        // Selected groups
        $selectedAdvertisers = Input::old('advertiser', array());

        // Selected permissions
        $selectedTypes = Input::old('type', array());

        // Title
        $title = Lang::get('admin/ads/title.create_a_new_ad');

        // Show the page
        return View::make('admin/ads/create', compact('advertisers', 'types', 'selectedAdvertisers', 'selectedTypes', 'title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function postCreate()
    {

        // Get the inputs, with some exceptions
        $inputs = Input::except('csrf_token');

        $ad->name = $inputs['name' ];
        $ad->description = $inputs['description'];
        $ad->url =$inputs['url'];
        $ad->advertiser_id = $inputs['advertiser'];
        $ad->type_id = $inputs['type'];
        $ad->save();

        // Was the advertiser created?
        if ($advertiser->id)
        {
            // Redirect to the new advertiser page
            return Redirect::to('admin/ad/' . $this->ad->id . '/edit')->with('success', Lang::get('admin/ad/messages.create.success'));
        }

        // Redirect to the new advertiser page
        return Redirect::to('admin/ad/create')->with('error', Lang::get('admin/ad/messages.create.error'));

        // Redirect to the advertiser create page
        return Redirect::to('admin/ad/create')->withInput()->with('error', Lang::get('admin/ad/messages.' . $error));    
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $ad
     * @return Response
     */
    public function getEdit($ad)
    {
  
          // All advertiser
        $advertisers = $this->advertiser->all();

        // Get all the available types
        $types = $this->type->all();

        // Title
        $title = Lang::get('admin/ads/title.ad_update');

        // Show the page
        return View::make('admin/ads/edit', compact('ad', 'advertisers', 'types', 'title'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param $ad
     * @return Response
     */
    public function postEdit($ad)
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
            // Update the ad data
            $inputs = Input::except('csrf_token');
            $ad->name = $inputs['name' ];
            $ad->description = $inputs['description'];
            $ad->url =$inputs['url'];
            $ad->advertiser_id = $inputs['advertiser'];
            $ad->type_id = $inputs['type'];

            // Was the ad updated?
            if ($ad->save())
            {
                // Redirect to the ad page
                return Redirect::to('admin/ads/' . $ad->id . '/edit')->with('success', Lang::get('admin/ads/messages.update.success'));
            }
            else
            {
                // Redirect to the ad page
                return Redirect::to('admin/ads/' . $ad->id . '/edit')->with('error', Lang::get('admin/ads/messages.update.error'));
            }
        }

        // Form validation failed
        return Redirect::to('admin/ads/' . $ad->id . '/edit')->withInput()->withErrors($validator);
    }


    /**
     * Remove user page.
     *
     * @param $ad
     * @return Response
     */
    public function getDelete($ad)
    {
        // Title
        $title = Lang::get('admin/ads/title.ad_delete');

        // Show the page
        return View::make('admin/ads/delete', compact('ad', 'title'));
    }

    /**
     * Remove the specified user from storage.
     *
     * @param $ad
     * @internal param $id
     * @return Response
     */
    public function postDelete($ad)
    {
            // Was the ad deleted?
            if($ad->delete()) {
                // Redirect to the ad management page
                return Redirect::to('admin/successful-delete')->with('success', Lang::get('admin/ads/messages.delete.success'));
            }

            // There was a problem deleting the ad
            return Redirect::to('admin/ads')->with('error', Lang::get('admin/ads/messages.delete.error'));
    }

    /**
     * Show a list of all the ads formatted for Datatables.
     *
     * @return Datatables JSON
     */
    public function getData()
    {

        $ads = Ad::leftjoin('advertisers', 'advertisers.id', '=', 'ads.advertiser_id')
                        ->leftjoin('types', 'types.id', '=','ads.type_id' )
                        ->select(array('ads.id as id', 'advertisers.id as advertiserid','types.id as typeid',  'ads.name', 
                                        'ads.description', 'ads.url', 'advertisers.name as ad_creator', 'types.name as ad_type'));

        return Datatables::of($ads)

        ->edit_column('ad_creator', '<a href="{{{ URL::to(\'admin/advertisers/\'. $advertiserid .\'/edit\') }}}" class="iframe">{{{ Str::limit($ad_creator, 40, \'...\') }}}</a>')

        ->edit_column('ad_type', '<a href="{{{ URL::to(\'admin/types/\'. $typeid .\'/edit\') }}}" class="iframe">{{{ $ad_type }}}</a>')


        ->add_column('actions', '<a href="{{{ URL::to(\'admin/ads/\' . $id . \'/edit\' ) }}}" class="iframe btn btn-mini">{{{ Lang::get(\'button.edit\') }}}</a>
                                <a href="{{{ URL::to(\'admin/ads/\' . $id . \'/delete\' ) }}}" class="iframe btn btn-mini btn-danger">{{{ Lang::get(\'button.delete\') }}}</a>
                    ')

        ->remove_column('id')
        ->remove_column('advertiserid')
        ->remove_column('typeid')

        ->make();
    }

}