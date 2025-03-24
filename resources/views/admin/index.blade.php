@extends('admin.layouts.main')

@section('title', 'Beranda Admin | Catering Nizam')

@push('styles')
    <style>
.custom-card {
    border: none;
    color: #fff;
    border-radius: 10px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
}

.bg-gradient-warning {
    background: linear-gradient(45deg, #f4cd4f, #fda085);
}

.bg-gradient-success {
    background: linear-gradient(45deg, #42e695, #3bb2b8);
}

.small-box .icon i {
        transition: transform 0.3s ease, color 0.3s ease, box-shadow 0.3s ease;
    }

    .small-box:hover .icon i {
        transform: scale(1.2); /* Membesarkan ikon */
        color: #000; /* Mengubah warna ikon saat hover */
    }

    /* Efek hover untuk kotak kecil */
    .small-box:hover {
        background-color: rgba(0, 0, 0, 0.1); /* Memberikan efek latar belakang */
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1); /* Memberikan bayangan pada kotak */
    }

     /* Menyorot tanggal hari ini dengan latar belakang biru */
  .fc-day-today {
    background-color: #0093E9;
background-image: linear-gradient(160deg, #0093E9 0%, #80D0C7 100%);

  }

   /* Kursor tangan pada event */
   .fc-event {
    cursor: pointer;
  }

  .calendar-container {
  min-height: 400px;
  max-height: 400px;
  font-size: 0.8em; /* Mengatur ukuran font lebih kecil */
}

.fc-toolbar {
  font-size: 0.9em;
}

.fc .fc-button {
  padding: 5px 10px;
}

.fc-daygrid-day {
  height: 50px;
}


  .fc-day-today .fc-day-number {
    font-weight: bold; /* Menebalkan angka tanggal hari ini */
    color: white !important; /* Warna angka tanggal hari ini menjadi putih */
  }

  .holiday {
    background-color: rgba(255, 0, 0, 0.2); /* Merah tipis untuk hari libur nasional */
    color: white; /* Mengubah teks menjadi putih untuk kontras */
  }


  .sunday {
    background: #e43a15;  /* fallback for old browsers */
background: -webkit-linear-gradient(to right, #e65245, #e43a15);  /* Chrome 10-25, Safari 5.1-6 */
background: linear-gradient(to right, #e65245, #e43a15); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
 /* Merah tipis untuk hari Minggu */
  }

    </style>
@endpush


@section('content-header')
@if(session('info'))
    <div class="alert alert-info">
        {{ session('info') }}
    </div>
@endif

    <div class="row">
        <div class="col-sm-6">
            <h3 class="mb-0">Beranda</h3>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-end">
                <li class="breadcrumb-item"><a href="#">Beranda</a></li>
                <li class="breadcrumb-item active" aria-current="page">
                    Beranda
                </li>
            </ol>
        </div>
    </div>

<!-- Statistik Jumlah Menu, Pesanan, Admin -->
<div class="row mt-4">
  <!-- Jumlah Menu -->
  <div class="col-xl-4 col-lg-4 col-md-6 col-6 mb-4">
      <div class="small-box bg-info d-flex flex-column justify-content-between h-100">
          <div class="d-flex align-items-center justify-content-between p-3">
              <div>
                  <h3>{{ $menuCount }}</h3> <!-- Jumlah Menu -->
                  <p>Jumlah Menu</p>
              </div>
              <div class="icon">
                  <i class="fas fa-utensils" style="font-size: 4rem;"></i> <!-- Ikon untuk Menu -->
              </div>
          </div>
          <a href="{{ route('admin.menu') }}" class="small-box-footer d-block text-center p-2 text-decoration-none" style="background-color: rgba(0,0,0,0.1); color: white;">
              Lihat Menu <i class="fas fa-arrow-circle-right"></i>
          </a>
      </div>
  </div>

  <!-- Jumlah Pesanan -->
  <div class="col-xl-4 col-lg-4 col-md-6 col-6 mb-4">
      <div class="small-box bg-success d-flex flex-column justify-content-between h-100">
          <div class="d-flex align-items-center justify-content-between p-3">
              <div>
                  <h3>{{ $orderCount }}</h3> <!-- Jumlah Pesanan -->
                  <p>Jumlah Pesanan</p>
              </div>
              <div class="icon">
                  <i class="fas fa-shopping-cart" style="font-size: 4rem;"></i> <!-- Ikon untuk Pesanan -->
              </div>
          </div>
          <a href="{{ route('transaksi') }}" class="small-box-footer d-block text-center p-2 text-decoration-none" style="background-color: rgba(0,0,0,0.1); color: white;">
              Lihat Pesanan <i class="fas fa-arrow-circle-right"></i>
          </a>
      </div>
  </div>

  <!-- Jumlah Admin -->
  <div class="col-xl-4 col-lg-4 col-md-6 col-6 mb-4">
      <div class="small-box bg-warning d-flex flex-column justify-content-between h-100">
          <div class="d-flex align-items-center justify-content-between p-3">
              <div>
                  <h3>{{ $adminCount }}</h3> <!-- Jumlah Admin -->
                  <p>Jumlah Admin</p>
              </div>
              <div class="icon">
                  <i class="fas fa-user-shield" style="font-size: 4rem;"></i> <!-- Ikon untuk Admin -->
              </div>
          </div>
          <a href="{{ route('data.admin') }}" class="small-box-footer d-block text-center p-2 text-decoration-none" style="background-color: rgba(0,0,0,0.1); color: white;">
              Lihat Admin <i class="fas fa-arrow-circle-right"></i>
          </a>
      </div>
  </div>
</div>





<div class="row mt-4">
  <!-- Uang Pemasukan -->
  <div class="col-xl-6 col-lg-6 col-md-12 mb-4">
      <div class="small-box bg-success d-flex flex-column justify-content-between h-100">
          <div class="d-flex align-items-center justify-content-between p-3">
              <div>
                  <h3>Rp {{ number_format($pemasukan, 0, ',', '.') }}</h3>
                  <p>Uang Pemasukan</p>
              </div>
              <div class="icon">
                  <i class="fas fa-money-bill-wave" style="font-size: 4rem;"></i>
              </div>
          </div>
          <a href="#" class="small-box-footer d-block text-center p-2 text-decoration-none" style="background-color: rgba(0,0,0,0.1); color: white;">
              Lihat Pemasukan <i class="fas fa-arrow-circle-right"></i>
          </a>
      </div>
  </div>

  <!-- Uang Pengeluaran -->
  <div class="col-xl-6 col-lg-6 col-md-12 mb-4">
      <div class="small-box bg-danger d-flex flex-column justify-content-between h-100">
          <div class="d-flex align-items-center justify-content-between p-3">
              <div>
                  <h3>Rp {{ number_format($pengeluaran, 0, ',', '.') }}</h3>
                  <p>Uang Pengeluaran</p>
              </div>
              <div class="icon">
                  <i class="fas fa-credit-card" style="font-size: 4rem;"></i>
              </div>
          </div>
          <a href="#" class="small-box-footer d-block text-center p-2 text-decoration-none" style="background-color: rgba(0,0,0,0.1); color: white;">
              Lihat Pengeluaran <i class="fas fa-arrow-circle-right"></i>
          </a>
      </div>
  </div>
</div>

<div class="row mt-4">
  <!-- Pending Orders Card -->
  <div class="col-xl-4 col-lg-4 col-md-6 col-6 mb-4">
      <div class="card custom-card bg-gradient-warning shadow h-100 py-2">
          <div class="card-body">
              <div class="row no-gutters align-items-center">
                  <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-uppercase mb-1">
                          Pending Orders</div>
                      <div class="h5 mb-0 font-weight-bold">{{ $pendingOrders }}</div>
                  </div>
                  <div class="col-auto">
                      <i class="fas fa-hourglass-half fa-2x text-light"></i>
                  </div>
              </div>
          </div>
      </div>
  </div>

  <!-- Successful Orders Card -->
  <div class="col-xl-4 col-lg-4 col-md-6 col-6 mb-4">
      <div class="card custom-card bg-gradient-success shadow h-100 py-2">
          <div class="card-body">
              <div class="row no-gutters align-items-center">
                  <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-uppercase mb-1">
                          Successful Orders</div>
                      <div class="h5 mb-0 font-weight-bold">{{ $successfulOrders }}</div>
                  </div>
                  <div class="col-auto">
                      <i class="fas fa-check-circle fa-2x text-light"></i>
                  </div>
              </div>
          </div>
      </div>
  </div>
</div>

<!-- Calendar Card -->
<div style="display: flex; justify-content: flex-start;">
    <div class="card bg-gradient-success" style="max-width: 400px;">
      <div class="card-header border-0">
          <h3 class="card-title">
              <i class="far fa-calendar-alt"></i> Kalender
          </h3>
      </div>
      <div class="card-body pt-0">
          <!-- Calendar element -->
          <div id="calendar" class="calendar-container"></div>
      </div>
    </div>
  </div>


<div class="row mt-4">
<!-- Grafik Bar untuk Uang Pemasukan dan Pengeluaran per Bulan -->
<div class="card card-primary card-outline">
  <div class="card-header">
      <h3 class="card-title">
          <i class="far fa-chart-bar"></i> Grafik Uang Pemasukan dan Pengeluaran per Bulan
      </h3>
      {{-- <div class="card-tools">
          <button type="button" class="btn btn-tool" data-card-widget="collapse">
              <i class="fas fa-minus"></i>
          </button>
          <button type="button" class="btn btn-tool" data-card-widget="remove">
              <i class="fas fa-times"></i>
          </button>
      </div> --}}
  </div>
  <div class="card-body">
      <canvas id="bar-chart" style="height: 300px;"></canvas>
  </div>
</div>
</div>
@endsection


@push('styles')
@notifyCss
@endpush

@push('scripts')
<x-notify::notify />
@notifyJs
<!-- FullCalendar JS -->
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/locales/id.js"></script> <!-- Menambahkan file bahasa Indonesia -->
<!-- Inisialisasi FullCalendar -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');

    // Fungsi untuk mengambil event dari localStorage
    function getStoredEvents() {
        var storedEvents = localStorage.getItem('calendarEvents');
        return storedEvents ? JSON.parse(storedEvents) : [];
    }

    // Fungsi untuk menyimpan event ke localStorage
    function storeEvents(events) {
        localStorage.setItem('calendarEvents', JSON.stringify(events));
    }

    var calendar = new FullCalendar.Calendar(calendarEl, {
      initialView: 'dayGridMonth',
      locale: 'id', // Bahasa Indonesia
      headerToolbar: {
        left: 'prev,next today',
        center: 'title',
        right: 'dayGridMonth,timeGridWeek,timeGridDay'
      },
      events: getStoredEvents(), // Memuat event dari localStorage
      editable: true,
      selectable: true,
      droppable: true,

      dayCellDidMount: function(info) {
        info.el.style.cursor = 'pointer';
        if (info.dateStr === new Date().toISOString().split('T')[0]) {
          info.el.classList.add('today-highlight');
        }
        if (info.date.getDay() === 0) {
          info.el.classList.add('sunday');
        }
      },

      // Tambah event baru
      dateClick: function(info) {
        var eventTitle = prompt('Masukkan judul event:');
        if (eventTitle) {
          var startDate = prompt('Masukkan tanggal mulai (YYYY-MM-DD):', info.dateStr);
          var endDate = prompt('Masukkan tanggal akhir (YYYY-MM-DD):', info.dateStr);

          if (startDate && endDate) {
            var newEvent = {
              title: eventTitle,
              start: startDate,
              end: endDate,
              allDay: true
            };
            calendar.addEvent(newEvent);

            // Simpan event baru ke localStorage
            var currentEvents = getStoredEvents();
            currentEvents.push(newEvent);
            storeEvents(currentEvents);
          }
        }
      },

      // Edit atau hapus event
      eventClick: function(info) {
        var isEdit = confirm('Ingin mengedit event ini?');
        if (isEdit) {
          var newTitle = prompt('Masukkan judul baru:', info.event.title);
          var newStartDate = prompt('Masukkan tanggal mulai baru (YYYY-MM-DD):', info.event.startStr);
          var newEndDate = prompt('Masukkan tanggal akhir baru (YYYY-MM-DD):', info.event.endStr ? info.event.endStr : info.event.startStr);

          if (newTitle && newStartDate && newEndDate) {
            info.event.setProp('title', newTitle);
            info.event.setDates(newStartDate, newEndDate);

            // Update localStorage dengan event yang telah diedit
            var currentEvents = getStoredEvents();
            currentEvents = currentEvents.map(event =>
              event.start === info.event.startStr && event.title === info.event.title
                ? { ...event, title: newTitle, start: newStartDate, end: newEndDate }
                : event
            );
            storeEvents(currentEvents);
          }
        } else {
          var isDelete = confirm('Ingin menghapus event ini?');
          if (isDelete) {
            info.event.remove();

            // Hapus event dari localStorage
            var currentEvents = getStoredEvents().filter(event =>
              !(event.start === info.event.startStr && event.title === info.event.title)
            );
            storeEvents(currentEvents);
          }
        }
      }
    });

    calendar.render();
});
  </script>

<!-- Chart.js Script -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
  var ctx = document.getElementById('bar-chart').getContext('2d');
  var barChart = new Chart(ctx, {
      type: 'bar',
      data: {
          labels: {!! json_encode($months) !!},  // Nama bulan
          datasets: [
              {
                  label: 'Pemasukan (Rp)',
                  data: {!! json_encode($pemasukanData) !!},  // Data pemasukan
                  backgroundColor: 'rgba(40, 167, 69, 0.6)',  // Hijau
                  borderColor: 'rgba(40, 167, 69, 1)',
                  borderWidth: 1
              },
              {
                  label: 'Pengeluaran (Rp)',
                  data: {!! json_encode($pengeluaranData) !!},  // Data pengeluaran
                  backgroundColor: 'rgba(220, 53, 69, 0.6)',  // Merah
                  borderColor: 'rgba(220, 53, 69, 1)',
                  borderWidth: 1
              }
          ]
      },
      options: {
          responsive: true,
          scales: {
              y: {
                  beginAtZero: true,
                  title: {
                      display: true,
                      text: 'Jumlah Uang (Rp)'
                  }
              },
              x: {
                  title: {
                      display: true,
                      text: 'Bulan'
                  }
              }
          }
      }
  });
</script>
@endpush
