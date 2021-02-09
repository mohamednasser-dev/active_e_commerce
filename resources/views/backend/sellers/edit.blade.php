@extends('backend.layouts.app')

@section('content')

<div class="aiz-titlebar text-left mt-2 mb-3">
    <h5 class="mb-0 h6">{{translate('Edit Seller Information')}}</h5>
</div>

<div class="col-lg-6 mx-auto">
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0 h6">{{translate('Seller Information')}}</h5>
        </div>

        <div class="card-body">
          <form action="{{ route('sellers.update', $seller->id) }}" method="POST">
                <input name="_method" type="hidden" value="PATCH">
                @csrf
                <div class="form-group row">
                    <label class="col-sm-3 col-from-label" for="name">{{translate('Name')}}</label>
                    <div class="col-sm-9">
                        <input type="text" placeholder="{{translate('Name')}}" id="name" name="name" class="form-control" value="{{$seller->user->name}}" required>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-3 col-from-label" for="email">{{translate('Email Address')}}</label>
                    <div class="col-sm-9">
                        <input type="text" placeholder="{{translate('Email Address')}}" id="email" name="email" class="form-control" value="{{$seller->user->email}}" required>
                    </div>
                </div>

                 <div class="form-group row">
                    <label class="col-sm-3 col-from-label" for="shipingtype">{{ translate('shiping type')}}</label>
                    <div class="col-sm-9">
                          @if($seller->user->shipingtype == 'Seller')
 <label for="Seller">Seller</label>
<input type="radio" id="Seller" name="shipingtype" value="{{translate('Seller')}}" checked>&nbsp;&nbsp;&nbsp;
<label for="koshk">koshk</label>
<input type="radio" id="koshk" name="shipingtype" value="{{ translate('koshk')}}">


                                        @endif

                                         @if($seller->user->shipingtype == 'koshk')
 <label for="Seller">Seller</label>
<input type="radio" id="Seller" name="shipingtype" value="{{translate('Seller')}}" >&nbsp;&nbsp;&nbsp;
<label for="koshk">koshk</label>
<input type="radio" id="koshk" name="shipingtype" value="{{ translate('koshk')}}" checked>


                                        @endif
                    </div>
                </div>


                <div class="form-group row">
                    <label class="col-sm-3 col-from-label" for="password">{{translate('Password')}}</label>
                    <div class="col-sm-9">
                        <input type="password" placeholder="{{translate('Password')}}" id="password" name="password" class="form-control">
                    </div>
                </div>
                <div class="form-group mb-0 text-right">
                    <button type="submit" class="btn btn-primary">{{translate('Save')}}</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
