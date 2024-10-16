<!-- Include SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://unpkg.com/alpinejs" defer></script>

<div class="col-md-4">
    <div class="account-information">
        <div class="profile-thumb">
            <img id="profileImage" src="{{ asset('storage/' . Auth::user()->photo) }}" alt="Profile Image"
                class="rounded-circle img-fluid" style="width: 160px; height: 155px;">

            {{-- <h3>{{ Auth::user()->name }}</h3>
            <p>{{ Auth::user()->role ?? 'Web Developer' }}</p> --}}
            <div class="mt-2 d-flex justify-content-center">
                <form action="{{ route('profile.uploadImage') }}" method="POST" enctype="multipart/form-data"
                    class="d-flex align-items-center">
                    @csrf
                    <div class="me-2">
                        <label for="imageUpload" class="btn btn-secondary mb-0">Choose Image</label>
                        <input name="image" type="file" id="imageUpload" accept="image/*" class="d-none"
                            onchange="previewImage(event)" required>
                    </div>

                    <button style="background: #fd1616; color: white" type="submit" class="btn" disabled
                        id="uploadButton">Upload Image</button>
                </form>
            </div>
        </div>

        <ul>
            <li>
                <a href="{{ route('profile.edit') }}" class="{{ request()->routeIs('profile.edit') ? 'active' : '' }}">
                    <i class='bx bx-user'></i>
                    My Profile
                </a>
            </li>
            <li>
                <a href="{{ route('resumes.show', Auth::user()->id) }}" class="">
                    <i class='bx bxs-file-doc'></i>
                    My Resume
                </a>
            </li>
            <li>
                <a href="{{ route('applications.index') }}">
                    <i class='bx bx-briefcase'></i>
                    Applied Job
                </a>
            </li>
            <li>
                <a href="#">
                    <i class='bx bx-envelope'></i>
                    Messages
                </a>
            </li>
            <li>
                <a href="#" class="">
                    <i class='bx bx-heart'></i>
                    Saved Jobs
                </a>
            </li>
            <li>
                <a href="{{ route('change.password') }}"
                    class="{{ request()->routeIs('change.password') ? 'active' : '' }}">
                    <i class='bx bx-lock-alt'></i>
                    Change Password
                </a>
            </li>
            {{-- <li>
                <div x-data="{ showDeleteAccountModal() { showDeleteModal() } }" class="ps-5 mb-2">
                    <!-- Delete Account Button triggers SweetAlert2 -->
                    <button x-on:click.prevent='showDeleteAccountModal()'
                        class="btn btn-danger d-flex align-items-center">
                        <i class='bx bx-coffee-togo me-2'></i>
                        <span>Delete Account</span>
                    </button>
                </div>
            </li> --}}

        </ul>
    </div>
</div>

<script>
    // Function to show SweetAlert delete confirmation modal
    function showDeleteModal() {
        Swal.fire({
            title: 'Are you sure you want to delete your account?',
            text: "Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm.",
            icon: 'warning',
            html: `
                <form id="delete-account-form" method="post" action="{{ route('profile.destroy') }}">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="_method" value="DELETE">
                    <div class="mt-4">
                        <label for="password" class="sr-only">Password</label>
                        <input id="password" name="password" type="password" class="swal2-input" placeholder="Password" required>
                    </div>
                </form>
            `,
            showCancelButton: true,
            confirmButtonText: 'Delete Account',
            cancelButtonText: 'Cancel',
            preConfirm: () => {
                const form = document.getElementById('delete-account-form');
                const passwordInput = form.querySelector('#password').value;

                if (!passwordInput) {
                    Swal.showValidationMessage('Please enter your password');
                    return false;
                }

                // Submit the form if the password is provided
                form.submit();
            }
        });
    }

    // Image preview function
    function previewImage(event) {
        const image = document.getElementById('profileImage');
        image.src = URL.createObjectURL(event.target.files[0]);

        // Enable the upload button
        const uploadButton = document.getElementById('uploadButton');
        uploadButton.disabled = false; // Enable the button
    }

    // Enable the upload button only if an image is selected
    document.getElementById('imageUpload').addEventListener('change', function() {
        const file = this.files[0];
        const uploadButton = document.getElementById('uploadButton');

        if (file) {
            const fileType = file.type.split('/')[0];
            const fileSize = file.size;

            // Validate file type and size
            if (fileType !== 'image' || fileSize > 2 * 1024 * 1024) { // 2MB limit
                Swal.fire({
                    title: 'Invalid File',
                    text: 'Please upload a valid image (PNG, JPG, JPEG) smaller than 2MB.',
                    icon: 'warning',
                    confirmButtonText: 'OK'
                });
                this.value = ''; // Clear the file input
                uploadButton.disabled = true; // Disable the upload button
            } else {
                uploadButton.disabled = false; // Enable the upload button
            }
        }
    });

    // Optional: Handle form submission
    document.getElementById('imageUploadForm').addEventListener('submit', function(event) {
        // You can add further validation or actions here before submission
    });
</script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
