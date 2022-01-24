<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ !empty($pageTitle)?$pageTitle.' | ':'' }}{{ config('app.name', 'Appeal') }}</title>
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/apealLogo.png') }}">

    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <style type="text/css">
      .brand-link {
        font-size: 2.25rem;
      }
    </style>

   
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<!-- <div class="loader">
  <img class="loader_img" src="{{ asset('/storage/images/loader.gif') }}">
</div>  
<div class='progresstop' id="progress_div">
  <div class='bar' id='bar1'></div>
  <div class='percent' id='percent1'></div>
</div>
<input type="hidden" id="progress_width" value="0"> -->
<div class="wrapper">

  <!-- Header -->
  @include('header')

  <!-- Sidebar -->

  @include('sidebar')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">@yield('title')</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
               <?php $segments = ''; ?>
                @foreach(Request::segments() as $segment)
                    <?php $segments .= '/'.$segment; ?>
                    <li class="breadcrumb-item active">
                        {{ucwords($segment)}}
                    </li>
                @endforeach
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content-header -->

    @yield('content')

    <!-- /.content -->
  </div>

   <!-- Footer -->
  @include('footer')

</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->

<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
<script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('js/custom.js') }}"></script>
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true,
      "autoWidth": false,
    });
  });
</script>

<script type="text/javascript">
    $(document).ready(function(){
        $(".edit_close").click(function(){
            $('#exampleModal').modal('hide');
        });
        $(".delete_close").click(function(){
            $('#deleteModel').modal('hide');
        });
    });
</script>



<!-- Add subscripion script start -->
 <script>
         jQuery(document).ready(function(){
            jQuery('#ajaxSubmit').click(function(e){

               e.preventDefault();
               $.ajaxSetup({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                  }
              });
               jQuery.ajax({
                  url: "{{ route('subscription_plan.store') }}",
                  method: 'post',
                  data: {
                     price: jQuery('#add_price').val(),
                     month: jQuery('#add_month').val(),
                     description: jQuery('#add_description').val(),
                     "_token": "{{ csrf_token() }}"
                  },
                  success: function(result){
                    //alert(JSON.stringify(result,null,4))
                    if(result.errors)
                    {
                        jQuery('#add_error_show').html('');

                        jQuery.each(result.errors, function(key, value){
                            jQuery('#add_error_show').show();
                            jQuery('#add_error_show').append('<li>'+value+'</li>');
                        });
                    }
                    else
                    {
                        jQuery('#add_error_show').hide();
                        $('#open').hide();
                        $('#exampleModal_add').modal('hide');

                         var url ="{{ route('subscription_plan.index') }}"; //the url I want to redirect to
                            $(location).attr('href', url);
                            //location.reload();
                    }
                  }});
               });
            });

         setTimeout(function () {
            $('#alert').alert('close');
        }, 5000);

      </script>

<!-- Add subscripion script end -->



<!-- Delete subscripion script start -->

      <script type="text/javascript">

             $(".deleteRecord").click(function(){
                id = $(this).data("id");
                $("#id").val(id);
                $("#deleteModel").modal("show");
            });

             $(".deleteData").click(function(){
                var id= $("#id").val();
                var token = $("meta[name='csrf-token']").attr("content");
                var destroy_url = '{{ route("subscription_plan.destroy", ":id") }}';
                    route_url = destroy_url.replace(':id', id);
            
                $.ajax(
                {
                    url: route_url,
                    type: 'DELETE',
                    data: {
                        "id": id,
                        "_token": token,
                    },
                    success: function (){

                        var url ="{{ route('subscription_plan.index') }}"; //the url I want to redirect to
                            $(location).attr('href', url);
                        //alert("Record Deleted Succesfully");
                    }
                });
               
            });

      </script>

<!-- Delete subscripion script end -->

<!-- Edit subscripion script start -->

      <script type="text/javascript">

            $(".subscrptionEdit").click(function(){
                var price=$(this).data("price");
                var month=$(this).data("month");
                var description=$(this).data("description");
                var id=$(this).data("id");

                $("#price").val(price);
                $("#month").val(month);
                $("#description").val(description);
                $("#update_id").val(id);
               
               $("#exampleModal").modal('show');        
            });



          jQuery('#editSubscriptionPlan').click(function(e){

                var price= $("#price").val();
                var month= $("#month").val();
                var description= $("#description").val();
                var id= $("#update_id").val();

                var update_url = '{{ route("subscription_plan.update", ":id") }}';
                    update_route_url = update_url.replace(':id', id);
                    //alert(update_route_url);

               
                //alert("hello")
               e.preventDefault();
               $.ajaxSetup({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                  }
              });
               jQuery.ajax({
                  url: update_route_url,
                  method: 'PUT',
                  data: {
                     id: id,
                     price: price,
                     month: month,
                     description: description,
                     "_token": "{{ csrf_token() }}"

                     //score: jQuery('#score').val(),
                  },
                  success: function(result){
                    //alert(JSON.stringify(result,null,4))
                    if(result.errors)
                    {
                        jQuery('#show_edit_error').html('');

                        jQuery.each(result.errors, function(key, value){
                            jQuery('#show_edit_error').show();
                            jQuery('#show_edit_error').append('<li>'+value+'</li>');
                        });
                    }
                    else
                    {
                        jQuery('#show_edit_error').hide();
                        $('#open').hide();
                        $('#exampleModal').modal('hide');

                         var url ="{{ route('subscription_plan.index') }}"; //the url I want to redirect to
                            $(location).attr('href', url);
                            //location.reload();
                    }
                  }});
               });


      </script>

</body>
</html>
