@extends('Layouts.user_index')

@section('JudulHalaman', 'Akun Setting')
@section('HeaderPage', 'Profile')

@section('AkunSetting')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">
                    <div class="card card-navy card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <img class="profile-user-img img-fluid img-circle"
                                    src="{{ asset('adminlte/dist/img/default_pfp.jpg') }}" alt="User profile picture">
                            </div>
                            <h3 class="profile-username text-center">{{ $user->name }}</h3>
                            <p class="text-muted text-center"></p>
                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                    <b>Nama Lengkap</b>
                                    <p class="float-right">{{ $siswa->nama }}</p>
                                </li>
                                <li class="list-group-item">
                                    <b>No HP</b>
                                    <p class="float-right">{{ $siswa->no_hp }}</p>
                                </li>
                                <li class="list-group-item">
                                    <b>Jenis Kelamin</b>
                                    <p class="float-right">{{ $siswa->jenis_kelamin }}</p>
                                </li>
                                <li class="list-group-item">
                                    <b>Alamat</b>
                                    <p class="float-right">{{ $siswa->alamat }}</p>
                                </li>
                                <li class="list-group-item">
                                    <b>Kelas</b>
                                    <p class="float-right">{{ $siswa->kelas->ruang_kelas }}</p>
                                </li>
                            </ul>
                            <a href="" class="btn btn-dark btn-block"><b>Edit Profile</b></a>
                        </div>
                    </div>
                </div>
                <!-- /.cool -->
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills">
                                <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">SPP</a>
                                </li>
                                <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Timeline</a>
                                </li>
                                <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Settings</a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="active tab-pane" id="activity">
                                    <div class="col-md-12">
                                        <div class="card bg-light mb-3 shadow">
                                            <div class="card-header text-white bg-navy">Biaya SPP Yang Harus di Bayarkan
                                                Siswa</div>
                                            <div class="card-body d-flex flex-column">
                                                @if ($biaya_spp)
                                                    <p class="card-text" style="font-size: 1.5rem; margin-bottom:">Biaya Spp
                                                        yang harus dibayarkan</p>
                                                    <h3 class="card-title font-weight-bold"
                                                        style="font-size: 1.5rem; margin-bottom: 20px;">Rp
                                                        {{ number_format($biaya_spp->harga_spp, 2, ',', '.') }}</h3>
                                                    <form action="{{ Route('proses-checkout') }}" method="POST">
                                                        <div class="d-flex justify-content-start">
                                                            <button id="pay-button" class="btn btn-primary">Bayar</button>
                                                        </div>
                                                    </form>
                                                @else
                                                    <p class="card-text">Belum ada biaya SPP yang ditetapkan.</p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Tabel Pembuatan Pembayaran SPP -->
                                <div class="row">
                                    <div class="col-12">
                                        <div class="card card-navy">
                                            <div class="card-header">
                                                <h3 class="card-title">Tabel Data Pembayaran SPP</h3>
                                            </div>
                                            <div class="card-body">
                                                <table id="example1" class="table table-bordered table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th>Bulan</th>
                                                            <th>Tahun Ajaran</th>
                                                            <th>Nominal</th>
                                                            <th>Status</th>
                                                            <th>Aksi</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($data_pembayaran as $item)
                                                            <tr>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td>
                                                                    <div class="btn-group" role="group">
                                                                        <!-- Tombol Edit -->
                                                                        <button type="button"
                                                                            class="btn btn-warning btn-sm mr-3"
                                                                            data-toggle="modal" data-target="#editModal">
                                                                            <i class="fas fa-edit"></i>
                                                                        </button>
                                                                        <form action="" method="POST">
                                                                            @csrf
                                                                            @method('DELETE')
                                                                            <button type="submit"
                                                                                class="btn btn-danger btn-sm"
                                                                                onclick="return confirm('Are you sure?')">
                                                                                <i class="fas fa-trash"></i>
                                                                            </button>
                                                                        </form>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- Timeline --}}
                                <div class="tab-pane" id="timeline">
                                    <div class="timeline timeline-inverse">
                                        <div class="time-label">
                                            <span class="bg-danger">
                                                10 Feb. 2014
                                            </span>
                                        </div>
                                        <div>
                                            <i class="fas fa-envelope bg-primary"></i>
                                            <div class="timeline-item">
                                                <span class="time"><i class="far fa-clock"></i> 12:05</span>
                                                <h3 class="timeline-header"><a href="#">Support Team</a> sent you an
                                                    email</h3>
                                                <div class="timeline-body">
                                                    Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles,
                                                    weebly ning heekya handango imeem plugg dopplr jibjab, movity
                                                    jajah plickers sifteo edmodo ifttt zimbra. Babblely odeo kaboodle
                                                    quora plaxo ideeli hulu weebly balihoo...
                                                </div>
                                                <div class="timeline-footer">
                                                    <a href="#" class="btn btn-primary btn-sm">Read more</a>
                                                    <a href="#" class="btn btn-danger btn-sm">Delete</a>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- END timeline item -->
                                        <!-- timeline item -->
                                        <div>
                                            <i class="fas fa-user bg-info"></i>

                                            <div class="timeline-item">
                                                <span class="time"><i class="far fa-clock"></i> 5 mins ago</span>

                                                <h3 class="timeline-header border-0"><a href="#">Sarah Young</a>
                                                    accepted your friend request
                                                </h3>
                                            </div>
                                        </div>
                                        <!-- END timeline item -->
                                        <!-- timeline item -->
                                        <div>
                                            <i class="fas fa-comments bg-warning"></i>

                                            <div class="timeline-item">
                                                <span class="time"><i class="far fa-clock"></i> 27 mins ago</span>

                                                <h3 class="timeline-header"><a href="#">Jay White</a> commented on
                                                    your post</h3>

                                                <div class="timeline-body">
                                                    Take me to your leader!
                                                    Switzerland is small and neutral!
                                                    We are more like Germany, ambitious and misunderstood!
                                                </div>
                                                <div class="timeline-footer">
                                                    <a href="#" class="btn btn-warning btn-flat btn-sm">View
                                                        comment</a>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- END timeline item -->
                                        <!-- timeline time label -->
                                        <div class="time-label">
                                            <span class="bg-success">
                                                3 Jan. 2014
                                            </span>
                                        </div>
                                        <!-- /.timeline-label -->
                                        <!-- timeline item -->
                                        <div>
                                            <i class="fas fa-camera bg-purple"></i>

                                            <div class="timeline-item">
                                                <span class="time"><i class="far fa-clock"></i> 2 days ago</span>

                                                <h3 class="timeline-header"><a href="#">Mina Lee</a> uploaded new
                                                    photos</h3>

                                                <div class="timeline-body">
                                                    <img src="https://placehold.it/150x100" alt="...">
                                                    <img src="https://placehold.it/150x100" alt="...">
                                                    <img src="https://placehold.it/150x100" alt="...">
                                                    <img src="https://placehold.it/150x100" alt="...">
                                                </div>
                                            </div>
                                        </div>
                                        <!-- END timeline item -->
                                        <div>
                                            <i class="far fa-clock bg-gray"></i>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.tab-pane -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
