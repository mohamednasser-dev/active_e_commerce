@extends('frontend.layouts.app')

@section('content')

    <section class="py-5">
        <div class="container">
            <div class="d-flex align-items-start">
                @include('frontend.inc.user_side_nav')

                <div class="aiz-user-panel">

                    <div class="aiz-titlebar mt-2 mb-4">
                      <div class="row align-items-center">
                        <div class="col-md-6">
                            <h1 class="h3">{{ translate('Shop Settings')}}
                                <a href="{{ route('shop.visit', $shop->slug) }}" class="btn btn-link btn-sm" target="_blank">({{ translate('Visit Shop')}})<i class="la la-external-link"></i>)</a>
                            </h1>
                        </div>
                      </div>
                    </div>

                    {{-- Basic Info --}}
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0 h6">{{ translate('Basic Info') }}</h5>
                        </div>
                        <div class="card-body">
                            <form class="" action="{{ route('shops.update', $shop->id) }}" method="POST" enctype="multipart/form-data">
                                <input type="hidden" name="_method" value="PATCH">
                                @csrf
                                <div class="row">
                                    <label class="col-md-2 col-form-label">{{ translate('Shop Name') }}<span class="text-danger text-danger">*</span></label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control mb-3" placeholder="{{ translate('Shop Name')}}" name="name" value="{{ $shop->name }}" required>
                                    </div>
                                </div>
                                @if (\App\BusinessSetting::where('type', 'shipping_type')->first()->value == 'seller_wise_shipping')
                                    <div class="row">
                                        <div class="col-md-2">
                                            <label>{{ translate('Shipping Cost')}} <span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-md-10">
                                            <input type="number" min="0" class="form-control mb-3" placeholder="{{ translate('Shipping Cost')}}" name="shipping_cost" value="{{ $shop->shipping_cost }}" required>
                                        </div>
                                    </div>
                                @endif
                                <div class="row mb-3">
                                    <label class="col-md-2 col-form-label">{{ translate('Pickup Points') }}</label>
                                    <div class="col-md-10">
                                        <select class="form-control aiz-selectpicker" data-placeholder="{{ translate('Select Pickup Point') }}" id="pick_up_point" name="pick_up_point_id[]" multiple>
                                            @foreach (\App\PickupPoint::all() as $pick_up_point)
                                                @if (Auth::user()->shop->pick_up_point_id != null)
                                                    <option value="{{ $pick_up_point->id }}" @if (in_array($pick_up_point->id, json_decode(Auth::user()->shop->pick_up_point_id))) selected @endif>{{ $pick_up_point->getTranslation('name') }}</option>
                                                @else
                                                    <option value="{{ $pick_up_point->id }}">{{ $pick_up_point->getTranslation('name') }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-md-2 col-form-label">{{ translate('Photo') }}</label>
                                    <div class="col-md-10">
                                        <div class="input-group" data-toggle="aizuploader" data-type="image">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse')}}</div>
                                            </div>
                                            <div class="form-control file-amount">{{ translate('Choose File') }}</div>
                                            <input type="hidden" name="logo" value="{{ $shop->logo }}" class="selected-files">
                                        </div>
                                        <div class="file-preview box sm">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <label class="col-md-2 col-form-label">{{ translate('Address') }} <span class="text-danger text-danger">*</span></label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control mb-3" placeholder="{{ translate('Address')}}" name="address" value="{{ $shop->address }}" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-md-2 col-form-label">{{ translate('Meta Title') }}<span class="text-danger text-danger">*</span></label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control mb-3" placeholder="{{ translate('Meta Title')}}" name="meta_title" value="{{ $shop->meta_title }}" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-md-2 col-form-label">{{ translate('Meta Description') }}<span class="text-danger text-danger">*</span></label>
                                    <div class="col-md-10">
                                        <textarea name="meta_description" rows="3" class="form-control mb-3" required>{{ $shop->meta_description }}</textarea>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-2">
                                         <label class=" col-form-label">   <label>{{ translate('sellerstypes')}}<span class="text-danger text-danger">*</span>
                                    </label>
                                    </div>
                                   
                                    <div class="col-md-10">
                                       <select class="js-example-basic-multiple form-control" name="sellerstype[]" multiple="multiple">
     @foreach( App\Models\seller_sellerstype::where('seller_id',$shop->user_id)->get() as $sellerstype) 
  <option value="{{$sellerstype->sellerstype}}" selected="selected">{{$sellerstype->sellerstype}}</option>
   @endforeach

   @foreach( App\Models\sellerstype::get() as $sellerstype) 
  <option value="{{$sellerstype->name}}"  >{{$sellerstype->name}}</option>
   @endforeach


</select>

 

                                    </div>

                                </div>

                                  <div class="row">
                                    <div class="col-md-2">
                                         <label class=" col-form-label">   <label>{{ translate('shiping type')}}<span class="text-danger text-danger">*</span>
                                    </label>
                                    </div>
                                   
                                    <div class="col-md-10">
                              

                                        @if(App\user::where('id',$shop->user_id)->first()->shipingtype == 'Seller')
 <label for="Seller">Seller</label>
<input type="radio" id="Seller" name="shipingtype" value="{{translate('Seller')}}" checked>&nbsp;&nbsp;&nbsp;
<label for="koshk">koshk</label>
<input type="radio" id="koshk" name="shipingtype" value="{{ translate('koshk')}}">


                                        @endif

                                         @if(App\user::where('id',$shop->user_id)->first()->shipingtype == 'koshk')
 <label for="Seller">Seller</label>
<input type="radio" id="Seller" name="shipingtype" value="{{translate('Seller')}}" >&nbsp;&nbsp;&nbsp;
<label for="koshk">koshk</label>
<input type="radio" id="koshk" name="shipingtype" value="{{ translate('koshk')}}" checked>


                                        @endif

                                       


                                         
                                     </select>

                                    </div>
                                </div>

                                 <!--div class="row">
                                    <div class="col-md-2">
                                         <label class=" col-form-label">   <label>{{ translate('koshk shiping')}} <span class="text-danger text-danger">*</span>
                                    </label>
                                    </div>
                                   
                                    <div class="col-md-10">
                                      <select name="koshkshiping" class="form-control" placeholder="{{ translate('do you want koshk shiping')}}">

                                        @if(App\user::where('id',$shop->user_id)->first()->koshkshiping == 1)
  <option value="{{ App\user::where('id',$shop->user_id)->first()->koshkshiping }}" selected="selected">{{ translate('yes')}}</option>
  <option value="0">{{ translate('no')}}</option>
                                        @endif

                                         @if(App\user::where('id',$shop->user_id)->first()->koshkshiping == 0)
  <option value="{{ App\user::where('id',$shop->user_id)->first()->koshkshiping }}" selected="selected">{{ translate('no')}}</option>
  <option value="1">{{ translate('yes')}}</option>
                                        @endif
  


                                         
                                     </select>

                                    </div>
                                </div -->


                                   <br>

                                   <!--div class="row">
                                    <div class="col-md-2">
                                         <label class=" col-form-label">   <label>{{ translate('have  shiping')}} <span class="text-danger text-danger">*</span>
                                    </label>
                                    </div>
                                   
                                    <div class="col-md-10">
                                      <select name="haveshiping" class="form-control" placeholder="{{ translate('do you want koshk shiping')}}">
  @if(App\user::where('id',$shop->user_id)->first()->haveshiping == 1)
  <option value="{{ App\user::where('id',$shop->user_id)->first()->haveshiping }}" selected="selected">{{ translate('yes')}}</option>
  <option value="0">{{ translate('no')}}</option>
                                        @endif

                                         @if(App\user::where('id',$shop->user_id)->first()->haveshiping == 0)
  <option value="{{ App\user::where('id',$shop->user_id)->first()->haveshiping }}" selected="selected">{{ translate('no')}}</option>
  <option value="1">{{ translate('yes')}}</option>
                                        @endif
                                         
                                     </select>

                                    </div>
                                </div>
                                </div -->
                                


                                <div class="form-group mb-0 text-right">
                                    <button type="submit" class="btn btn-sm btn-primary">{{translate('Save')}}</button>
                                </div>
                            </form>
                        </div>
                    </div>

                    {{-- Slider Settings --}}
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0 h6">{{ translate('Slider Settings') }}</h5>
                        </div>
                        <div class="card-body">
                            <form class="" action="{{ route('shops.update', $shop->id) }}" method="POST" enctype="multipart/form-data">
                                <input type="hidden" name="_method" value="PATCH">
                                @csrf

                                <div class="row mb-3">
                                    <label class="col-md-2 col-form-label">{{ translate('Photo') }}</label>
                                    <div class="col-md-10">
                                        <div class="input-group" data-toggle="aizuploader" data-type="image" data-multiple="true">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse')}}</div>
                                            </div>
                                            <div class="form-control file-amount">{{ translate('Choose File') }}</div>
                                            <input type="hidden" name="sliders" value="{{ $shop->sliders }}" class="selected-files">
                                        </div>
                                        <div class="file-preview box sm">
                                        </div>
                                    </div>
                                </div>


                                {{-- <div class="form-box-content p-3">
                                    <div id="shop-slider-images">
                                        <div class="row">
                                            <div class="col-md-2">
                                                <label>{{ translate('Slider Images')}} <small>(1400x400)</small></label>
                                            </div>
                                            <div class="offset-2 offset-md-0 col-10 col-md-10">
                                                <div class="row">
                                                    @if ($shop->sliders != null)
                                                        @foreach (json_decode($shop->sliders) as $key => $sliders)
                                                            <div class="col-md-6">
                                                                <div class="img-upload-preview">
                                                                    <img loading="lazy"  src="{{ uploaded_asset($sliders) }}" alt="" class="img-fluid">
                                                                    <input type="hidden" name="previous_sliders[]" value="{{ $sliders }}">
                                                                    <button type="button" class="btn btn-danger close-btn remove-files"><i class="fa fa-times"></i></button>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    @endif
                                                </div>
                                                <input type="file" name="sliders[]" id="slide-0" class="custom-input-file custom-input-file--4" data-multiple-caption="{count} files selected" multiple accept="image/*" />
                                                <label for="slide-0" class="mw-100 mb-3">
                                                    <span></span>
                                                    <strong>
                                                        <i class="fa fa-upload"></i>
                                                        {{ translate('Choose image')}}
                                                    </strong>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <button type="button" class="btn btn-info mb-3" onclick="add_more_slider_image()">{{  translate('Add More') }}</button>
                                    </div>
                                </div> --}}
                                <div class="form-group mb-0 text-right">
                                    <button type="submit" class="btn btn-sm btn-primary">{{translate('Save')}}</button>
                                </div>
                            </form>
                        </div>
                    </div>

                    {{-- Social Media Link --}}
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0 h6">{{ translate('Social Media Link') }}</h5>
                        </div>
                        <div class="card-body">
                            <form class="" action="{{ route('shops.update', $shop->id) }}" method="POST" enctype="multipart/form-data">
                                <input type="hidden" name="_method" value="PATCH">
                                @csrf
                                <div class="form-box-content p-3">
                                    <div class="row">
                                        <label class="col-md-2 col-form-label">{{ translate('Facebook') }}</label>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control mb-3" placeholder="{{ translate('Facebook')}}" name="facebook" value="{{ $shop->facebook }}">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label class="col-md-2 col-form-label">{{ translate('Twitter') }}</label>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control mb-3" placeholder="{{ translate('Twitter')}}" name="twitter" value="{{ $shop->twitter }}">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label class="col-md-2 col-form-label">{{ translate('Google') }}</label>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control mb-3" placeholder="{{ translate('Google')}}" name="google" value="{{ $shop->google }}">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label class="col-md-2 col-form-label">{{ translate('Youtube') }}</label>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control mb-3" placeholder="{{ translate('Youtube')}}" name="youtube" value="{{ $shop->youtube }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group mb-0 text-right">
                                    <button type="submit" class="btn btn-sm btn-primary">{{translate('Save')}}</button>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>



@endsection
@section('style')

 <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
</style>
@endsection

@section('script')
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<script type="text/javascript">
    
     $(document).ready(function() {
    $('.js-example-basic-multiple').select2();
});
</script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
 
@endsection
