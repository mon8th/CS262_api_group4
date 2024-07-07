@extends('layouts.app')

@section('title', 'Dashboard - Cambo Events')

@section('content')
<div class="pagetitle">
  <h1>Dashboard</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
      <li class="breadcrumb-item active">Dashboard</li>
    </ol>
  </nav>
</div><!-- End Page Title -->

<section class="section dashboard">
  <div class="row">
    <div class="col-lg-12">
      <div class="row">
        <!-- Total Users Card -->
        <div class="col-xxl-4 col-md-6">
          <div class="card info-card">
            <div class="card-body">
              <h5 class="card-title">Total Users</h5>
              <div class="d-flex align-items-center">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center bg-light">
                  <i class="bi bi-people text-primary"></i>
                </div>
                <div class="ps-3">
                  <h6>{{ $totalUsers }}</h6>
                </div>
              </div>
            </div>
          </div>
        </div><!-- End Total Users Card -->

        <!-- Total Orders Card -->
        <div class="col-xxl-4 col-md-6">
          <div class="card info-card">
            <div class="card-body">
              <h5 class="card-title">Total Orders</h5>
              <div class="d-flex align-items-center">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center bg-light">
                  <i class="bi bi-box-seam text-info"></i>
                </div>
                <div class="ps-3">
                  <h6>{{ $totalOrders }}</h6>
                </div>
              </div>
            </div>
          </div>
        </div><!-- End Total Orders Card -->

        <!-- Total Sales Card -->
        <div class="col-xxl-4 col-md-6">
          <div class="card info-card">
            <div class="card-body">
              <h5 class="card-title">Total Sales</h5>
              <div class="d-flex align-items-center">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center bg-light">
                  <i class="bi bi-currency-dollar text-success"></i>
                </div>
                <div class="ps-3">
                  <h6>${{ $totalSales }}</h6>
                </div>
              </div>
            </div>
          </div>
        </div><!-- End Total Sales Card -->
      </div>

      <!-- Sales Chart -->
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Sales</h5>
              <div id="salesChart"></div>
            </div>
          </div>
        </div>
      </div>
      <!-- End Sales Chart -->

      <!-- Deals Details -->
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Deals Details</h5>
              <table class="table table-borderless">
                <thead>
                  <tr>
                    <th scope="col">Image</th>
                    <th scope="col">Product Name</th>
                    <th scope="col">Category</th>
                    <th scope="col">Date - Time</th>
                    <th scope="col">Piece</th>
                    <th scope="col">Amount</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($deals as $deal)
                  <tr>
                    <td>
                        @if($deal->image)
                          <img src="{{ asset('storage/' . $deal->image) }}" alt="{{ $deal->name }}" class="img-thumbnail" width="50">
                        @else
                          <img src="{{ asset('storage/images/default.png') }}" alt="Default Image" class="img-thumbnail" width="50">
                        @endif
                      </td>
                    <td>{{ $deal->name}}</td>
                    <td>{{ $deal->category }}</td>
                    <td>{{ $deal->created_at->format('d.m.Y - h:i A') }}</td>
                    <td>{{ $deal->quantity }}</td>
                    <td>${{ $deal->price }}</td>
                    <td>
                      @if($deal->status == 'Delivered')
                        <span class="badge bg-success">{{ $deal->status }}</span>
                      @elseif($deal->status == 'Pending')
                        <span class="badge bg-warning">{{ $deal->status }}</span>
                      @else
                        <span class="badge bg-danger">{{ $deal->status }}</span>
                      @endif
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
      <!-- End Deals Details -->
    </div>
  </div>
</section>

<!-- Include ApexCharts Library -->
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script>
document.addEventListener("DOMContentLoaded", function () {
  var options = {
    series: [{
      name: "Sales",
      data: @json($salesData->pluck('total'))
    }],
    chart: {
      height: 350,
      type: 'line'
    },
    stroke: {
      width: 2
    },
    xaxis: {
      categories: @json($salesData->pluck('date'))
    },
    tooltip: {
      x: {
        format: 'dd MMM, yyyy'
      }
    }
  };

  var chart = new ApexCharts(document.querySelector("#salesChart"), options);
  chart.render();
});
</script>
@endsection
