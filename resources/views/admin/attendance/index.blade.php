@extends('layouts.app')

@section('content')
    <div class="row">
        @include('layouts.admin-sidebar')
        <div class="col-lg-10 col-md-9 col-lg-offset-1-1">

            <div class="main">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel-1 panel-trans">
                                <div class="panel-heading-1">
                                    <h4><i class="fa fa-pencil"></i>&nbsp;&nbsp;Attendances</h4>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <ul class="nav nav-tabs" role="tablist" style="background-color: white;">
                                <li role="presentation" class="active">
                                    <a href="#home" aria-controls="home" role="tab" data-toggle="tab">Attendances</a>
                                </li>
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content" style="background-color: white;padding: 20px;border: #ddd solid 1px;">
                                <div role="tabpanel" class="tab-pane active" id="home">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="table-responsive">
                                                <table class="table">
                                                    <thead style="background-color: #eeeeee; border: #ccc solid 1px;">

                                                    </thead>

                                                    <tbody>

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
