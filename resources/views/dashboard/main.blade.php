<x-templates>
    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="mb-4">
          <h3 class="page-title mb-1">Laporan Pembangunan Gedung Sekolah</h3>

          <p class="text-muted mb-0">
            Monitoring perkembangan pembangunan secara berkala.
          </p>
        </div>

        <!-- PROJECT HEADER -->
        @include('dashboard.header')

        <!-- STATISTICS -->
        @include('dashboard.statistic')

        <div class="row g-4">
          <!-- PROGRESS -->
          @include('dashboard.progress')

          <!-- TIMELINE -->
          @include('dashboard.timeline')
        </div>

</x-templates>