@extends('layouts.admin')
@section('content')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{route('admin.create_product')}}">
               create products
            </a>
        </div>
    </div>
<div class="card">
    <div class="card-header">
        list product 
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Category">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            product id
                        </th>
                        <th>
                            categories of product 
                        </th>
                        <th>
                            product title
                        </th>
                        <th>
                            product slug
                        </th>
                        <th>
                            product price
                        </th>
                        <th>
                            product description
                        </th>
                        <th>
                            product images
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($Products as $key => $product)
                        <tr data-entry-id="{{ $product->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $product->id ?? '' }}
                            </td>
                            <td>
                                @foreach($product->categories as $key => $item)
                                    <span class="badge badge-info">{{ $item->title }}</span>
                                @endforeach
                            </td>
                            <td>
                                {{ $product->title ?? '' }}
                            </td>
                            <td>
                                {{ $product->slug ?? '' }}
                            </td>
                            <td>
                                {{ $product->price ?? '' }}
                            </td>
                            <td>
                                {{ $product->description ?? '' }}
                            </td>
                           <td>
                                @foreach($product->image as $key => $media)
                                    <a href="{{ $media->getUrl() }}" target="_blank">
                                        <img src="{{ $media->getUrl('thumb') }}" width="50px" height="50px">
                                    </a>
                                @endforeach
                            </td>
                            <td>
                                
                                    <a class="btn btn-xs btn-primary" href="{{url('admin/product/edit/'.$product->id)}}" >
                                        edit
                                    </a>
                                
                                    
                                
                                    <form action="{{url('admin/product/delete/'.$product->id)}}" method="POST" onsubmit="return confirm('areYouSure');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger" value="delete">
                                    </form>
                                

                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>



@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)

  let deleteButtonTrans = 'delete'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
      });

      if (ids.length === 0) {
        alert('global.datatables.zero_selected')

        return
      }

      if (confirm('areYouSure?')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)


  $.extend(true, $.fn.dataTable.defaults, {
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  });
  $('.datatable-Category:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
})

</script>
@endsection
