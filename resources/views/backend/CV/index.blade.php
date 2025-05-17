@extends('backend.layout.master')
@section('backend_content')

<div class="container  bg-white mb-4 p-4 rounded shadow-sm">
    
    <div class="form-container shadow-sm p-4 bg-light rounded">
        <h2 class="text-center mb-4 text-primary">Search CVs</h2>
        <form>
            <div class="row g-3 mb-4">
                <div class="col-md-6">
                    <label for="keywords" class="form-label fw-bold">Keywords</label>
                    <input type="text" id="keywords" class="form-control" placeholder="e.g., Product Manager">
                </div>
                <div class="col-md-6">
                    <label for="location" class="form-label fw-bold">Work Location</label>
                    <select id="location" class="form-select">
                        <option value="">Please select</option>
                        <option value="Phnom Penh">Phnom Penh</option>
                        <option value="Siem Reap">Siem Reap</option>
                    </select>
                </div>
            </div>
            <div class="row g-3 mb-4">
                <div class="col-md-6">
                    <label class="form-label fw-bold">Age Range</label>
                    <div class="input-group">
                        <input type="number" class="form-control" placeholder="Min">
                        <span class="input-group-text">to</span>
                        <input type="number" class="form-control" placeholder="Max">
                    </div>
                </div>
                <div class="col-md-6">
                    <label for="gender" class="form-label fw-bold">Gender</label>
                    <select id="gender" class="form-select">
                        <option value="">Please select</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                </div>
            </div>
            <div class="row g-3 mb-4">
                <div class="col-md-6">
                    <label for="education" class="form-label fw-bold">Education Level</label>
                    <select id="education" class="form-select">
                        <option value="">Please select</option>
                        <option value="Bachelor Degree">Bachelor Degree</option>
                        <option value="Professional Degree">Professional Degree</option>
                    </select>
                </div>
                <div class="col-md-6 d-flex align-items-end justify-content-end">
                    <button type="submit" class="btn btn-primary w-100">
                        Search <i class="fas fa-search ms-2"></i>
                    </button>
                </div>
            </div>
        </form>
    </div>

    <div class="mt-5">
        <h4 class="mb-4 text-secondary">Search Results</h4>
        <table class="table table-bordered table-hover align-middle bg-white">
            <thead class="table-primary">
                <tr>
                    <th>Name</th>
                    <th>Gender</th>
                    <th>Age</th>
                    <th>Experience</th>
                    <th>Education</th>
                    <th>Current Address</th>
                    <th>Current Position</th>
                    <th>Salary</th>
                    <th>Last Updated</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Lachinov Tural <span class="badge bg-danger ms-2">New</span></td>
                    <td>Male</td>
                    <td>37</td>
                    <td>10 years</td>
                    <td>Professional Degree</td>
                    <td>Phnom Penh</td>
                    <td>Software Engineer</td>
                    <td>$2000+</td>
                    <td>2024/12/25</td>
                    <td>
                        <button class="btn btn-primary btn-sm" title="View"><i class="fas fa-eye"></i></button>
                        <button class="btn btn-secondary btn-sm" title="Download"><i class="fas fa-download"></i></button>
                    </td>
                </tr>
                <tr>
                    <td>Jane Doe</td>
                    <td>Female</td>
                    <td>29</td>
                    <td>5 years</td>
                    <td>Bachelor Degree</td>
                    <td>Siem Reap</td>
                    <td>Marketing Specialist</td>
                    <td>$1500</td>
                    <td>2024/12/20</td>
                    <td>
                        <button class="btn btn-primary btn-sm" title="View"><i class="fas fa-eye"></i></button>
                        <button class="btn btn-secondary btn-sm" title="Download"><i class="fas fa-download"></i></button>
                    </td>
                </tr>
            </tbody>
        </table>

        <nav aria-label="Page navigation example" class="mt-4">
            <ul class="pagination justify-content-center">
                <li class="page-item">
                    <a class="page-link" href="#" aria-label="Previous">&laquo;</a>
                </li>
                <li class="page-item"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item">
                    <a class="page-link" href="#" aria-label="Next">&raquo;</a>
                </li>
            </ul>
        </nav>
    </div>
</div>
@endsection
