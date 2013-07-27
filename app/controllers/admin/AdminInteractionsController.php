<?php

class AdminInteractionsController extends AdminController {

    /**
     * Interaction Model
     * @var Interaction
     */
    protected $interaction;

    /**
     * User Model
     * @var User
     */
    protected $user;


    /**
     * Ad Model
     * @var ad
     */
    protected $ad;

    /**
     * Organization Model
     * @var organization
     */
    protected $organization;


    /**
     * Inject the models.
     * @param Interaction $ad
     * @param User $user
     * @param Ad $ad
     * @param Organization $organization
     */
    public function __construct(Interaction $interaction, User $user, Ad $ad, Organization $organization)
    {
        parent::__construct();
        $this->interaction = $interaction;
        $this->user = $user;
        $this->ad = $ad;
        $this->organization = $organization;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function getIndex()
    {
        // Title
        $title = Lang::get('admin/interactions/title.interaction_management');

        // Grab all the groups
        $interactions = $this->interaction;

        // Show the page
        return View::make('admin/interactions/index', compact('interactions', 'title'));
    }

    /**
     * Remove user page.
     *
     * @param $interaction
     * @return Response
     */
    public function getDelete($interaction)
    {
        // Title
        $title = Lang::get('admin/interactions/title.interaction_delete');

        // Show the page
        return View::make('admin/interactions/delete', compact('interaction', 'title'));
    }

    /**
     * Remove the specified user from storage.
     *
     * @param $interaction
     * @internal param $id
     * @return Response
     */
    public function postDelete($interaction)
    {
            // Was the ad deleted?
            if($interaction->delete()) {
                // Redirect to the ad management page
                return Redirect::to('admin/successful-delete')->with('success', Lang::get('admin/interactions/messages.delete.success'));
            }

            // There was a problem deleting the ad
            return Redirect::to('admin/interactions')->with('error', Lang::get('admin/interactions/messages.delete.error'));
    }

    /**
     * Show a list of all the interactions formatted for Datatables.
     *
     * @return Datatables JSON
     */
    public function getData()
    {

        $interactions = Interaction::leftjoin('users', 'users.id', '=', 'interactions.user_id')
                        ->leftjoin('ads', 'ads.id', '=','interactions.ad_id' )
                        ->leftjoin('organizations', 'organizations.id', '=','interactions.organization_id' )
                        ->select(array('interactions.id as id', 'users.id as userid','ads.id as adid', 'organizations.id as organizationid', 
                                        'users.username as interaction_user', 'ads.name as interaction_ad', 'organizations.name as interaction_organization', 'interactions.created_at' ));

        return Datatables::of($interactions)

        ->edit_column('interaction_user', '<a href="{{{ URL::to(\'admin/users/\'. $userid .\'/edit\') }}}" class="iframe">{{{ Str::limit($interaction_user, 40, \'...\') }}}</a>')

        ->edit_column('interaction_ad', '<a href="{{{ URL::to(\'admin/ads/\'. $adid .\'/edit\') }}}" class="iframe">{{{ $interaction_ad }}}</a>')

        ->edit_column('interaction_organization', '<a href="{{{ URL::to(\'admin/organizations/\'. $organizationid .\'/edit\') }}}" class="iframe">{{{ $interaction_organization }}}</a>')


        ->add_column('actions', '<a href="{{{ URL::to(\'admin/interactions/\' . $id . \'/delete\' ) }}}" class="iframe btn btn-mini btn-danger">{{{ Lang::get(\'button.delete\') }}}</a>
                    ')

        ->remove_column('id')
        ->remove_column('userid')
        ->remove_column('adid')
        ->remove_column('organizationid')

        ->make();
    }

}