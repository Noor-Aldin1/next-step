<div class="col-xl-3 col-lg-4">
    <div class="clearfix">
        <div class="card card-bx author-profile m-b30">
            <div class="card-body">
                <div class="p-5">
                    <div class="author-profile">
                        <div class="author-media text-center">
                            <!-- Profile Image -->
                            <img id="profileImage" src="{{ asset('storage/' . Auth::user()->photo) }}" alt="Profile Image"
                                class="rounded-circle img-fluid mb-3"
                                style="width: 160px; height: 160px; object-fit: cover; border: 3px solid #ddd;">

                            <!-- Upload Form -->
                            <form action="{{ route('profile.uploadImage') }}" method="POST"
                                enctype="multipart/form-data" class="d-flex flex-column align-items-center">
                                @csrf

                                <!-- File Input -->
                                <input type="file" id="imageUpload" name="image" class="d-none update-flie"
                                    accept="image/*" onchange="previewImage(event)">

                                <!-- Button to Trigger File Input -->
                                <label for="imageUpload" class="btn btn-secondary mb-2"
                                    style="width: 160px; border: 2px solid #ddd; background-color: #fff; color: #333; cursor: pointer;">
                                    <i class="fa fa-camera" style="margin-right: 5px;"></i> Choose Image
                                </label>

                                <!-- Upload Button -->
                                <button
                                    style="background: #fd1616; color: white; width: 160px; margin-top: 10px; cursor: pointer;"
                                    type="submit" class="btn" disabled id="uploadButton">Upload Image</button>
                            </form>
                        </div>



                        <div class="author-info">
                            @auth

                                <h6 class="title">{{ Auth::user()->username }}</h6>
                            @endauth
                            <span>{{ $employer->company_name }}</span>
                        </div>
                    </div>
                </div>
                <div class="info-list">
                    <ul>
                        <li><a style="font-weight: 500" href="app-profile.html">Total jobs you
                                possess</a><span>{{ $jobCount }}</span></li>
                        <li><a style="font-weight: 500" href="app-profile.html">Total job
                                candidates</a><span>{{ $totalApplicants }}</span>
                        </li>

                    </ul>
                </div>
            </div>

        </div>
    </div>
</div>

<script>
    // Function to preview the selected image
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
</script>
