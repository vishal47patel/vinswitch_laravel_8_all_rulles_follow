@extends('layouts.main')

@section('content')
<style>
    .accordion-button::after {
        width: 0px;
        outline: none !important;

    }

    .button:focus:not(:focus-visible) {
        background: #337ab7 !important;
        color: white !important;
        outline: none !important;

    }

    .button:focus:focus-visible {
        background: #337ab7 !important;
        color: white !important;
        outline: none !important;
    }

    .accordion-button:not(.collapsed) {
        background: none !important;
        border: none !important;
        box-shadow: none !important;
        outline: none !important;

    }

    .accordion-header {
        background-color: #337ab7 !important;
        color: white !important;
        border-radius: 5px !important;
    }
</style>
<div class="container-fluid"><br>

    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <!-- header start-->
                    <div class="row with-border mb-2">
                        <div class="col-md-6">
                            <h4 class="page-title"><i class="fas fa-users" aria-hidden="true"></i> SIP Status</h4>
                        </div>
                        <div class="col-md-6 pull-right mb-1">
                            @if ($operationPermission['list'])
                            <a class="btn btn-success btn-sm bg-success" href="{{route('sip.status.cmd', ['cmd' => 'api reloadacl'])}}" title="Reload ACL"><i class="fa fa-refresh "></i></a>
                            <a class="btn btn-warning btn-sm bg-warning text-white" href="{{route('sip.status.cmd', ['cmd' => 'api reloadxml'])}}" title="Reload XML"><i class="fa fa-refresh"></i></a>
                            @endif
                        </div>
                    </div>
                    <!-- header end-->
                    @include('layouts.flash_message')
                    <!-- content start-->
                    <div class="accordion border-primary-vinswitch1" id="accordionPanelsStayOpenExample">
                        <div class="accordion-item1 border border-primary-vinswitch">
                            <h2 class="accordion-header" id="panelsStayOpen-headingOne">
                                <button class="accordion-button bg-primary-vinswitch1 text-white" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">
                                    Sofia Status
                                </button>
                            </h2>
                            <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show" aria-labelledby="panelsStayOpen-headingOne">
                                <div class="accordion-body">
                                    <table data-toggle="table" data-show-columns="false" data-buttons-class="xs btn-light" data-page-list="[5, 10, 20]" data-page-size="5" data-pagination="true" class="tablesaw table mb-0" data-tablesaw-mode="stack">

                                        <thead class="table-light">
                                            <tr>
                                                <th>#</th>
                                                <th>Name</th>
                                                <th>Type</th>
                                                <th>Data</th>
                                                <th>State</th>

                                                <th class="action-text-left">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="panelsStayOpen-headingTwo">
                                <div class="row">
                                    <div class="col-lg-8">
                                        <button class="accordion-button collapsed text-white" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="false" aria-controls="panelsStayOpen-collapseTwo">
                                            Sofia Status Profile internal
                                        </button>
                                    </div>
                                    <div class="col-lg-4 pull-right align-self-center">
                                        @if ($operationPermission['list'])
                                        <a class="btn btn-success btn-sm bg-success" href="{{route('sip.status.cmd', ['cmd' => 'api sofia profile internal flush_inbound_reg'])}}" title="Flush Registration"><i class="fab fa-dropbox"></i></a>
                                        <a class="btn btn-danger btn-sm bg-danger text-white" href="{{route('sip.status.cmd', ['cmd' => 'api sofia profile internal stop'])}}" title="Stop"><i class=" far fa-stop-circle"></i></a>
                                        <a class="btn btn-warning btn-sm bg-warning text-white" href="{{route('sip.status.cmd', ['cmd' => 'api sofia profile internal restart'])}}" title="Restart"><i class="fa fa-undo"></i></a>
                                        <a class="btn btn-info btn-sm bg-info text-white me-2" href="{{route('sip.status.cmd', ['cmd' => 'api sofia profile internal rescan'])}}" title="Rescan"><i class="fas fa-envelope-open-text"></i></a>
                                        @endif


                                    </div>
                                </div>

                            </h2>

                            <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingTwo">
                                <div class="accordion-body">
                                    <div class="row">

                                    </div>
                                    <table data-toggle="table" data-show-columns="false" data-buttons-class="xs btn-light" data-page-list="[5, 10, 20]" data-page-size="5" data-pagination="true" class="tablesaw table mb-0" data-tablesaw-mode="stack">

                                        <tbody>
                                            <tr>
                                                <th class="float-end">#</th>
                                                <td>value</td>
                                            </tr>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="panelsStayOpen-headingThree">

                                <div class="row">
                                    <div class="col-lg-8">
                                        <button class="accordion-button collapsed text-white" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseThree" aria-expanded="false" aria-controls="panelsStayOpen-collapseThree">
                                            Sofia Status Profile external
                                        </button>
                                    </div>
                                    <div class="col-lg-4 pull-right align-self-center">
                                        @if ($operationPermission['list'])
                                        <a class="btn btn-danger btn-sm bg-danger text-white" href="{{route('sip.status.cmd', ['cmd' => 'api sofia profile external stop'])}}" title="Stop"><i class=" far fa-stop-circle"></i></a>
                                        <a class="btn btn-warning btn-sm bg-warning text-white" href="{{route('sip.status.cmd', ['cmd' => 'api sofia profile external restart'])}}" title="Restart"><i class="fa fa-undo"></i></a>
                                        <a class="btn btn-info btn-sm bg-info text-white me-2" href="{{route('sip.status.cmd', ['cmd' => 'api sofia profile external rescan'])}}" title="Rescan"><i class="fas fa-envelope-open-text"></i></a>
                                        @endif


                                    </div>
                                </div>

                            </h2>
                            <div id="panelsStayOpen-collapseThree" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingThree">
                                <div class="accordion-body">
                                    <table data-toggle="table" data-show-columns="false" data-buttons-class="xs btn-light" data-page-list="[5, 10, 20]" data-page-size="5" data-pagination="true" class="tablesaw table mb-0" data-tablesaw-mode="stack">

                                        <tbody>
                                            <tr>
                                                <td class="float-end">#</td>
                                                <td>value</td>
                                            </tr>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header text-white" id="panelsStayOpen-headingFour">
                                <button class="accordion-button collapsed text-white" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseFour" aria-expanded="false" aria-controls="panelsStayOpen-collapseFour">
                                    Status
                                </button>
                            </h2>
                            <div id="panelsStayOpen-collapseFour" class="accordion-collapse collapse show" aria-labelledby="panelsStayOpen-headingFour">
                                <div class="accordion-body">
                                    <div class="p-3 bg-light border">dsfsgdfs</div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- content end-->

                </div>
            </div>
        </div>
    </div>

</div>
@endsection