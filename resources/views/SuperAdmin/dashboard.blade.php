@extends('Layouts.index')

@section('JudulHalaman', 'Dashboard')

@section('Dashboard')
    <section class="content">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-12">
                <!-- small card -->
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>150</h3>
                        <p>SISWA</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-shopping-cart"></i>
                    </div>
                    <a href="#" class="small-box-footer">
                        More info <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-6 col-md-6 col-12">
                <!-- small card -->
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>53<sup style="font-size: 20px">%</sup></h3>
                        <p>KELAS</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                    <a href="#" class="small-box-footer">
                        More info <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-6 col-md-6 col-12">
                <!-- small card -->
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3>44</h3>
                        <p>LAPORAN</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-user-plus"></i>
                    </div>
                    <a href="#" class="small-box-footer">
                        More info <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-6 col-md-6 col-12">
                <!-- small card -->
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3>65</h3>
                        <p>PEMBAYARAN</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-chart-pie"></i>
                    </div>
                    <a href="#" class="small-box-footer">
                        More info <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
            <!-- ./col -->
        </div>
    </section>
@endsection
