@extends('layouts.admin')
@section('content')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{route('admin.create_category')}}">
               create category
            </a>
        </div>
    </div>
<div class="card">
    <div class="card-header">
        list category 
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Category">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            category id
                        </th>
                        <th>
                            category parent
                        </th>
                        <th>
                            category title
                        </th>
                        <th>
                            category description
                        </th>
                        <th>
                            category image
                        </th>

                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($categories as $key => $category)
                        <tr data-entry-id="{{ $category->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $category->id ?? '' }}
                            </td>
                            <td>
                                {{ $category->parent_id ?? '' }}
                            </td>
                            <td>
                                {{ $category->title ?? '' }}
                            </td>
                            <td>
                                {{ $category->description ?? '' }}
                            </td>
                            <td>
                                @if($category->image)

                                    <a href="{{ $category->image->getUrl() }}" target="_blank">
                                        <img src="{{ $category->image->getUrl('thumb') }}" width="50px" height="50px">
                                    </a>
                                @endif
                            </td>
                            <td>
                                
                                    <a class="btn btn-xs btn-primary" href="{{url('admin/category/edit/'.$category->id)}}" >
                                        edit
                                    </a>
                                
                                    
                                
                                    <form action="{{url('admin/category/delete/'.$category->id)}}" method="POST" onsubmit="return confirm('areYouSure');" style="display: inline-block;">
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
