@extends('layouts.master')

@section('content')
    <div class="heading">New Category</div>
    <div>
        <form class="form form-left" role="form" method="POST">
            {!! csrf_field() !!}

            <div class="form_group row{{ $errors->has('name') ? ' has-error' : '' }}">
                <label class="col-2">Name</label>

                <div class="col-10">
                    <input type="text" name="name" >
                    @if ($errors->has('name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <br />
            <div class="form_group row">
                <div class="col-left-2 col-10">
                    <button type="submit" class="btn btn-primary">
                        Create
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection

