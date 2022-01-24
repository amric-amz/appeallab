<!-- Extends template page-->
@extends('app')

@section('title', 'Subscription Plans')

<!-- Specify content -->
@section('content')

<section class="content">
    <div class="container-fluid">

        @if (session()->has('success'))
                    <div class="alert alert-success alert-solid alert-dismissible shadow-sm p-3 mb-5 rounded" 
                    role="alert" id="alert">
                    {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                @endif


        <div class="row">
            <div class="col-12">
              <div class="card">
                @if(Session::has('message'))
                  <div class="alert {{ Session::get('alert-class') }}">
                     {{ Session::get('message') }}
                  </div>
                @endif
                <div class="card-header">
                    <button type="button" class="btn btn-sm btn-primary float-right" data-toggle="modal" data-target="#exampleModal_add" data-whatever="@mdo">Add Subscription</button>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <table id="example2" class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>PRICE</th>
                        <th>MONTH</th>
                        <th>DESCRIPTION</th>
                        <th>ACTION</th>
                    </tr>
                    </thead>
                    <tbody>
                        @php
                            $index=1;
                        @endphp
                        @foreach($subscription_plans as $subscriptions)
                            
                            <tr>
                                <td>{{ $index }}</td>
                                <td>{{ $subscriptions->price }}</td>
                                <td>{{ $subscriptions->month }}</td>
                                <td>{{ $subscriptions->description }}</td>
                                <td>
                                   <!-- Edit -->
                                   <a href="javascript:void(0);" class="btn btn-sm btn-primary subscrptionEdit" data-price="{{ $subscriptions->price }}" data-month="{{ $subscriptions->month }}" data-description="{{ $subscriptions->description }}" data-id="{{ $subscriptions->id }}">Edit</a>
                                   <!-- Delete -->
                                   <a href="javascript:void(0);" class="btn btn-sm btn-danger deleteRecord" data-id="{{ $subscriptions->id }}">Delete</a>
                                </td>
                            </tr>
                            @php
                                $index++ ;
                            @endphp
                        @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
        </div>
    </div>
</section>

<!-- Edit Subscription pop-up  start -->

<div class="modal fade" id="exampleModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Subscription Plan</h5>
        <button type="button" class="close edit_close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="alert alert-danger" id="show_edit_error" style="display:none"></div>

      <div class="modal-body">
        <form>
          <div class="form-group">
            <label for="price" class="col-form-label">Price:</label>
            <input type="text" class="form-control" id="price" name="price" value="">
          </div>
          <div class="form-group">
            <select class="form-select form-control" aria-label="Default select example" name="month" id="month">
                <option value="" selected>Month</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
                <option value="9">9</option>
                <option value="10">10</option>
                <option value="11">11</option>
                <option value="12">12</option>
            </select>
            </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label">Description:</label>
            <textarea class="form-control" id="description" name="description"></textarea>
          </div>
          <div>
              <input type="hidden" value="" name="update_id" id="update_id">
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary edit_close" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="editSubscriptionPlan">Edit</button>
      </div>
    </div>
  </div>
</div>

<!-- Edit Subscription pop-up  end -->


<!-- Add Subscription pop-up  start -->

<div class="modal fade" id="exampleModal_add" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel_add" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel_add">Add Subscription Plan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="alert alert-danger" id="add_error_show" style="display:none"></div>
      <div class="modal-body">
        <form>
          <div class="form-group">
            <label for="add_price" class="col-form-label">Price:</label>
            <input type="text" name="add_price" class="form-control" id="add_price" value="">
          </div>
          <div class="form-group">
            <select class="form-select form-control" aria-label="Default select example" name="add_month" id="add_month">
                <option value="" selected>Month</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
                <option value="9">9</option>
                <option value="10">10</option>
                <option value="11">11</option>
                <option value="12">12</option>
            </select>
            </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label">Description:</label>
            <textarea class="form-control" name="add_description" id="add_description"></textarea>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="ajaxSubmit">Add Subscription</button>
      </div>
    </div>
  </div>
</div>

<!-- Add Subscription pop-up  end -->


<!-- Delete pop-up start -->

<div class="modal fade" id="deleteModel" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteModalLabel">Delete Record</h5>
        <button type="button" class="close delete_close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Are you sure you want to Delete this Record</p>
        <input type="hidden" name="" value="" id="id">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary delete_close" data-dismiss="modal">No</button>
        <button type="button" class="btn btn-primary deleteData" data-yes="1">Yes</button>
      </div>
    </div>
  </div>
</div>

@stop
<!-- Delete pop-up end -->

<!-- Add subscripion script start -->
@push('scripts')

    
@endpush