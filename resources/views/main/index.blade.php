@extends('layouts.main')

@section('content')

    <div class="container pt-2">
        <div class="row">

            <div class="col-md-12">
                <div class="jumbotron">
                    <h1 class="display-4">Hello!</h1>
                    <p class="lead">This is test task for Global IT Support.</p>
                    <hr class="my-4">
                    <p>This small app is done using PHP 7.1, Laravel 5.6, JQuery 3.2 and Bootstrap 4. Please scroll down
                        and try
                        it out yourself.</p>
                </div>
            </div>

            <div class="col-md-12">
                {{Form::open(['url' => route('get-data'), 'method' => 'post', 'id' => 'feed-form', 'class' => 'feed-form'])}}

                <div class="form-group">
                    @php
                        $additionalClass = $errors->get('feed_id') ? 'is-invalid' : '';
                    @endphp

                    {{Form::label('feed_id', 'Feed resource', ['class' => 'form-control-label'])}}
                    {{Form::select('feed_id', $feeds, null, ['id' => 'feed_id', 'class' => "form-control $additionalClass"])}}

                    @if($errors->get('feed_id'))
                        <div class="invalid-feedback">
                            @foreach($errors->get('feed_id') as $error)
                                {!! $error !!}
                            @endforeach
                        </div>
                    @endif

                </div>

                <div class="form-group feed-optional feed-type-1">
                    @php
                        $additionalClass = $errors->get('language') ? 'is-invalid' : '';
                    @endphp

                    {{Form::label('language', 'Language (ISO 639-1 value)', ['class' => 'form-control-label'])}}
                    {{Form::input('text', 'language', null, ['class' => "form-control $additionalClass", 'placeholder' => 'Default: en-US'])}}

                    @if($errors->get('language'))
                        <div class="invalid-feedback">
                            @foreach($errors->get('language') as $error)
                                {!! $error !!}
                            @endforeach
                        </div>
                    @endif

                </div>

                <div class="form-group feed-optional feed-type-1">
                    @php
                        $additionalClass = $errors->get('page') ? 'is-invalid' : '';
                    @endphp

                    {{Form::label('page', 'Page number (1 < number < 1000)', ['class' => 'form-control-label'])}}
                    {{Form::input('number', 'page', null, ['class' => "form-control $additionalClass", 'min' => 1, 'max' => 1000, 'placeholder' => 'Default: 1'])}}

                    @if($errors->get('page'))
                        <div class="invalid-feedback">
                            @foreach($errors->get('page') as $error)
                                {!! $error !!}
                            @endforeach
                        </div>
                    @endif

                </div>

                <div class="form-group feed-optional feed-type-1">
                    @php
                        $additionalClass = $errors->get('region') ? 'is-invalid' : '';
                    @endphp

                    {{Form::label('region', 'Region (ISO 3166-1 value)', ['class' => 'form-control-label'])}}
                    {{Form::input('text', 'region', null, ['class' => "form-control $additionalClass", 'placeholder' => 'No default value'])}}

                    @if($errors->get('region'))
                        <div class="invalid-feedback">
                            @foreach($errors->get('region') as $error)
                                {!! $error !!}
                            @endforeach
                        </div>
                    @endif

                </div>

                {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}

                {{Form::close()}}
            </div>

            @if(isset($data))

                <div class="col-md-12 mt-3">
                    <div class="card">
                        <div class="card-body">
                            <pre><code>{!! $data !!}</code></pre>
                        </div>
                    </div>
                </div>

            @endif

        </div>
    </div>

@endsection