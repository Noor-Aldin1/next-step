<form class="find-form mt-0" method="GET" action="{{ route('jobs.felter') }}" id="filter-form">
    <div class="row">
        <!-- Job Title or Keyword -->
        <div class="col-lg-3 col-md-6 col-sm-12 mb-3">
            <div class="form-group">
                <input type="text" class="form-control" name="search" placeholder="Job Title or Keyword"
                    value="{{ request('search') }}" oninput="toggleClearButton()">
                <i class="bx bx-search-alt"></i>
            </div>
        </div>

        <!-- City -->
        <div class="col-lg-3 col-md-6 col-sm-12 mb-3">
            <div class="form-group">
                <select class="form-control" name="city" id="city" onchange="toggleClearButton()">
                    <option value="" selected>Choose City</option>
                    @foreach ($cities as $city)
                        <option value="{{ $city }}" {{ request('city') == $city ? 'selected' : '' }}>
                            {{ $city }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <!-- Category -->
        <div class="col-lg-3 col-md-6 col-sm-12 mb-3">
            <div class="form-group">
                <select class="form-control" name="category" id="category" onchange="toggleClearButton()">
                    <option value="" selected>Choose Category</option>
                    @foreach ($job_categories as $category)
                        <option value="{{ $category->id }}"
                            {{ request('category') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <!-- Search Button -->
        <div class="col-lg-3 col-md-6 col-sm-12 mb-3 d-flex justify-content-center align-items-center">
            <button type="submit" class="find-btn w-100">
                Find A Job
                <i class='bx bx-search'></i>
            </button>
        </div>
    </div>

    <br>

    <div class="row">
        <!-- Clear Filter Button -->
        <div class="col-lg-3 col-md-6 col-sm-12 mb-3 d-flex justify-content-center align-items-center">
            <button type="button" class="clear-btn btn w-100" id="clear-filter" disabled onclick="clearFilters()">
                Clear Filter
                <i class='bx bx-filter' style="font-size: 16px; margin-left: 5px;"></i>
            </button>
        </div>
    </div>
</form>

<script>
    // Format options to include the city flag
    var optionFormat = function(item) {
        if (!item.id) {
            return item.text;
        }

        var span = document.createElement('span');
        var imgUrl = item.element.getAttribute('data-kt-select2-city');
        var template = '';

        // Add the city name to the template
        template += item.text;

        span.innerHTML = template;

        return $(span);
    };

    // Initialize Select2 with custom formatting for the city dropdown
    $('#city').select2({
        templateSelection: optionFormat,
        templateResult: optionFormat,
        minimumResultsForSearch: Infinity // Disable search box if not needed
    });
    $('#category').select2({
        templateSelection: optionFormat,
        templateResult: optionFormat,
        minimumResultsForSearch: Infinity // Disable search box if not needed
    });
</script>
<style>
    .select2-container .select2-selection--single {
        border-radius: 8px;
        height: 60px;
        /* Adjust as needed */

        /* Add padding */
    }

    .select2-container--default .select2-selection--single .select2-selection__rendered {
        line-height: 58px;
        /* Center text vertically */
    }

    .select2-selection__arrow {
        bottom: 30%;
        transform: translateY(50%);
        /* Adjust positioning */
    }
</style>
