@extends('user.m-user.main')

@section('content')
    <!-- Content body start -->
    <div class="content-body">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="text-primary">My Meetings with Mentors</h4>
                            <hr>

                            <!-- Filter options -->
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <!-- Dropdown to filter by Mentor Name -->
                                <select id="mentorFilter" class="form-control w-25" onchange="filterMeetings()">
                                    <option value="">Select a Mentor</option>
                                    @foreach ($meetings->unique('mentor_id') as $mentor)
                                        <option value="{{ $mentor->mentor_id }}">{{ $mentor->username }}</option>
                                    @endforeach
                                </select>

                                <!-- Dropdown to filter by Status -->
                                <select id="statusFilter" class="form-control w-25 ml-2" onchange="filterMeetings()">
                                    <option value="">Select a Status</option>
                                    <option value="scheduled">Scheduled</option>
                                    <option value="completed">Completed</option>
                                    <option value="cancelled">Cancelled</option>
                                </select>

                                <!-- Button to clear the filters -->
                                <button id="clearFilterBtn" class="btn btn-secondary ml-2" onclick="clearFilter()"
                                    disabled>Clear Filter</button>
                            </div>

                            <!-- Check if there are any meetings -->
                            @if ($meetings->isEmpty())
                                <div class="alert alert-warning" role="alert">
                                    No meetings scheduled yet.
                                </div>
                            @else
                                <div class="table-responsive">
                                    <table class="table table-responsive-sm" id="meetingsTable">
                                        <thead>
                                            <tr>
                                                <th>Mentor Name</th>
                                                <th>Start Time</th>
                                                <th>End Time</th>
                                                <th>Meeting Link</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($meetings as $meeting)
                                                @php
                                                    $status = \Carbon\Carbon::parse($meeting->end_session)->lessThan(
                                                        now(),
                                                    )
                                                        ? 'completed'
                                                        : $meeting->status;
                                                @endphp
                                                <tr data-mentor-id="{{ $meeting->mentor_id }}"
                                                    data-status="{{ $status }}">
                                                    <td>{{ $meeting->username }}</td>
                                                    <td>{{ \Carbon\Carbon::parse($meeting->start_session)->format('Y-m-d H:i') }}
                                                    </td>
                                                    <td>{{ \Carbon\Carbon::parse($meeting->end_session)->format('Y-m-d H:i') }}
                                                    </td>
                                                    <td><a href="{{ $meeting->meeting_link }}" target="_blank"
                                                            class="btn btn-link">Join Meeting</a></td>
                                                    <td>
                                                        <span
                                                            class="badge 
                                                            {{ $status === 'completed'
                                                                ? 'badge-warning'
                                                                : ($status === 'scheduled'
                                                                    ? 'badge-success'
                                                                    : ($status === 'cancelled'
                                                                        ? 'badge-danger'
                                                                        : 'badge-warning')) }}">
                                                            {{ ucfirst($status) }}
                                                        </span>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                                <!-- Pagination Links -->
                                <div class="pagination">
                                    {{ $meetings->links() }}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function filterMeetings() {
            const mentorFilterValue = document.getElementById('mentorFilter').value;
            const statusFilterValue = document.getElementById('statusFilter').value;
            const rows = document.querySelectorAll('#meetingsTable tbody tr');
            let hasFiltered = false;

            rows.forEach(row => {
                const mentorId = row.getAttribute('data-mentor-id');
                const status = row.getAttribute('data-status');

                // Check if the row matches both filters
                const matchesMentor = mentorFilterValue === "" || mentorId === mentorFilterValue;
                const matchesStatus = statusFilterValue === "" || status === statusFilterValue;

                if (matchesMentor && matchesStatus) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });

            // Enable or disable the clear filter button based on active filters
            hasFiltered = mentorFilterValue || statusFilterValue;
            document.getElementById('clearFilterBtn').disabled = !hasFiltered;
        }

        function clearFilter() {
            document.getElementById('mentorFilter').value = '';
            document.getElementById('statusFilter').value = '';
            filterMeetings();
        }
    </script>
@endsection
