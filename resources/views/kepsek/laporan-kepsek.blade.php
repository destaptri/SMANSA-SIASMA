@extends('layouts.kepsek')
@section('content')
<div class="search-content">
    <h4>Laporan Data Alumni</h4>
    <div class="container-search">
        <div class="d-flex align-items-center gap-3">
            <!-- Search Input -->
            <form class="search-box flex-grow-1" method="GET" action="{{ route('kepsek.laporan') }}">
                <div class="input-group">
                    <input class="form-control" type="search" name="search" placeholder="Cari Data Alumni..."
                        value="{{ request('search') }}" aria-label="Search">
                    <button class="btn btn-outline-secondary flex-grow-2" type="submit">
                        <i class="bi bi-search"></i>
                    </button>
                </div>
                <!-- Hidden inputs for selected columns -->
                @foreach($selectedColumns as $column)
                <input type="hidden" name="columns[]" value="{{ $column }}">
                @endforeach
            </form>

            <!-- Filter Dropdown -->
            <!-- Filter Dropdown -->
            <div class="filter position-relative">
                <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownFilterButton">
                    Pilih Kolom
                </button>

                <div class="dropdown-menu" id="filterMenu">
                    <h6>Pilih Kolom</h6>
                    <form id="columnForm" action="{{ route('kepsek.laporan') }}" method="GET">
                        @if(request('search'))
                        <input type="hidden" name="search" value="{{ request('search') }}">
                        @endif
                        <div class="custom-checkbox-group">
                            <!-- Required columns (disabled and always checked) -->
                            <div class="custom-checkbox">
                                <input type="checkbox" id="nisn" value="nisn" checked disabled>
                                <label for="nisn">NISN</label>
                            </div>
                            <div class="custom-checkbox">
                                <input type="checkbox" id="nama_lengkap" value="nama_lengkap" checked disabled>
                                <label for="nama_lengkap">Nama Lengkap</label>
                            </div>

                            <!-- Optional columns -->
                            @foreach($availableColumns as $value => $label)
                            <div class="custom-checkbox">
                                <input type="checkbox" name="columns[]" id="{{ $value }}"
                                    value="{{ $value }}"
                                    {{ in_array($value, $selectedColumns) ? 'checked' : '' }}>
                                <label for="{{ $value }}">{{ $label }}</label>
                            </div>
                            @endforeach
                        </div>
                        <button type="submit" class="btn apply-btn" id="applyBtn">Terapkan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row pencarian">
        <div class="col-lg-12">
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            @foreach($selectedColumns as $column)
                            <th>{{ $allColumns[$column] }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody id="resultBody">
                        @forelse($alumni as $data)
                        <tr>
                            @foreach($selectedColumns as $column)
                            <td data-label="{{ $allColumns[$column] }}">
                                {{ $data->$column }}
                            </td>
                            @endforeach
                        </tr>
                        @empty
                        <tr>
                            <td colspan="{{ count($selectedColumns) }}" class="text-center">
                                Tidak ada data yang ditemukan
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="export d-flex justify-content-end align-items-center mt-2">
        <form action="{{ route('kepsek.laporan.export') }}" method="GET">
            @if(request('search'))
            <input type="hidden" name="search" value="{{ request('search') }}">
            @endif
            @foreach($selectedColumns as $column)
            <input type="hidden" name="columns[]" value="{{ $column }}">
            @endforeach
            <button type="submit" class="btn" style="background-color: #083579; color: white;">
                Export As Excel
            </button>
        </form>
    </div>

    <div class="pagination">
        {{ $alumni->links() }}
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const columnForm = document.getElementById('columnForm');
        const checkboxes = columnForm.querySelectorAll('input[type="checkbox"]:not([disabled])');
        const dropdownButton = document.getElementById('dropdownFilterButton');
        const filterMenu = document.getElementById('filterMenu');
        let isDropdownOpen = false;
    });

    // Toggle dropdown manually
    dropdownButton.addEventListener('click', function(e) {
        e.stopPropagation();
        isDropdownOpen = !isDropdownOpen;
        if (isDropdownOpen) {
            filterMenu.classList.add('show');
            dropdownButton.setAttribute('aria-expanded', 'true');
        } else {
            filterMenu.classList.remove('show');
            dropdownButton.setAttribute('aria-expanded', 'false');
        }
    });

    // Close dropdown when clicking outside
    document.addEventListener('click', function(e) {
        if (!filterMenu.contains(e.target) && !dropdownButton.contains(e.target)) {
            filterMenu.classList.remove('show');
            dropdownButton.setAttribute('aria-expanded', 'false');
            isDropdownOpen = false;
        }
    });

    // Prevent dropdown from closing when clicking inside
    filterMenu.addEventListener('click', function(e) {
        if (e.target.id !== 'applyBtn') {
            e.stopPropagation();
        }
    });

    document.addEventListener('DOMContentLoaded', function() {
        const columnForm = document.getElementById('columnForm');
        const checkboxes = columnForm.querySelectorAll('input[type="checkbox"]:not([disabled])');

        // Function to count selected checkboxes (excluding required ones)
        function countSelectedColumns() {
            return Array.from(checkboxes)
                .filter(cb => cb.checked)
                .length;
        }

        checkboxes.forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                if (this.checked && countSelectedColumns() > 4) { // 4 optional + 2 required = 6 total
                    this.checked = false;
                    alert('Maksimal 6 kolom yang dapat dipilih (termasuk NISN dan Nama Lengkap)');
                }
            });
        });

        // Handle form submission
        columnForm.addEventListener('submit', function() {
            bsDropdown.hide(); // Hide dropdown when form is submitted
        });

        // Prevent dropdown from closing when clicking checkboxes
        const checkboxContainers = document.querySelectorAll('.custom-checkbox');
        checkboxContainers.forEach(container => {
            container.addEventListener('click', function(e) {
                e.stopPropagation();
            });
        });

    });
</script>
@endsection