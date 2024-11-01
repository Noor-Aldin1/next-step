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

                            <!-- Button to schedule a new meeting -->
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <div></div>

                                <!-- Dropdown to filter by Mentor Name -->
                                <select id="mentorFilter" class="form-control w-50" onchange="filterMeetings()">
                                    <option value="">Select a Mentor</option>
                                    @foreach ($meetings->unique('mentor_id') as $mentor)
                                        <option value="{{ $mentor->mentor_id }}">{{ $mentor->username }}</option>
                                    @endforeach
                                </select>

                                <!-- Button to clear the filter -->
                                <button id="clearFilterBtn" class="btn btn-secondary" onclick="clearFilter()" disabled>Clear
                                    Filter</button>
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
                                                <tr data-mentor-id="{{ $meeting->mentor_id }}">
                                                    <td>{{ $meeting->username }}</td>
                                                    <td>{{ \Carbon\Carbon::parse($meeting->start_session)->format('Y-m-d H:i') }}
                                                    </td>
                                                    <td>{{ \Carbon\Carbon::parse($meeting->end_session)->format('Y-m-d H:i') }}
                                                    </td>
                                                    <td>
                                                        <a href="{{ $meeting->meeting_link }}" target="_blank"
                                                            class="btn btn-link">Join Meeting</a>
                                                    </td>
                                                    <td>
                                                        <span
                                                            class="badge {{ $meeting->status == 'Completed' ? 'badge-success' : ($meeting->status == 'Pending' ? 'badge-warning' : 'badge-danger') }}">
                                                            {{ $meeting->status }}
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
            const filterValue = document.getElementById('mentorFilter').value;
            const rows = document.querySelectorAll('#meetingsTable tbody tr');
            let hasFiltered = false;

            rows.forEach(row => {
                if (filterValue === "" || row.getAttribute('data-mentor-id') === filterValue) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });

            hasFiltered = Array.from(rows).some(row => row.style.display === 'none');
            document.getElementById('clearFilterBtn').disabled = !hasFiltered;
        }

        function clearFilter() {
            document.getElementById('mentorFilter').value = '';
            filterMeetings();
        }
    </script>
@endsection
