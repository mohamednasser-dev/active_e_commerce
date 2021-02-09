@extends('backend.layouts.app')

@section('content')

<div class="aiz-titlebar text-left mt-2 mb-3">
    <div class="row align-items-center">
        <div class="col-md-6">
            <h1 class="h3">{{translate('All sellerstypes')}}</h1>
        </div>
        <div class="col-md-6 text-md-right">
            <a href="{{ route('sellerstype.create') }} " class="btn btn-circle btn-info">
                <span>{{translate('Add New seller type')}}</span>
            </a>
        </div>
    </div>
</div>
<br>
<div class="card">
    <div class="card-header">
        <h5 class="mb-0 h6">{{translate('sellerstypes')}}</h5>
        <div class="pull-right clearfix">
            <form class="" id="sort_sellerstypes" action="" method="GET">
                <div class="box-inline pad-rgt pull-left">
                    <div class="" style="min-width: 200px;">
                        <input type="text" class="form-control" id="search" name="search"@isset($sort_search) value="{{ $sort_search }}" @endisset placeholder="{{ translate('Type email or name & Enter') }}">
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="card-body">
        <table class="table aiz-table mb-0">
            <thead>
                <tr>
                    <th>#</th>
                    <th>{{translate('name')}}</th>
                    <th> {{translate('action')}}</th>
                   
                    
                </tr>
            </thead>
            <tbody>
                @foreach($sellerstypes as $key => $sellerstype)
                   
                        <tr>
                            <td>{{ ($key+1) + ($sellerstypes->currentPage() - 1)*$sellerstypes->perPage() }}</td>
                            <td>{{$sellerstype->name}}</td>
                     
                            
                             
                            <td class="text-right">
                               
                                <a href="{{route('sellerstype.edit',$sellerstype->id)}}" class="btn btn-soft-primary btn-icon btn-circle btn-sm" title="{{ translate('edit customer') }}">
                                   <i class="las la-edit"></i>
                               </a>
                           
                                   
                            
                              
                               <a href="#" class="btn btn-soft-danger btn-icon btn-circle btn-sm confirm-delete" data-href="{{url('/admin/sellerstypedelet')}}/{{$sellerstype->id}}" title="{{ translate('Delete') }}">
                                   <i class="las la-trash"></i>
                               </a>
                           </td>
                        </tr>
                     
                @endforeach
            </tbody>
        </table>
        <div class="aiz-pagination">
            {{ $sellerstypes->appends(request()->input())->links() }}
        </div>
    </div>
</div>


<div class="modal fade" id="confirm-ban">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title h6">{{translate('Confirmation')}}</h5>
                <button type="button" class="close" data-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>{{translate('Do you really want to ban this Customer?')}}</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-dismiss="modal">{{translate('Cancel')}}</button>
                <a type="button" id="confirmation" class="btn btn-primary">{{translate('Proceed!')}}</a>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="confirm-unban">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title h6">{{translate('Confirmation')}}</h5>
                <button type="button" class="close" data-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>{{translate('Do you really want to unban this Customer?')}}</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-dismiss="modal">{{translate('Cancel')}}</button>
                <a type="button" id="confirmationunban" class="btn btn-primary">{{translate('Proceed!')}}</a>
            </div>
        </div>
    </div>
</div>
@endsection

@section('modal')
    @include('modals.delete_modal')
@endsection

@section('script')
    <script type="text/javascript">
        function sort_sellerstypes(el){
            $('#sort_sellerstypes').submit();
        }
        function confirm_ban(url)
        {
            $('#confirm-ban').modal('show', {backdrop: 'static'});
            document.getElementById('confirmation').setAttribute('href' , url);
        }

        function confirm_unban(url)
        {
            $('#confirm-unban').modal('show', {backdrop: 'static'});
            document.getElementById('confirmationunban').setAttribute('href' , url);
        }
    </script>
@endsection
