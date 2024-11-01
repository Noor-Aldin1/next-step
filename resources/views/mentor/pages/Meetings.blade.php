@extends('mentor.master_page')

@section('content')
    <!-- Content body start -->
    <div class="content-body">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="text-primary">Meetings with Students</h4>
                            <hr>

                            <!-- Button to schedule a new meeting -->
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <a href="javascript:void()" data-toggle="modal" data-target="#add-category"
                                    class="btn btn-primary">Schedule Meeting</a>

                                <!-- Dropdown to filter by Student Name -->
                                <select id="studentFilter" class="form-control w-50" onchange="filterMeetings()">
                                    <option value="">Select a Student</option>
                                    @foreach ($students as $student)
                                        <option value="{{ $student->id }}">{{ $student->username }}</option>
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
                                                <th>Student Name</th>
                                                <th>Start Time</th>
                                                <th>End Time</th>
                                                <th>Meeting Link</th>
                                                <th>Status</th>
                                                <th>Actions</th>
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
                                                <tr data-student-id="{{ $meeting->user->id }}">
                                                    <td>{{ $meeting->user->username }}</td>
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
                                                            class="badge 
                                                            {{ $status == 'completed' ? 'badge-success' : ($status == 'pending' ? 'badge-warning' : 'badge-danger') }}">
                                                            {{ ucfirst($status) }}
                                                        </span>
                                                    </td>
                                                    <td>
                                                        @if ($status !== 'cancelled')
                                                            <form
                                                                action="{{ route('meetings.destroy', $meeting->meeting_id) }}"
                                                                method="POST" style="display:inline;" class="delete-form">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="button"
                                                                    class="btn btn-danger btn-sm delete-btn">Cancel</button>
                                                            </form>
                                                        @endif
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

    @include('mentor.partials.add_meeting')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function filterMeetings() {
            const filterValue = document.getElementById('studentFilter').value;
            const rows = document.querySelectorAll('#meetingsTable tbody tr');
            let hasFiltered = false;

            rows.forEach(row => {
                if (filterValue === "" || row.getAttribute('data-student-id') === filterValue) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });

            hasFiltered = Array.from(rows).some(row => row.style.display === 'none');
            document.getElementById('clearFilterBtn').disabled = !hasFiltered;
        }

        function clearFilter() {
            document.getElementById('studentFilter').value = '';
            filterMeetings();
        }

        document.querySelectorAll('.delete-btn').forEach(button => {
            button.addEventListener('click', function() {
                const form = this.closest('form');

                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Yes, cancel it!',
                    cancelButtonText: 'Cancel'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    </script>
@endsection
