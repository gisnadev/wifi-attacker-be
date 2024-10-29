<div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12 layout-spacing">
    <div class="widget widget-card-one">
        <form id="deleteDbForm">

        <div class="widget-content">
            <div class="media">
                <div class="w-img">
                    <i data-feather="database"></i>
                </div>
                <div class="media-body">
                    <h6>Database Settings</h6>
                </div>
            </div>

            <div class="pl-3 pb-2">
                <span>Deleting all data except users</span>
            </div>
            <div class="pl-3">
                <button type="submit" class="btn btn-primary mt-3" id="btnNdeleteDb">Delete</button>
                <button class="btn btn-danger btn-lg mb-3 mr-3" id="btnNdeleteDbLoading" style="display: none;">
                    <div class="spinner-border text-white mr-2 align-self-center loader-sm ">Loading...</div>
                    Loading
                </button>
            </div>
        </div>
    </form>
    </div>
</div>

<div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12 layout-spacing">
    <div class="widget widget-card-one">
        <form id="networkConfigForm">
            <div class="widget-content">
                <div class="media">
                    <div class="w-img">
                        <i data-feather="settings"></i>
                    </div>
                    <div class="media-body">
                        <h6>Networking Mode</h6>
                    </div>
                </div>
                <div class="n-chk pl-3">
                    <label class="new-control new-radio square-radio new-radio-text radio-success">
                        {{-- <input type="radio" class="new-control-input" name="networkMode" value="1"> --}}
                        {!! Form::radio('networkMode', 'peer_to_peer',  $network == 'peer_to_peer', ['id' => 'peer_to_peer_id','class'=>'new-control-input']) !!}
                        <span class="new-control-indicator"></span><span class="new-radio-content">Peer To Peer</span>
                    </label>
                </div>
                <div class="n-chk pl-3">
                    <label class="new-control new-radio square-radio new-radio-text radio-info">
                        {{-- <input type="radio" class="new-control-input" name="networkMode" value="2"> --}}
                        {!! Form::radio('networkMode', 'dhcp',  $network == 'dhcp',['id' => 'dhcp_id','class'=>'new-control-input']) !!}

                        <span class="new-control-indicator"></span><span class="new-radio-content">Lan/Wlan</span>
                    </label>
                </div>
                <div class="pl-3">
                    <button type="submit" class="btn btn-primary mt-3" id="btnNetworkSave">Save</button>
                    <button class="btn btn-danger btn-lg mb-3 mr-3" id="btnNetworkSaveLoading" style="display: none;">
                        <div class="spinner-border text-white mr-2 align-self-center loader-sm ">Loading...</div>
                        Loading
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>