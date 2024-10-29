@extends('layouts.main')
@section('title', 'Devices')
@section('content')
    <!-- push external head elements to head -->
    @push('head')
    <link href="{{ asset('modern-dark-menu/assets/css/dashboard/dash_2.css') }}" rel="stylesheet" type="text/css" />
    @endpush
    <!-- Content-->
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12 layout-spacing">
        <div class="widget widget-card-one">
            <div class="widget-content">
                <div class="media">
                    <div class="w-img">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor"
                            class="bi bi-envelope-open" viewBox="0 0 16 16">
                            <path
                                d="M8.47 1.318a1 1 0 0 0-.94 0l-6 3.2A1 1 0 0 0 1 5.4v.817l5.75 3.45L8 8.917l1.25.75L15 6.217V5.4a1 1 0 0 0-.53-.882l-6-3.2ZM15 7.383l-4.778 2.867L15 13.117V7.383Zm-.035 6.88L8 10.082l-6.965 4.18A1 1 0 0 0 2 15h12a1 1 0 0 0 .965-.738ZM1 13.116l4.778-2.867L1 7.383v5.734ZM7.059.435a2 2 0 0 1 1.882 0l6 3.2A2 2 0 0 1 16 5.4V14a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V5.4a2 2 0 0 1 1.059-1.765l6-3.2Z" />
                        </svg>
                    </div>
                    <div class="media-body">
                        <h6>Email Notification</h6>
                    </div>
                </div>
                <form class="p-2" id="notifyEmailForm">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="smtpaddress">SMTP Address</label>
                            <input name="smtpaddress" type="text" value="{{ $smtpAddress }}" class="form-control"
                                id="smtpaddress">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="smtpport">SMTP PORT</label>
                            <input name="smtpport" type="text" value="{{ $smtpPort }}" class="form-control"
                                id="smtpport">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="smtpusername">SMTP Username</label>
                            <input name="smtpusername" type="text" value="{{ $smtpUsername }}" class="form-control"
                                id="smtpusername">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="smtppassword">SMTP Password</label>
                            <input name="smtppassword" type="password" class="form-control" id="smtppassword">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary mt-3" id="btnMailNotify">Save</button>

                    <button class="btn btn-danger btn-lg mb-3 mr-3" id="btnLaodingMailNotify" style="display: none;">
                        <div class="spinner-border text-white mr-2 align-self-center loader-sm ">Loading...</div>
                        Loading
                    </button>
                </form>

            </div>
        </div>
    </div>
    <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12 layout-spacing">
        <div class="widget widget-card-one">
            <div class="widget-content">
                <div class="media">
                    <div class="w-img">
                        <i data-feather="bell"></i>
                    </div>
                    <div class="media-body">
                        <h6>Telegram Bot Notification Settings</h6>
                    </div>
                </div>
                <form class="p-2" id="notifyTelegramForm">
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="token">Telegram Bot Token</label>
                            <textarea class="form-control form-control-sm mb-3" name="token" rows="2" id="token" value="{{ $telegramToken }}">{{ $telegramToken }}</textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-check pl-0">
                            <div class="custom-control custom-checkbox checkbox-info">
                                <input type="checkbox" class="custom-control-input" id="enableTelegram" {{ $telegramChecked }}>
                                <label class="custom-control-label" for="enableTelegram">Enable Telegram</label>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary mt-3" id="btnTelegramNotify">Save</button>
                    <button class="btn btn-danger btn-lg mb-3 mr-3" id="btnLaodingTelegramNotify" style="display: none;">
                        <div class="spinner-border text-white mr-2 align-self-center loader-sm ">Loading...</div>
                        Loading
                    </button>
                </form>

            </div>
        </div>
    </div>
    <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12 layout-spacing">
        <div class="widget widget-card-one">
            <div class="widget-content">
                <div class="media">
                    <div class="w-img">
                        <i data-feather="bell"></i>
                    </div>
                    <div class="media-body">
                        <h6>Slack Notification Settings</h6>
                    </div>
                </div>
                <form class="p-2" id="notifySlackForm">
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="token">Slack Webhook</label>
                            <textarea class="form-control form-control-sm mb-3" name="slackWebhook" rows="2" id="slackWebhook" value="{{ $slackWebhook }}">{{ $slackWebhook }}</textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-check pl-0">
                            <div class="custom-control custom-checkbox checkbox-info">
                                <input type="checkbox" class="custom-control-input" id="enableSlack" {{ $slackChecked }}>
                                <label class="custom-control-label" for="enableSlack">Enable Slack</label>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary mt-3" id="btnSlackNotify">Save</button>
                    <button class="btn btn-danger btn-lg mb-3 mr-3" id="btnLaodingSlackNotify" style="display: none;">
                        <div class="spinner-border text-white mr-2 align-self-center loader-sm ">Loading...</div>
                        Loading
                    </button>
                </form>

            </div>
        </div>
    </div>

    @include('pages.settings.devices_2')

    @push('script')
        <script>
            $(document).ready(function() {
                var emailNotifyCfg = updateNotification($('#notifyEmailForm'), "/settings/mail", $("#btnMailNotify"), $("#btnLaodingMailNotify"), 'Mail');
                var TelegramNotifyCfg = updateNotification($('#notifyTelegramForm'),"/settings/telegram", $("#btnTelegramNotify"), $("#btnLaodingTelegramNotify"), 'Telegram', $("#enableTelegram"));
                var slackNotifyCfg = updateNotification($("#notifySlackForm"),"/settings/slack",$("#btnSlackNotify"), $("#btnLaodingSlackNotify"), 'Slack', $("#enableSlack"));
                var networkCfg =updateNotification($("#networkConfigForm"),"/settings/network",$("#btnNetworkSave"),$("#btnNetworkSaveLoading"),'Network');
                var deleteDb = updateNotification($("#deleteDbForm"),"/settings/deletedb",$("#btnNdeleteDb"),$("#btnNdeleteDbLoading"),"Delete Db");
                function updateNotification(formId, path, submitButton, ProgressButton, mods, enable = "") {
                    formId.on('submit', function(e) {
                        var datas = formId.serialize()+"&_token="+$('meta[name="csrf-token"]').attr('content');
                        e.preventDefault();
                        if (enable != "") {
                            if (enable.is(':checked')) {
                                var featureEnabler = true;
                            } else {
                                var featureEnabler = false;
                            }
                            datas +="&featureEnabler="+featureEnabler;
                        }
                        submitButton.hide();
                        ProgressButton.show();
                        $.ajax({
                            url: path,
                            type: "POST",
                            data: datas,
                            success: function(response) {
                                submitButton.show();
                                ProgressButton.hide();
                                if (response.status === "OK") {
                                    Snackbar.show({
                                        text: mods + ' notification settings updated!',
                                        pos: 'top-center',
                                        actionTextColor: '#fff',
                                        backgroundColor: '#8dbf42'
                                    });
                                } else {
                                    Snackbar.show({
                                        text: 'Failed to update ' + mods +
                                            ' notification settings!',
                                        pos: 'top-center',
                                        actionTextColor: '#fff',
                                        backgroundColor: '#e7515a'
                                    });
                                }
                            },
                            error: function(xhr) {
                                submitButton.show();
                                ProgressButton.hide();
                                Snackbar.show({
                                    text: 'Failed to update ' + mods +
                                        ' notification settings!',
                                    pos: 'top-center',
                                    actionTextColor: '#fff',
                                    backgroundColor: '#e7515a'
                                });
                            }
                        });

                    });
                }

            });
        </script>
    @endpush

@endsection
